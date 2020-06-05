<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\Customer;
use App\DeliveryMethod;
use App\Events\PizzaAdded;
use App\Events\PizzaRemoved;
use App\Order;
use App\OrderedPizza;
use App\Payment;
use App\Size;
use App\Topping;

use Illuminate\Http\Request;

class OrderedPizzaController extends Controller
{
    public function store(Request $request)
    {
        // validate
        $validatedData = $request->validate([
            'id' => 'required|integer|min:1',
            'topping' => 'required|integer|min:1',
            'size' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1|max:25',
        ]);
        // get Pizza
        $pizza = Pizza::findOrFail($validatedData['id']);
        // get Topping
        $topping = Topping::findOrFail($validatedData['topping']);
        // get Size
        $size = Size::findOrFail($validatedData['size']);
        // get Qquantity
        $quantity = $validatedData['quantity'];

        // get Customer
        $customer = Customer::findFromRequest($request);
        if (!$customer) {
            $customer = Customer::create();
            $request->session()->put('customer_id', $customer->id);
        }

        // get Order
        $order = $customer->orders()->where('is_confirmed', false)->latest()->first();
        if (!$order) {
            $order = $customer->orders()->create();
        }

        // set OrderedPizza
        $ordered_pizza = $order->ordered_pizzas()->create([
            'pizza_id' => $pizza->id,
            'topping_id' => $topping->id,
            'size_id' => $size->id,
            'quantity' => $quantity,
            'total_price' => $quantity * ($pizza->basic_price + $topping->price_factor + $pizza->basic_price * $size->price_factor),
        ]);

        // trigger Events
        PizzaAdded::dispatch($order->id);

        return redirect()->route('home');
    }

    public function destroy(OrderedPizza $ordered_pizza)
    {
        $ordered_pizza->delete();

        // trigger Events
        PizzaRemoved::dispatch($ordered_pizza->order_id);

        return redirect()->route('home');
    }
}
