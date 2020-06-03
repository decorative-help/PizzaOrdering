<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderedPizza;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'comments' => 'string'
        ]);

        $order->update($validatedData);

        return redirect()->route('home');
    }

    public function finish(Order $order)
    {
        $order->update([
            'is_confirmed' => true
        ]);

        return view('order.finish', [
            'order' => $order
        ]);
    }
}
