<?php

// use App\Http\Controllers\ArtworkController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\SellerApplicationController;
// use App\Http\Controllers\LoginController;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerApplicationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CartController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });
// Default route
Route::get('/', [ArtworkController::class, 'index'])->name('index');

// Login and Signup routes
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'login']);
Route::get('/signup', function () {
    return view('signup');
})->name('signup')->middleware('guest');
Route::post('/signup', [UserController::class, 'signup']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Artwork routes
Route::get('/artworks/create', [ArtworkController::class, 'create'])->name('create')->middleware('auth');
Route::post('/artworks', [ArtworkController::class, 'store'])->name('store');

//Add to cart
Route::post('/artworks/{id}/add-to-cart', [ArtworkController::class, 'addToCart'])->name('addToCart');
Route::post('/artworks/{id}/remove-from-cart', [ArtworkController::class, 'removeFromCart'])->name('removeFromCart');

Route::get('/', [ArtworkController::class, 'index'])->name('index');
Route::get('cart/add/{id}', [ArtworkController::class, 'addToCart'])->name('cart.add');

// // Seller Application routes
// Route::get('/apply-seller', [SellerApplicationController::class, 'showApplicationForm'])->name('applySeller')->middleware('auth');
// Route::post('/apply-seller', [SellerApplicationController::class, 'applySeller'])->name('applySeller.submit')->middleware('auth');

// // Admin routes
// Route::middleware('auth', 'admin')->group(function () {
//     Route::get('/admin/seller-requests', [AdminController::class, 'showSellerRequests'])->name('admin.sellerRequests');
//     Route::post('/admin/seller-requests/{user}/approve', [AdminController::class, 'approveSeller'])->name('admin.approveSeller');
// });

// Apply to be a seller
Route::get('/apply-seller', function () {
    return view('applySeller');
})->name('applySeller')->middleware('auth');

Route::post('/apply-seller', [ApplyController::class, 'store'])->name('applySeller.submit')->middleware('auth');

// Admin routes
Route::get('/admin/applications', [ApplyController::class, 'index'])->name('admin.applications');
Route::post('/admin/applications/{id}/approve', [ApplyController::class, 'approve'])->name('admin.approve');
Route::post('/admin/applications/{id}/reject', [ApplyController::class, 'reject'])->name('admin.reject');

// Artist's portfolio
Route::get('/artist/portfolio', [ArtworkController::class, 'portfolio'])->name('artist.portfolio')->middleware('auth');

// Edit artwork
Route::get('/artist/artworks/{id}/edit', [ArtworkController::class, 'edit'])->name('artworks.edit')->middleware('auth');
Route::post('/artist/artworks/{id}/update', [ArtworkController::class, 'update'])->name('artworks.update')->middleware('auth');

// Delete artwork
Route::delete('/artist/artworks/{id}/delete', [ArtworkController::class, 'destroy'])->name('artworks.destroy')->middleware('auth');

//Favorites
Route::get('/favorites', [ArtworkController::class, 'favorites'])->name('favorites')->middleware('auth');
Route::post('/artworks/{id}/favorite', [ArtworkController::class, 'addToFavorites'])->name('artworks.favorite')->middleware('auth');
Route::post('/artworks/{id}/unfavorite', [ArtworkController::class, 'removeFromFavorites'])->name('artworks.unfavorite')->middleware('auth');

//Checkout
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
