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
                    <tr class="secret">
                        <td>
                            <p>
                                <strong>{{ $ordered_pizza->pizza->name }}</strong>
                                <small
                                    class="text-muted secret__item"><i>(${{ round($ordered_pizza->pizza->basic_price, 2) }})</i></small>
                                <br>
                                Topping: {{ $ordered_pizza->topping->name }}
                                <small
                                    class="text-muted secret__item"><i>(${{ round($ordered_pizza->topping->price_factor, 2) }})</i></small>
                                <br>
                                Size: {{ $ordered_pizza->size->name }}
                                <small
                                    class="text-muted secret__item"><i>(${{ round($ordered_pizza->size->price_factor * $ordered_pizza->pizza->basic_price,2) }})</i></small>
                                <br>
                                Quantity: {{ $ordered_pizza->quantity }}
                            </p>
                        </td>
                        <td>
                            ${{ $ordered_pizza->total_price }}
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
</div>
<div class="row m-0">
    <x-form action="{{ route('order.update', $order->id) }}" method="PATCH" class="w-100">

        <div class="form-group row">
            <label for="selectPaymentMethod" class="col-sm-2 col-form-label">Payment:</label>
            <div class="col-sm-10">
                <select class="form-control form-control-sm" id="selectPaymentMethod" name="payment_id">
                    @foreach ($payments as $payment_method)
                    <option value="{{ $payment_method->id }}"
                        {{ ($payment_method->id === $order->payment_id) ? 'selected' : '' }}>
                        {{ $payment_method->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="selectDeliveryMethod" class="col-sm-2 col-form-label">Delivery:</label>
            <div class="col-sm-10">
                <select class="form-control form-control-sm" id="selectDeliveryMethod" name="delivery_method_id">
                    @foreach ($delivery_methods as $delivery_method)
                    <option value="{{ $delivery_method->id }}"
                        {{ ($delivery_method->id === $order->delivery_method_id) ? 'selected' : '' }}>
                        {{ $delivery_method->name }}</option>
                    @endforeach
                </select>
            </div>
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
            <label for="inputTotalPrice" class="col-sm-2 col-form-label">Total:</label>
            <div class="col-sm-10 text-right">
                <p>
                    <small class="text-muted"><i>Payment: {{ $order->payment->price_factor*100 - 100 }}%</i></small>
                    <br>
                    <small class="text-muted"><i>Delivery: ${{ $order->delivery_method->price_factor}}</i></small>
                    <br>
                    <strong>${{ $order->total_price }}</strong>
                </p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-light btn-sm" name="recalculate" value="1">🔄 Recalculate total
                    price</button>
            </div>
            <div class="col-sm-6 text-right">
                <button type="submit" class="btn btn-dark" name="checkout" value="1">✔ Place an order</button>
            </div>
        </div>
    </x-form>
    @else
    <h3>🛒</h3>
    <p class="text-muted">Shopping basket</p>
    @endif
</div>
