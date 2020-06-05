<div class="row justify-content-around px-2">
    @forelse ($pizzas as $pizza)
    <x-form method="POST" action="/ordered_pizzas">
        <input type="hidden" name="id" value="{{ $pizza->id }}">
        <div class="card mb-4" style="width: 16rem;">
            <div class="card-header">
                {{ $pizza->name }}
            </div>
            <img src="{{ $pizza->image_link }}" class="card-img-top img-fluid" alt="{{ $pizza->name }}">
            <div class="card-body">
                <p class="card-text">{{ $pizza->description }}</p>

                <div class="input-group mb-2 mr-sm-2 input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Topping
                        </div>
                    </div>
                    <select class="form-control" id="selectTize_{{ $pizza->id }}" name="topping">
                        @foreach ($toppings as $topping)
                        <option value="{{ $topping->id }}">{{ $topping->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-2 mr-sm-2 input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Size
                        </div>
                    </div>
                    <select class="form-control" id="selectSize_{{ $pizza->id }}" name="size">
                        @foreach ($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-2 mr-sm-2 input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Quantity
                        </div>
                    </div>
                    <input type="number" class="form-control form-control-sm" id="inputQuantity_{{ $pizza->id }}"
                        name="quantity" placeholder="1" min="1" max="25" value="1">
                </div>

            </div>
            <div class="card-footer d-flex flex-row">
                <div class="col-md-4 px-0">${{ $pizza->basic_price }}</div>
                <div class="col-md-8 px-0"><button type="submit" class="btn btn-outline-primary btn-sm">➕ Add
                        to
                        basket</button>
                </div>


            </div>
        </div>
    </x-form>
    @empty
    <p>No pizzas yet</p>
    @endforelse
</div>
<div class="row justify-content-around">
    {{ $pizzas->links() }}
</div>
