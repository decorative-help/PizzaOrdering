<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\Customer;
use App\Order;
use App\OrderedPizza;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PizzaController extends Controller
{
    public function index(Request $request)
    {

        // get Customer
        $customer = Customer::findFromRequest($request);

        // if Customer exists
        if ($customer) {
            // get Order
            $order = Order::where([
                ['customer_id', '=', $customer->id],
                ['is_confirmed', '=', false]
            ])->latest()->firstOrFail();
            // get OrderedPizzas
            $ordered_pizzas = OrderedPizza::where('order_id', $order->id)->latest()->get();
            // show also basket
            return view('pizza.index', [
                'pizzas' => Pizza::paginate(9),
                'ordered_pizzas' => $ordered_pizzas
            ]);
        } else {
            // show without basket
            return view('pizza.index', [
                'pizzas' => Pizza::paginate(9),
            ]);
        }
    }

    public function store(Request $request)
    {
        // validate
        $validatedData = $request->validate([
            'id' => 'required|integer|min:1'
        ]);

        // get Pizza
        $pizza = Pizza::findOrFail($validatedData['id']);

        // get Customer
        $customer = Customer::findFromRequest($request);
        if (!$customer) {
            $customer = new Customer;
            $customer->save();
            $request->session()->put('customer_id', $customer->id);
        }

        // get Order
        $order = Order::where([
            ['customer_id', '=', $customer->id],
            ['is_confirmed', '=', false]
        ])->latest()->first();

        if (!$order) {
            $order = new Order;
            $order->customer_id = $customer->id;
            $order->save();
        }

        // set OrderedPizza
        $ordered_pizza = new OrderedPizza;
        $ordered_pizza->order_id = $order->id;
        $ordered_pizza->pizza_id = $pizza->id;
        $ordered_pizza->save();

        // $ordered_pizzas = OrderedPizza::where('order_id', $order->id)->latest()->get();
        // var_dump($ordered_pizzas);
        return redirect('/');
    }
}
