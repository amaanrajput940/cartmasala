<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $spices = [
        [
            'name' => 'Haldi (Turmeric)',
            'price' => '120',
            'unit' => '100g',
            'description' => 'Taaza haldi powder for masaledar sabzi aur health drinks.',
            'image' => 'https://images.unsplash.com/photo-1528825871115-3581a5387919?auto=format&fit=crop&w=640&q=80',
        ],
        [
            'name' => 'Lal Mirch (Red Chili)',
            'price' => '90',
            'unit' => '100g',
            'description' => 'Garama-garam lal mirch powder for tadka aur biryani.',
            'image' => 'https://images.unsplash.com/photo-1516684669134-de6f445c4bbf?auto=format&fit=crop&w=640&q=80',
        ],
        [
            'name' => 'Dhaniya (Coriander)',
            'price' => '75',
            'unit' => '100g',
            'description' => 'Meethay aur khushbudar dhaniya powder for dal aur gravy.',
            'image' => 'https://images.unsplash.com/photo-1513193431375-05c7a759d3cf?auto=format&fit=crop&w=640&q=80',
        ],
        [
            'name' => 'Garam Masala',
            'price' => '150',
            'unit' => '100g',
            'description' => 'Shop ke sabse popular garam masala blend, har dish ke liye perfect.',
            'image' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=640&q=80',
        ],
    ];

    return view('home', compact('spices'));
});

Route::post('/order', function (Request $request) {
    $product = $request->input('product');
    $price = (int) $request->input('price', 0);
    $quantity = max(1, (int) $request->input('quantity', 1));
    $total = $price * $quantity;
    $orderId = 'CM-' . strtoupper(substr(md5(uniqid('', true)), 0, 8));

    return view('order-confirmation', compact('product', 'price', 'quantity', 'total', 'orderId'));
})->name('order.submit');
