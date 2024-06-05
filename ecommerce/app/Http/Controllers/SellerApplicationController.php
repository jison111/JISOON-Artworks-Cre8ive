<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerApplicationController extends Controller
{
    public function showApplicationForm()
    {
        return view('applySeller');
    }

    public function applySeller(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->update(['role' => 3]); // Update the user's role
            return redirect()->route('applySeller')->with('success', 'Application submitted successfully. Please wait for admin approval.');
        }

        return redirect()->route('login')->with('error', 'You need to log in first.');
    }
}
