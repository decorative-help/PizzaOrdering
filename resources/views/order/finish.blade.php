<div class="row">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $order->id }}</h1>
            <p class="lead">This is your order number</p>
            <hr class="my-4">
            <p>Remember it to identify your order</p>
            <a class="btn btn-primary btn-lg" href="tel:87882323" role="button">Call Pizza Assistant</a>
            <hr class="my-4">
            <p>
                Total price - ${{ $order->total_price }}
                @foreach ($currencies as $currency)
                <br>
                <small class="text-muted">
                    <i>
                        {{ $currency->name }}: {{ round($order->total_price * $currency->price_factor, 2) }}
                    </i>
                </small>
                @endforeach
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table table-borderless table-hover table-sm">
            <caption>Ordered Pizzas</caption>
            <thead>
                <tr>
                    <th scope="col">Pizza</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->ordered_pizzas as $ordered_pizza)
                <tr>
                    <td>
                        <p>
                            <strong>{{ $ordered_pizza->pizza->name }}</strong>
                            <small class="text-muted"><i>({{ $ordered_pizza->pizza->basic_price }})</i></small>
                            <br>
                            Topping: {{ $ordered_pizza->topping->name }}
                            <small class="text-muted"><i>({{ $ordered_pizza->topping->price_factor }})</i></small>
                            <br>
                            Size: {{ $ordered_pizza->size->name }}
                            <small
                                class="text-muted"><i>({{ $ordered_pizza->size->price_factor * $ordered_pizza->pizza->basic_price }})</i></small>
                            <br>
                            Quantity: {{ $ordered_pizza->quantity }}
                        </p>
                    </td>
                    <td>
                        ${{ $ordered_pizza->total_price }}
                        @foreach ($currencies as $currency)
                        <br>
                        <small class="text-muted">
                            <i>
                                {{ $currency->name }}:
                                {{ round($ordered_pizza->total_price * $currency->price_factor, 2) }}
                            </i>
                        </small>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
