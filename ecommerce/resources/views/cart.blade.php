<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="">
</head>
<body>
<div class="h-screen bg-gray-300">
    <div class="py-12">
        <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg md:max-w-5xl">
            <div class="md:flex">
                <div class="w-full p-4 px-5 py-5">
                    <div class="md:grid md:grid-cols-3 gap-2">
                        <div class="col-span-2 p-5">
                            <h1 class="text-xl font-medium">Shopping Cart</h1>
                            
                            @foreach ($cart as $id => $details)
                                <div class="flex justify-between items-center mt-6 pt-6">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $details['image']) }}" width="60" class="rounded-full">
                                        <div class="flex flex-col ml-3">
                                            <span class="md:text-md font-medium">{{ $details['title'] }}</span>
                                            <span class="text-xs font-light text-gray-400">{{ $id }}</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center">
                                        <div class="pr-8">
                                            <span class="text-xs font-medium">${{ number_format($details['price'], 2) }}</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('cart.remove', $id) }}" class="text-xs font-medium text-red-500">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="flex justify-between items-center mt-6 pt-6 border-t">
                                <div class="flex items-center">
                                    <a href="{{ route('index') }}" class="text-md font-medium text-blue-500">Continue Shopping</a>
                                </div>
                                <div class="flex justify-center items-end">
                                    <span class="text-sm font-medium text-gray-400 mr-1">Subtotal:</span>
                                    <span class="text-lg font-bold text-gray-800">${{ number_format($totalPrice, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 bg-gray-800 rounded overflow-visible">
                            <span class="text-xl font-medium text-gray-100 block pb-3">Card Details</span>
                            <span class="text-xs text-gray-400">Card Type</span>
                            <div class="overflow-visible flex justify-between items-center mt-2">
                                <div class="rounded w-52 h-28 bg-gray-500 py-2 px-4 relative right-10">
                                    <span class="italic text-lg font-medium text-gray-200 underline">VISA</span>
                                    <div class="flex justify-between items-center pt-4">
                                        <span class="text-xs text-gray-200 font-medium">****</span>
                                        <span class="text-xs text-gray-200 font-medium">****</span>
                                        <span class="text-xs text-gray-200 font-medium">****</span>
                                        <span class="text-xs text-gray-200 font-medium">****</span>
                                    </div>
                                    <div class="flex justify-between items-center mt-3">
                                        <span class="text-xs text-gray-200">Giga Tamarashvili</span>
                                        <span class="text-xs text-gray-200">12/18</span>
                                    </div>
                                </div>
                                <div class="flex justify-center items-center flex-col">
                                    <img src="https://img.icons8.com/color/96/000000/mastercard-logo.png" width="40" class="relative right-5" />
                                    <span class="text-xs font-medium text-gray-200 bottom-2 relative right-5">mastercard.</span>
                                </div>
                            </div>
                            <div class="flex justify-center flex-col pt-3">
                                <label class="text-xs text-gray-400">Name on Card</label>
                                <input type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="Giga Tamarashvili">
                            </div>
                            <div class="flex justify-center flex-col pt-3">
                                <label class="text-xs text-gray-400">Card Number</label>
                                <input type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="**** **** **** ****">
                            </div>
                            <div class="grid grid-cols-3 gap-2 pt-2 mb-3">
                                <div class="col-span-2">
                                    <label class="text-xs text-gray-400">Expiration Date</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="mm">
                                        <input type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="yyyy">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400">CVV</label>
                                    <input type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="XXX">
                                </div>
                            </div>
                            <button class="h-12 w-full bg-blue-500 rounded focus:outline-none text-white hover:bg-blue-600">Check Out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
