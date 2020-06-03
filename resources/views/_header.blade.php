<div class="row mb-4">
    <div class="col text-left">
        <h2>@yield('title')</h2>
    </div>
    <div class="col text-center">
        <a href="{{ route('home') }}" title="Menu page">
            <h1>🍕</h1>
        </a>
    </div>
    <div class="col text-right">
        @isset($order)
        <p>
            {{ $order->ordered_pizzas->count() }}
            pizzas in a bag
        </p>
        @endisset
    </div>
</div>
