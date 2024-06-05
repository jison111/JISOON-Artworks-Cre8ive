<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Artwork;

class ArtistController extends Controller
{
    public function profile()
    {
        // Get the authenticated user
        $artist = Auth::user();

        // Fetch all artworks related to the artist
        $artworks = Artwork::where('user_id', $artist->id)->get();

        // Return the profile view with the artist's artworks
        return view('profile', compact('artist', 'artworks'));
    }
}
