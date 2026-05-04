<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $spices = [
        [
            'name' => 'Turmeric (Haldi)',
            'price' => '120',
            'unit' => '100g',
            'description' => 'Fresh turmeric powder for flavorful curries and healthy drinks.',
            'image' => 'https://images.unsplash.com/photo-1528825871115-3581a5387919?auto=format&fit=crop&w=640&q=80',
        ],
        [
            'name' => 'Red Chili (Lal Mirch)',
            'price' => '90',
            'unit' => '100g',
            'description' => 'Spicy red chili powder perfect for tempering and biryani.',
            'image' => 'https://images.unsplash.com/photo-1516684669134-de6f445c4bbf?auto=format&fit=crop&w=640&q=80',
        ],
        [
            'name' => 'Coriander (Dhaniya)',
            'price' => '75',
            'unit' => '100g',
            'description' => 'Sweet and aromatic coriander powder for dal and gravy.',
            'image' => 'https://images.unsplash.com/photo-1513193431375-05c7a759d3cf?auto=format&fit=crop&w=640&q=80',
        ],
        [
            'name' => 'Garam Masala',
            'price' => '150',
            'unit' => '100g',
            'description' => 'Our most popular garam masala blend, perfect for every dish.',
            'image' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=640&q=80',
        ],
    ];

    return view('home', compact('spices'));
});

Route::post('/review', function (Request $request) {
    $product = $request->input('product');
    $price = (int) $request->input('price', 0);
    $quantity = max(1, (int) $request->input('quantity', 1));
    $unit = $request->input('unit');
    $total = $price * $quantity;

    return view('review', compact('product', 'price', 'quantity', 'unit', 'total'));
})->name('order.review');

Route::post('/order', function (Request $request) {
    $product = $request->input('product');
    $price = (int) $request->input('price', 0);
    $quantity = max(1, (int) $request->input('quantity', 1));
    $total = $price * $quantity;
    $orderId = 'CM-' . strtoupper(substr(md5(uniqid('', true)), 0, 8));

    return view('order-confirmation', compact('product', 'price', 'quantity', 'total', 'orderId'));
})->name('order.submit');
