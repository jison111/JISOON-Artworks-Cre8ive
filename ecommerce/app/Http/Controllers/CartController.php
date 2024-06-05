<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('cart', compact('cart', 'totalPrice'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Artwork removed from cart successfully!');
    }

    public function addToCart(Request $request)
    {
        $cart = Cart::create([
            'user_id' => auth()->id(),
            'artwork_id' => $request->artwork_id,
            'quantity' => $request->quantity ?? 1,
        ]);

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }
}

