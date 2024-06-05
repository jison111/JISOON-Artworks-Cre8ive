<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/minus/{n1}/{n2}', function ($n1, $n2) {
    if (!is_numeric($n1) || !is_numeric($n2)) {
        return 'Invalid input';
    }

    $difference = $n1 - $n2;
    return 'The difference is ' .$difference;
});

Route::delete('/multiply/{n1}/{n2}', function ($n1, $n2) {
    if (!is_numeric($n1) || !is_numeric($n2)) {
        return 'Invalid input';
    }

    $product = $n1 * $n2;
    return 'The product is ' .$product;
});

Route::post('/divide/{n1}/{n2}', function ($n1, $n2) {
    if (!is_numeric($n1) || !is_numeric($n2)) {
        return 'Invalid input';
    }
    if ($n2 == 0) {
        return 'Divisor should not be equal to zero';
    }
    $quotient = $n1 / $n2;
    return 'The quotient is ' .$quotient;
});