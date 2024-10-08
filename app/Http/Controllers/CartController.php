<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\FoodItem;
use App\Models\Purchase;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart()
    {
        $carts = Cart::with('foodItem')->get();
        return view('cart', compact('carts'));
    }

    public function addToCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        Cart::create([
            'food_item_id' => $id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.view')->with('success', 'Item added to cart');
    }

    public function checkout(Request $request)
    {
        $carts = Cart::with('foodItem')->get();
        $totalPrice = $carts->sum(fn($cart) => $cart->foodItem->price * $cart->quantity);
        $userName = 'Random User'; // Simulated user name

        Purchase::create([
            'user_name' => $userName,
            'total_price' => $totalPrice,
        ]);

        // Clear the cart after purchase
        Cart::truncate();

        return redirect()->route('cart.view')->with('purchase', 'Thank you for purchasing!');
    }
}
