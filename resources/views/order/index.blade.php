<div class="row px-2">
    @if (isset($order))
    <div class="table-responsive">
        <table class="table table-borderless table-hover table-sm">
            <caption>Ordered Pizzas</caption>
            <thead>
                <tr>
                    <th scope="col">Pizza</th>
                    <th scope="col">Size</th>
                    <th scope="col">Topping</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->ordered_pizzas as $ordered_pizza)
                <tr>
                    <td>{{ $ordered_pizza->pizza->name }}</td>
                    <td>{{ $ordered_pizza->size->name }}</td>
                    <td>{{ $ordered_pizza->topping->name }}</td>
                    <td>{{ $ordered_pizza->quantity }}</td>
                </tr>
                @empty
                <tr>
                    <td>No pizzas yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="selectPaymentMethod">Payment</label>
            <select class="form-control" id="selectPaymentMethod">
                @foreach ($payments as $payment_method)
                <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="selectDeliveryMethod">Delivery</label>
            <select class="form-control" id="selectDeliveryMethod">
                @foreach ($delivery_methods as $delivery_method)
                <option value="{{ $delivery_method->id }}">{{ $delivery_method->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="textareaComments">Address and comments</label>
            <textarea class="form-control" id="textareaComments" name="comments" aria-describedby="comments"
                placeholder="Intercom is 453. The red door">{{ old('comments') ?? $order->comments }}</textarea>
            <small id="comments" class="form-text text-muted">Your intercom pincode and floor number
                speed up our
                delivery</small>
        </div>
        <button type="submit" class="btn btn-light btn-sm">🔄 Update Order Details</button> <a
            href="{{ route('order.finish', $order->id) }}" class="btn btn-dark">✔ Place an order</a>
    </form>
    @else
    <h3>🛒</h3>
    <p class="text-muted">Shopping basket</p>
    @endif
</div>
