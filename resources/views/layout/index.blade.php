<x-app title="Menu">
    <div class="container-fluid">
        <x-header title="Menu" :order="$order" />
        <div class="row justify-content-around">
            <div class="col-md-8">
                @include('pizza.index')
            </div>
            <div class="col-md-4">
                @include('order.index')
            </div>
        </div>
        <div class="row">
            @if(isset($errors))
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>
</x-app>
