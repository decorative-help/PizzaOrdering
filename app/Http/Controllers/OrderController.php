<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderedPizza;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // get Customer
        $customer = Customer::findFromRequest($request);

        if ($customer) {
            // get Order
            $order = Order::where([
                ['customer_id', '=', $customer->id],
                ['is_confirmed', '=', false]
            ])->latest()->firstOrFail();
            // get OrderedPizzas
            $ordered_pizzas = OrderedPizza::where('order_id', $order->id)->latest()->get();
            // show also basket
            return view('order.index', [
                'order' => $order,
                'ordered_pizzas' => $ordered_pizzas
            ]);
        }
        // in any other cases
        redirect('/');
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'comments' => 'string'
        ]);

        $order->update($validatedData);

        return redirect()->route('order.index');
    }

    public function finish(Order $order)
    {
        $order->update([
            'is_confirmed' => true
        ]);

        return view('order.finish', [
            'order' => $order,
            'ordered_pizzas' => $order->ordered_pizzas
        ]);
    }
}
