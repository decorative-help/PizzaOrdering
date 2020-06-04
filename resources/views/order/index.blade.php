<div class="row px-2">
    @if (isset($order))
    <div class="table-responsive">
        <table class="table table-borderless table-hover table-sm">
            <caption>Ordered Pizzas</caption>
            <thead>
                <tr>
                    <th scope="col">Pizza</th>
                    <th scope="col">Price</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->ordered_pizzas as $ordered_pizza)
                <x-form method="DELETE" action="{{ route('ordered_pizza.destroy', $ordered_pizza->id) }}">
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
                            <small class="text-muted">€{{ $ordered_pizza->total_price * 1.2 }}</small>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-outline-danger btn-sm">❌ Remove</button>
                        </td>
                    </tr>
                </x-form>
                @empty
                <tr>
                    <td>No pizzas yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-form action="{{ route('order.update', $order->id) }}" method="PATCH">

        <div class="form-group">
            <label for="selectPaymentMethod">Payment</label>
            <select class="form-control form-control-sm" id="selectPaymentMethod" name="payment_id">
                @foreach ($payments as $payment_method)
                <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="selectDeliveryMethod">Delivery</label>
            <select class="form-control form-control-sm" id="selectDeliveryMethod" name="delivery_method_id">
                @foreach ($delivery_methods as $delivery_method)
                <option value="{{ $delivery_method->id }}">{{ $delivery_method->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="textareaComments">Address and comments</label>
            <textarea class="form-control form-control-sm" id="textareaComments" name="comments"
                aria-describedby="comments"
                placeholder="Intercom is 453. The red door">{{ old('comments') ?? $order->comments }}</textarea>
            <small id="comments" class="form-text text-muted">Your intercom pincode and floor number
                speed up our
                delivery</small>
        </div>
        <div class="form-group row">
            <label for="inputTotalPrice" class="col-sm-2 col-form-label">Total</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="inputTotalPrice"
                    value="${{ $order->total_price }}">
            </div>
        </div>
        <button type="submit" class="btn btn-light btn-sm" name="recalculate" value="1">🔄 Recalculate total
            price</button>
        <button type="submit" class="btn btn-dark" name="checkout" value="1">✔ Place an order</button>
        {{-- <a href="{{ route('order.finish', $order->id) }}" class="btn btn-dark">✔ Place an order</a> --}}
    </x-form>
    @else
    <h3>🛒</h3>
    <p class="text-muted">Shopping basket</p>
    @endif
</div>
