<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Cart;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::with('user')->get();
        $cartItems = Cart::where('user_id', Auth::id())->with('artwork')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->artwork->price * $item->quantity;
        });
        return view('index', compact('artworks', 'cartItems', 'total'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'size' => 'required',
            'price' => 'required|numeric',
            'medium' => 'required|in:Paintings,Pencils,Watercolors,Digital Arts,Sculptures',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $artwork = $request->all();
        // $artwork['user_id'] = Auth::id();

        // if ($request->hasFile('image')) {
        //     $path = $request->file('image')->store('images', 'public');
        //     $artwork['image'] = $path;
        // }

        // Artwork::create($artwork);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);
        $artwork = new Artwork();
        $artwork->user_id = Auth::id();
        $artwork->title=$request['title'];
        $artwork->size=$request['size'];
        $artwork->price=$request['price'];
        $artwork->medium=$request['medium'];
        $artwork->image =$imageName;
        $artwork->save();

        return redirect()->route('index')->with('success', 'Artwork added successfully');
    }

    public function addToCart($id)
    {
        $artwork = Artwork::find($id);
    
        if (!$artwork) {
            return redirect()->route('index')->with('error', 'Artwork not found.');
        }
    
        $cart = Cart::where('user_id', Auth::id())->where('artwork_id', $id)->first();
    
        if ($cart) {
            return redirect()->route('index')->with('info', 'Artwork is already in your cart.');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'artwork_id' => $id,
                'quantity' => 1,
            ]);
    
            return redirect()->route('index')->with('success', 'Artwork added to cart.');
        }
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('artwork_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('index')->with('success', 'Artwork removed from cart.');
    }

    // Display artist portfolio
    public function portfolio()
    {
        $user = Auth::user();
        $artworks = Artwork::where('user_id', $user->id)->get();
        return view('portfolio', compact('user', 'artworks'));
    }

    // Edit artwork
    public function edit($id)
    {
        $artwork = Artwork::findOrFail($id);

        if ($artwork->user_id != Auth::id()) {
            return redirect()->route('portfolio')->with('error', 'You are not authorized to edit this artwork.');
        }

        return view('edit', compact('artwork'));
    }

    // Update artwork
    public function update(Request $request, $id)
    {
        $artwork = Artwork::findOrFail($id);

        if ($artwork->user_id != Auth::id()) {
            return redirect()->route('portfolio')->with('error', 'You are not authorized to update this artwork.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'price' => 'required|numeric',
            'medium' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artwork->title = $request->title;
        $artwork->size = $request->size;
        $artwork->price = $request->price;
        $artwork->medium = $request->medium;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $artwork->image = $imageName;
        }

        $artwork->save();

        return redirect()->route('artist.portfolio')->with('success', 'Artwork updated successfully.');
    }

    // Delete artwork
    public function destroy($id)
    {
        $artwork = Artwork::findOrFail($id);

        if ($artwork->user_id != Auth::id()) {
            return redirect()->route('artist.portfolio')->with('error', 'You are not authorized to delete this artwork.');
        }

        $artwork->delete();

        return redirect()->route('artist.portfolio')->with('success', 'Artwork deleted successfully.');
    }


    public function addToFavorites($id)
    {
        $artwork = Artwork::find($id);

        if (!$artwork) {
            return redirect()->route('index')->with('error', 'Artwork not found.');
        }

        Favorite::create([
            'user_id' => Auth::id(),
            'artwork_id' => $id,
        ]);

        return redirect()->route('index')->with('success', 'Artwork added to favorites.');
    }

    public function removeFromFavorites($id)
    {
        $favorite = Favorite::where('user_id', Auth::id())->where('artwork_id', $id)->first();

        if ($favorite) {
            $favorite->delete();
        }

        return redirect()->route('index')->with('success', 'Artwork removed from favorites.');
    }

    public function favorites()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('artwork')->get();
        return view('favorites', compact('favorites'));
    }
}
