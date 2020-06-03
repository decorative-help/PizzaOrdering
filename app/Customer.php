<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public static function findFromRequest(Request $request)
    {
        if ($request->session()->has('customer_id')) {
            $customer_id = $request->session()->get('customer_id');
            $customer_id = filter_var($customer_id, FILTER_SANITIZE_NUMBER_INT);

            $customer = self::find($customer_id);

            if ($customer) {
                // if Customer is found
                return $customer;
            }
        }
        // in any other case
        return false;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
