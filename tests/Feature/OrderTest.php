<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\DeliveryMethod;
use App\Payment;
use App\Pizza;
use App\Size;
use App\Topping;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function testAddOrder()
    {
        // set up DB
        factory(Pizza::class, 35)->create();
        factory(DeliveryMethod::class, 2)->create();
        factory(Payment::class, 2)->create();
        factory(Size::class, 8)->create();
        factory(Topping::class, 20)->create();

        $attributes = [
            'id' => 7,
            'topping' => 1,
            'size' => 2,
            'quantity' => 2,
        ];

        $this->post('/ordered_pizzas', $attributes);

        $this->assertDatabaseHas('orders', [
            'id' => '1',
        ]);
    }

    public function testUpdateOrder()
    {
        // set up DB
        factory(Pizza::class, 35)->create();
        factory(DeliveryMethod::class, 2)->create();
        factory(Payment::class, 2)->create();
        factory(Size::class, 8)->create();
        factory(Topping::class, 20)->create();

        $attributes = [
            'id' => 7,
            'topping' => 1,
            'size' => 2,
            'quantity' => 2,
        ];

        $this->post('/ordered_pizzas', $attributes);

        $attributes = [
            'payment_id' => 2,
            'delivery_method_id' => 2,
            'recalculate' => 1,
            'comments' => 'FindME',
        ];

        $this->patch('/orders/1', $attributes);

        $this->assertDatabaseHas('orders', [
            'comments' => 'FindME',
        ]);
    }

    public function testFinishOrder()
    {
        // set up DB
        factory(Pizza::class, 35)->create();
        factory(DeliveryMethod::class, 2)->create();
        factory(Payment::class, 2)->create();
        factory(Size::class, 8)->create();
        factory(Topping::class, 20)->create();

        $attributes = [
            'id' => 7,
            'topping' => 1,
            'size' => 2,
            'quantity' => 2,
        ];

        $this->post('/ordered_pizzas', $attributes);

        $attributes = [
            'payment_id' => 2,
            'delivery_method_id' => 2,
            'comments' => 'FindME',
        ];

        $this->patch('/orders/1', $attributes);


        $this->get('/order/1', $attributes);

        $this->assertDatabaseHas('orders', [
            'is_confirmed' => '1',
        ]);
    }
}
