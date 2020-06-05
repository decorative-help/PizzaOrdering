# pizza

## Models

### Pizza

-   Name
-   Image Link
-   Description
-   Basic Price

### Customer

### Size

-   Name
-   Price Factor

### Topping

-   Name
-   Price Factor

### Payment

-   Name
-   Price Factor

### Delivery Method

-   Name
-   Price Factor

### Order

-   Cusomer ID
-   Payment ID
-   Delivery Method ID
-   Comments
-   IsConfirmed
-   Total Price = SUM( OrderedPizza::TotalPrice ) + SUM( OrderedPizza::TotalPrice ) \* Payment::PriceFactor + DeliveryMethod::PriceFactor

### Ordered Pizza

-   Order ID
-   Pizza ID
-   Size ID
-   Topping ID
-   Quantity
-   Total Price = Quantity \* ( Pizza::BasicPrice + Topping::Price + Pizza::BasicPrice \* Size::PriceFactor)

## Populate DB

> factory(App\Pizza::class, 35)->create();

> factory(App\DeliveryMethod::class, 2)->create();

> factory(App\Payment::class, 2)->create();

> factory(App\Size::class, 8)->create();

> factory(App\Topping::class, 20)->create();
