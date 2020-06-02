<div class="row mb-4">
    <div class="col text-left">
        <h1>@yield('title')</h1>
    </div>
    <div class="col text-center">
        <h2>
            <a href="{{ route('home') }}" title="Menu page">🍕</a>
        </h2>
    </div>
    <div class="col text-right">
        @isset($ordered_pizzas_number)
        <p>
            <a href="/order" title="Open a bag">{{ $ordered_pizzas_number }}</a>
            pizzas in a bag
        </p>
        @endisset
    </div>
</div>
