<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\Customer;
use App\DeliveryMethod;
use App\Order;
use App\OrderedPizza;
use App\Payment;
use App\Size;
use App\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PizzaController extends Controller
{
    public function index(Request $request)
    {
        $viewAttributes = [
            'pizzas' => Pizza::paginate(8),
            'toppings' => Topping::get(),
            'sizes' => Size::get(),
            'payments' => Payment::get(),
            'delivery_methods' => DeliveryMethod::get(),
        ];
        // get Customer
        $customer = Customer::findFromRequest($request);

        // if Customer exists
        if ($customer) {
            // get Order
            $order = $customer->orders()->where('is_confirmed', false)->latest()->first();
            if ($order) {
                // show also basket
                $viewAttributes['order'] = $order;
            }
        }

        return view('layout.index', $viewAttributes);
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

        return redirect()->route('home');
    }
}
