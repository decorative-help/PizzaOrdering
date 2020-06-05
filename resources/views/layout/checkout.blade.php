<x-app title="Check Out">
    <div class="container">
        <x-header title="Check Out" />

        @include('order.finish')

        <div class="row">
            @if(isset($errors))
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>
</x-app>
