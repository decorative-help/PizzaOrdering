<?php

namespace App\Http\Controllers;

use App\Currency;
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
                $viewAttributes['currencies'] = Currency::all();
            }
        }

        return view('layout.index', $viewAttributes);
    }
}
