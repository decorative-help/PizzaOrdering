<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\DeliveryMethod;
use App\Payment;
use App\Pizza;
use App\Size;
use App\Topping;

class OrderedPizzaTest extends TestCase
{
    use RefreshDatabase;

    public function testFakePizzaID()
    {
        // set up DB
        factory(Pizza::class, 35)->create();
        factory(DeliveryMethod::class, 2)->create();
        factory(Payment::class, 2)->create();
        factory(Size::class, 8)->create();
        factory(Topping::class, 20)->create();

        $attributes = [
            'id' => 777, // fake Pizza ID
            'topping' => 1,
            'size' => 1,
            'quantity' => 1,
        ];

        $response =  $this->post('/ordered_pizzas', $attributes);
        $response->assertStatus(404);
    }

    public function testFakeToppingID()
    {
        // set up DB
        factory(Pizza::class, 35)->create();
        factory(DeliveryMethod::class, 2)->create();
        factory(Payment::class, 2)->create();
        factory(Size::class, 8)->create();
        factory(Topping::class, 20)->create();

        $attributes = [
            'id' => 7,
            'topping' => 777,
            'size' => 1,
            'quantity' => 1,
        ];

        $response =  $this->post('/ordered_pizzas', $attributes);
        $response->assertStatus(404);
    }

    public function testFakeSizeID()
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
            'size' => 777,
            'quantity' => 1,
        ];

        $response =  $this->post('/ordered_pizzas', $attributes);
        $response->assertStatus(404);
    }

    public function testQuantityExceeded()
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
            'quantity' => 44,
        ];

        $response =  $this->post('/ordered_pizzas', $attributes);
        $response->assertStatus(302);
    }

    public function testAddPizza()
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

        $this->assertDatabaseHas('ordered_pizzas', [
            'pizza_id' => '7',
        ]);
    }

    public function testDeletePizza()
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

        $this->delete('/ordered_pizzas/1', $attributes);

        $this->assertDatabaseMissing('ordered_pizzas', [
            'pizza_id' => '7',
        ]);
    }
}
