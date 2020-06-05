<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['cutomer_id', 'comments', 'is_confirmed', 'payment_id', 'delivery_method_id', 'total_price'];

    public function ordered_pizzas()
    {
        return $this->hasMany(OrderedPizza::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery_method()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }
}
