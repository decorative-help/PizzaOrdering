<div class="row justify-content-around px-2">
    @forelse ($pizzas as $pizza)
    <form method="POST" action="/ordered_pizzas">
        @csrf
        <input type="hidden" name="id" value="{{ $pizza->id }}">
        <div class="card mb-4" style="width: 16rem;">
            <img src="{{ $pizza->image_link }}" class="card-img-top img-fluid" alt="{{ $pizza->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $pizza->name }}</h5>
                <p class="card-text">{{ $pizza->description }}</p>
                <button type="submit" class="btn btn-outline-primary btn-sm">➕ Add to basket</button>
            </div>
        </div>
    </form>
    @empty
    <p>No pizzas yet</p>
    @endforelse
</div>
<div class="row justify-content-around">
    {{ $pizzas->links() }}
</div>
