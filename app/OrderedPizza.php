<?php

namespace App;

use App\Pizza;
use App\Customer;
use App\Order;

use Illuminate\Database\Eloquent\Model;

class OrderedPizza extends Model
{
    protected $fillable = ['pizza_id'];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }
}
