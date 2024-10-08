@extends('layouts.app')

@section('content')
    <h2>Your Cart</h2>

    @if($carts->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Food Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            @php
                $totalPrice = 0;
            @endphp

            @foreach ($carts as $cart)
                <tr>
                    <td>{{ $cart->foodItem->name }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>${{ $cart->foodItem->price * $cart->quantity }}</td>
                </tr>
                @php
                    // Add the price for each cart item to the total
                    $totalPrice += $cart->foodItem->price * $cart->quantity;
                @endphp
            @endforeach
            </tbody>
        </table>

        <!-- Display the Total Price -->
        <div class="d-flex justify-content-end">
            <h4>Total Price: ${{ number_format($totalPrice, 2) }}</h4>
        </div>

        <!-- Buy Now Button -->
        <form action="/checkout" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Buy Now</button>
        </form>
    @endif

    <!-- Modal to show after purchase -->
    @if (session('purchase'))
        <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="purchaseModalLabel">Thank You!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ session('purchase') }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Show modal via Bootstrap JS -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var purchaseModal = new bootstrap.Modal(document.getElementById('purchaseModal'));
                purchaseModal.show();
            });
        </script>
    @endif
@endsection
