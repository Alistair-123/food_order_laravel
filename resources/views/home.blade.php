@extends('layouts.app')

@section('content')
<style>
    .card {
        width: 250px; /* Fixed width */
        height: 350px; /* Fixed height */
        margin: 5px; /* Reduce the space between cards */
        padding: 10px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title, .card-text {
        font-size: 14px;
        margin: 0;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between; /* Adjust spacing between cards */
    }

    .col-md-3 {
        flex: 0 0 24%; /* 4 cards per row */
        max-width: 24%;
        margin-bottom: 20px; /* Space between rows */
    }
    button {
        margin-top: 8px;
    }

    input {
        width: 108px;
    }
</style>

    <h1>Food Menu</h1>
    <div class="row">
        @foreach ($foodItems as $foodItem)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $foodItem->image) }}" alt="{{ $foodItem->name }}" />
                    <div class="card-body">
                        <h5 class="card-title">{{ $foodItem->name }}</h5>
                        <p class="card-text">{{ $foodItem->description }}</p>
                        <p class="card-text">Price: ${{ $foodItem->price }}</p>
                        <form action="{{ route('cart.add', ['id' => $foodItem->id]) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" required>
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function addToCart(foodItemId) {
            const quantity = document.getElementById(`quantity-${foodItemId}`).value;
            alert(`Added ${quantity} of item ${foodItemId} to cart`);
        }
    </script>
@endsection
