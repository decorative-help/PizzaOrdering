<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['cutomer_id', 'comments', 'is_confirmed'];

    public function ordered_pizzas()
    {
        return $this->hasMany(OrderedPizza::class);
    }
}
