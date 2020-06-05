<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizzas')->insert([
            [
                'name' => 'Buffalo Chicken',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/buffalo-chicken-pizza.png',
                'description' => 'All the Zing, without the wing - This tangy, spicy pie is made for Game Day. Kick off with Buffalo blue cheese sauce, grilled chicken, red onions, fire-roasted red peppers and mozzarella cheese.',
                'basic_price' => 13.29,
            ],
            [
                'name' => 'Chipotle Chicken',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Chipotle-Chicken.png',
                'description' => 'Smoky, zesty and bold - This Southwest-style flavor-bomb is set off with smoky chipotle sauce, then topped with chipotle chicken, zesty red onions, and melty mozzarella. Me gusta?',
                'basic_price' => 11.69,
            ],
            [
                'name' => 'Chicken Bruschetta',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/chickenbruschetta.png',
                'description' => 'A Twist on Italian Taste - What can make bruschetta better? How about grilled chicken? Add roasted garlic, Italiano Blend Seasoning, parmesan and mozzarella, and it\'s molto deliziosa.',
                'basic_price' => 14.79,
            ],
            [
                'name' => 'Chipotle Steak',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Chipotle-Steak.png',
                'description' => 'Smoky chipotle meets sizzling steak - his hearty Southwest-inspired pie combines smoky chipotle sauce, tender steak, zesty red onions, and melty mozzarella.VIVA CHIPOTLE!',
                'basic_price' => 11.69,
            ],
            [
                'name' => 'Bacon Double Cheeseburger ',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/bacondblchburg.png',
                'description' => 'Cheeseburger. Pizza. Enough Said - Yeah, we did it. Crush two comfort-food classics in one, with ground beef, bacon crumble and four-cheese blend. Try it with Honey Mustard dipping sauce for extra burger bite!',
                'basic_price' => 10.69,
            ],
            [
                'name' => 'Canadian Eh!',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/canadian.png',
                'description' => 'True north delicious - As Canadian as a toque on a moose. Pepperoni, fresh mushrooms, bacon crumble and 100% Canadian Dairy mozzarella cheese.',
                'basic_price' => 12.19,
            ],
            [
                'name' => 'Classic Super',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/12400.png',
                'description' => 'The Pizza Pizza original - A staple since 1967, this one never goes out of style! A classic combo of pepperoni, fresh mushrooms, green peppers, and mozzarella cheese.',
                'basic_price' => 12.19,
            ],
            [
                'name' => 'Sausage Mushroom Melt',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/SausageMelt.png',
                'description' => 'Creamy, dreamy and melty - Meet your dream pizza: rich, tasteful and?savoury. Made with creamy garlic sauce, spicy Italian sausage, fresh mushrooms, Italiano blend seasoning, and ooey-gooey mozzarella cheese. ',
                'basic_price' => 10.69,
            ],
            [
                'name' => 'Spicy BBQ Chicken',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/bbqchicken.png',
                'description' => 'Saddle up for a slice - It\'s a showdown at Flavour Corral, with grilled chicken, hot banana peppers, red onions, Texas BBQ sauce and mozzarella cheese. Wanna amp it up even more? Add Frank\'s Red Hot!',
                'basic_price' => 13.29,
            ],
            [
                'name' => 'Tropical Hawaiian ',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/12700.png',
                'description' => 'Grab your floral shirt and dip in - Don\'t let anyone tell you it isn\'t amazing. This taste of the tropics brings together sweet pineapple, bacon crumble, bacon strips, and mozzarella cheese for a beach vacation on Flavour Island! ',
                'basic_price' => 13.29,
            ],
            [
                'name' => 'Sweet Heat',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/13830.png',
                'description' => 'A fiery bite with a sweet twist - Sometimes opposites attract and make sweet, spicy magic! Trust us, the combo of grilled chicken, pineapple, hot banana peppers and mozzarella cheese is totally amazing.',
                'basic_price' => 13.29,
            ],
            [
                'name' => 'Pepperoni',
                'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Pepperoni.png',
                'description' => 'The all-time favourite - It doesn\'t get any more iconic than this. Savoury pepperoni, homestyle sauce, and ooey-gooey, stretchy mozzarella. Perfection!',
                'basic_price' => 9.19,
            ],
        ]);

        DB::table('delivery_methods')->insert([
            [
                'name' => 'Delivery',
                'price_factor' => 7.2,
            ],
            [
                'name' => 'Take Away',
                'price_factor' => 0.0,
            ]
        ]);

        DB::table('payments')->insert([
            [
                'name' => 'Cash',
                'price_factor' => 1.0,
            ],
            [
                'name' => 'Bank Card',
                'price_factor' => 0.9,
            ]
        ]);

        DB::table('sizes')->insert([
            [
                'name' => 'Small',
                'price_factor' => 0.8,
            ],
            [
                'name' => 'Medium',
                'price_factor' => 1.0,
            ],
            [
                'name' => 'Large',
                'price_factor' => 1.2,
            ],
            [
                'name' => 'X-Large',
                'price_factor' => 1.5,
            ]
        ]);

        DB::table('toppings')->insert([
            [
                'name' => 'Bruschetta',
                'price_factor' => 0.5,
            ],
            [
                'name' => 'Goat Cheese',
                'price_factor' => 0.9,
            ],
            [
                'name' => 'Caramelized Onions',
                'price_factor' => 0.7,
            ],
            [
                'name' => 'Fire Roasted Red Peppers',
                'price_factor' => 1.0,
            ],
            [
                'name' => 'Fresh Mushrooms',
                'price_factor' => 1.5,
            ],
            [
                'name' => 'Green Olives',
                'price_factor' => 0.1,
            ]
        ]);

        DB::table('currencies')->insert([
            [
                'name' => 'Euro',
                'price_factor' => 0.89,
            ]
        ]);
    }
}
