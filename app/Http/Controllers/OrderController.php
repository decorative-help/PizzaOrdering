<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Currency;
use App\DeliveryMethod;
use App\Order;
use App\OrderedPizza;
use App\Payment;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'comments' => 'nullable|string',
            'payment_id' => 'required|integer|min:1',
            'delivery_method_id' => 'required|integer|min:1',
            'recalculate' => 'integer|min:1|max:1',
            'checkout' => 'integer|min:1|max:1',
        ]);

        $payment = Payment::findOrFail($validatedData['payment_id']);
        $delivery_method = DeliveryMethod::findOrFail($validatedData['delivery_method_id']);

        $validatedData['total_price'] = $order->ordered_pizzas()->pluck('total_price')->sum();
        $validatedData['total_price'] =
            $validatedData['total_price'] * $payment->price_factor
            + $delivery_method->price_factor;

        if (null === $validatedData['comments']) {
            $validatedData['comments'] = '';
        }

        $order->update([
            'comments' => $validatedData['comments'],
            'payment_id' => $validatedData['payment_id'],
            'delivery_method_id' => $validatedData['delivery_method_id'],
            'total_price' => $validatedData['total_price'],
        ]);

        if (isset($validatedData['recalculate']) && 1 == $validatedData['recalculate']) {
            return redirect()->route('home');
        }
        if (isset($validatedData['checkout']) && 1 == $validatedData['checkout']) {
            return redirect()->route('order.finish', $order->id);
        }
    }

    public function finish(Order $order)
    {
        $order->update([
            'is_confirmed' => true
        ]);

        return view('layout.checkout', [
            'order' => $order,
            'currencies' => Currency::all(),
        ]);
    }

    public static function recalculate($order_id)
    {
        // get Order
        $order = Order::findOrFail($order_id);
        // sum OrderedPizza`s total prices
        $orderedPizzas_total_price = $order->ordered_pizzas()->pluck('total_price')->sum();
        // sum Order total price
        $order_total_price =
            $orderedPizzas_total_price * $order->payment->price_factor
            + $order->delivery_method->price_factor;

        $order->update([
            'total_price' => $order_total_price,
        ]);
    }
}
