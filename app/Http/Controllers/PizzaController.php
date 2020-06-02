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
        if ($request->session()->has('customer_id')) {
            $customer_id = $request->session()->get('customer_id');
            $customer_id = filter_var($customer_id, FILTER_SANITIZE_NUMBER_INT);

            $customer = Customer::find($customer_id);
        }
        if (isset($customer) && $customer) {
            // get Order
            $order = Order::where([
                ['customer_id', '=', $customer->id],
                ['is_confirmed', '=', false]
            ])->latest()->first();
        }

        if (isset($customer) && $customer && isset($order) && $order) {
            $ordered_pizzas = OrderedPizza::where('order_id', $order->id)->latest()->get();
        }

        if (isset($ordered_pizzas) && $ordered_pizzas) {

            return view('pizza.index', [
                'pizzas' => Pizza::paginate(9),
                'ordered_pizzas' => $ordered_pizzas,
                'ordered_pizzas_number' => $ordered_pizzas->count()
            ]);
        } else {
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
        if ($request->session()->has('customer_id')) {
            $customer_id = $request->session()->get('customer_id');
            $customer_id = filter_var($customer_id, FILTER_SANITIZE_NUMBER_INT);

            $customer = Customer::find($customer_id);
        }
        if (!$request->session()->has('customer_id') || !$customer) {
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
