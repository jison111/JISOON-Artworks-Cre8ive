<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showSellerRequests()
    {
        $users = User::where('role', 2)->get(); // Get users who applied to be sellers
        return view('sellerRequests', compact('users'));
    }

    public function approveSeller(Request $request, User $user)
    {
        $user->role = 3; // Change role to seller
        $user->save();

        return redirect()->route('admin.sellerRequests')->with('success', 'Seller approved successfully.');
    }
}