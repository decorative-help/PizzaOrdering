<div class="row mb-4">
    <div class="col text-left">
        <h2>{{ $title }}</h2>
    </div>
    <div class="col text-center">
        <a href="{{ route('home') }}" title="Menu page">
            <h1>🍕</h1>
        </a>
    </div>
    <div class="col text-right">
        @isset($order)
        <p>
            <a href="#basket" class="btn btn-light">
                🛒
                <span class="badge badge-secondary">{{ $order->ordered_pizzas->count() }}</span>
                pizzas in a bag
            </a>
        </p>
        @endisset
    </div>
</div>
