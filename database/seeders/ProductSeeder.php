<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Turmeric (Haldi)',
            'price' => 120.00,
            'unit' => '100g',
            'description' => 'Fresh turmeric powder for flavorful curries and healthy drinks.',
            'image' => 'https://images.unsplash.com/photo-1528825871115-3581a5387919?auto=format&fit=crop&w=640&q=80',
        ]);

        \App\Models\Product::create([
            'name' => 'Red Chili (Lal Mirch)',
            'price' => 90.00,
            'unit' => '100g',
            'description' => 'Spicy red chili powder perfect for tempering and biryani.',
            'image' => 'https://images.unsplash.com/photo-1516684669134-de6f445c4bbf?auto=format&fit=crop&w=640&q=80',
        ]);

        \App\Models\Product::create([
            'name' => 'Coriander (Dhaniya)',
            'price' => 75.00,
            'unit' => '100g',
            'description' => 'Sweet and aromatic coriander powder for dal and gravy.',
            'image' => 'https://images.unsplash.com/photo-1513193431375-05c7a759d3cf?auto=format&fit=crop&w=640&q=80',
        ]);

        \App\Models\Product::create([
            'name' => 'Garam Masala',
            'price' => 150.00,
            'unit' => '100g',
            'description' => 'Our most popular garam masala blend, perfect for every dish.',
            'image' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=640&q=80',
        ]);
    }
}
