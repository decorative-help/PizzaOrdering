<?php

namespace App;

use App\Pizza;
use App\Customer;
use App\Order;

use Illuminate\Database\Eloquent\Model;

class OrderedPizza extends Model
{
    protected $fillable = ['pizza_id', 'topping_id', 'size_id', 'quantity', 'total_price'];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function topping()
    {
        return $this->belongsTo(Topping::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
