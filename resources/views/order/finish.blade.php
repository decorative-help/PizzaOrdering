@extends('layout.app')

@section('title', 'Order')

@section('layout')
<div class="container">
    @include('_header')
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">{{ $order->id }}</h1>
                <p class="lead">This is your order number</p>
                <hr class="my-4">
                <p>Remember it to identify your order</p>
                <a class="btn btn-primary btn-lg" href="tel:87882323" role="button">Call Pizza Assistant</a>
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
                        <th scope="col">Size</th>
                        <th scope="col">Topping</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->ordered_pizzas as $ordered_pizza)
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
    </div>
</div>
@endsection
