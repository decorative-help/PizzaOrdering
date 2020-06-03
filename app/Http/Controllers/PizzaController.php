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
            $order = $customer->orders()->where('is_confirmed', false)->latest()->firstOrFail();
            // get OrderedPizzas
            $ordered_pizzas = $order->ordered_pizzas();
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
            'pizza_id' => $pizza->id
        ]);

        return redirect('/');
    }
}
