<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CartController;
use App\Models\User;
use App\Models\Product;

Route::get('/', function () {
    $spices = Product::all()->map(function ($product) {
        return [
            'name' => $product->name,
            'price' => (string)$product->price,
            'unit' => $product->unit,
            'description' => $product->description,
            'image' => $product->image,
        ];
    });

    return view('home', compact('spices'));
});

Route::post('/api/masala-order', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/review', function (Request $request) {
    $identifier = [
        'user_id' => Auth::id(),
        'session_id' => Auth::id() ? null : session()->getId(),
    ];

    $cart = \App\Models\Cart::getCart($identifier['user_id'], $identifier['session_id']);
    $cartData = $cart ? $cart->getCartData() : [];
    $total = 0;

    foreach ($cartData as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return view('review', compact('cartData', 'total'));
})->name('order.review');

Route::post('/submit', function (Request $request) {
    $identifier = [
        'user_id' => Auth::id(),
        'session_id' => Auth::id() ? null : session()->getId(),
    ];

    $cart = \App\Models\Cart::getCart($identifier['user_id'], $identifier['session_id']);
    $cartData = $cart ? $cart->getCartData() : [];
    $total = $request->input('total', 0);
    $orderId = 'ORD-' . strtoupper(uniqid());

    // Clear cart after order using transaction
    \Illuminate\Support\Facades\DB::transaction(function () use ($cart) {
        if ($cart) {
            $cart->setCartData([]);
            $cart->save();
        }
    });

    return view('order-confirmation', compact('cartData', 'total', 'orderId'));
})->name('order.submit');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Transfer guest cart to user cart if exists
        $sessionId = session()->getId();
        $guestCart = \App\Models\Cart::getCart(null, $sessionId);

        if ($guestCart) {
            $userCart = \App\Models\Cart::getOrCreateCart(Auth::id(), null);
            $userCart->mergeCartData($guestCart->getCartData());
            $userCart->save();

            // Delete guest cart
            $guestCart->delete();
        }

        return redirect('/');
    }
    return back()->withErrors(['email' => 'Invalid credentials']);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    session()->forget('cart'); // Clear any session cart data
    return redirect('/');
})->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/');
});

Route::post('/order', function (Request $request) {
    $product = $request->input('product');
    $price = (int) $request->input('price', 0);
    $quantity = max(1, (int) $request->input('quantity', 1));
    $total = $price * $quantity;
    $orderId = 'CM-' . strtoupper(substr(md5(uniqid('', true)), 0, 8));

    return view('order-confirmation', compact('product', 'price', 'quantity', 'total', 'orderId'));
})->name('order.submit');
