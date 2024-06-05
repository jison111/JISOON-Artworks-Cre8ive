<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Validate the request data
        $request->validate([
            'shippingAddress' => 'required|string|max:255',
            'contactNumber' => 'required|string|max:15',
            'paymentMethod' => 'required|string|in:cash_on_delivery,card,gcash,paypal,paymaya',
        ]);

        // Retrieve the cart items from the session
        $cartItems = Session::get('cart', []);
        if (count($cartItems) == 0) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Log cart items for debugging
        Log::info('Cart Items:', $cartItems);

        // Create a new order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->shipping_address = $request->shippingAddress;
        $order->contact_number = $request->contactNumber;
        $order->payment_method = $request->paymentMethod;
        $order->total_amount = collect($cartItems)->sum('artwork.price'); // Adjust calculation as needed
        $order->save();

        // Log order creation
        Log::info('Order Created:', $order->toArray());

        // Save order items
        foreach ($cartItems as $item) {
            $artwork = Artwork::find($item['artwork_id']);
            if ($artwork) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->artwork_id = $item['artwork_id'];
                $orderItem->price = $artwork->price;
                $orderItem->quantity = $item['quantity'];
                $orderItem->save();

                // Log each order item
                Log::info('Order Item Created:', $orderItem->toArray());
            } else {
                Log::error('Artwork not found for item:', $item);
            }
        }

        // Clear the cart
        Session::forget('cart');

        // Redirect with success message
        return redirect()->route('index')->with('success', 'Order placed successfully!');
    }
}
