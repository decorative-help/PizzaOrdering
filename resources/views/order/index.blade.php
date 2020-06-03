@extends('app')


@section('title', 'Order')
@section('content')
<div class="row">
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
                @foreach ($ordered_pizzas as $ordered_pizza)
                <tr>
                    <td>{{ $ordered_pizza->pizza->name }}</td>
                    {{-- <td>{{ $ordered_pizza->size()->name }}</td>
                    <td>{{ $ordered_pizza->topping()->name }}</td>
                    <td>{{ $ordered_pizza->quantity()->name }}</td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="textareaComments">Address and comments</label>
            <textarea class="form-control" id="textareaComments" name="comments"
                aria-describedby="comments">{{ old('comments') ?? $order->comments }}</textarea>
            <small id="comments" class="form-text text-muted">Your intercom pincode and floor number
                speed up our
                delivery</small>
        </div>
        <button type="submit" class="btn btn-primary">Update Order Details</button>
        or
        <a href="{{ route('order.finish', $order->id) }}">Place an order</a>
    </form>
</div>
@endsection
