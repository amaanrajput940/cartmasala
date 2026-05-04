<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Order Review</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                @layer base{*,:after,:before{box-sizing:border-box;margin:0;padding:0}html,body{font-family:'Instrument Sans',ui-sans-serif,system-ui,sans-serif;background:#fff8f0;color:#1b1b18;line-height:1.5}}@layer utilities{.min-h-screen{min-height:100vh}.flex{display:flex}.items-center{align-items:center}.justify-center{justify-content:center}.text-center{text-align:center}.max-w-xl{max-width:36rem}.mx-auto{margin-left:auto;margin-right:auto}.p-8{padding:2rem}.rounded-3xl{border-radius:1.5rem}.bg-white{background:#fff}.shadow-xl{box-shadow:0 25px 50px rgba(0,0,0,0.12)}.text-2xl{font-size:1.5rem}.text-sm{font-size:.875rem}.font-semibold{font-weight:600}.font-medium{font-weight:500}.text-[#4d4a47]{color:#4d4a47}.text-[#f53003]{color:#f53003}.mt-6{margin-top:1.5rem}.inline-flex{display:inline-flex}.items-center{align-items:center}.gap-2{gap:.5rem}.rounded-full{border-radius:9999px}.bg-[#f7f0e6]{background:#f7f0e6}.px-4{padding-left:1rem;padding-right:1rem}.py-2{padding-top:.5rem;padding-bottom:.5rem}.text-[#7d6f53]{color:#7d6f53}.border{border:1px solid #e5d5c2}.border-[#e5d5c2]{border-color:#e5d5c2}.text-[#1b1b18]{color:#1b1b18}.hover\:bg-[#1b1b18]:hover{background:#1b1b18}.hover\:text-white:hover{color:#fff}.transition{transition:all .2s ease}}            </style>
        @endif
    </head>
    <body>
        <div class="min-h-screen flex items-center justify-center px-6 py-8">
            <div class="max-w-xl mx-auto bg-white rounded-3xl shadow-xl p-8">
                <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Order Review</p>
                <h1 class="text-2xl font-semibold mt-4">Review your order</h1>
                <p class="text-[#4d4a47] mt-4">Below is your selected spice and quantity. Please review and confirm.</p>

                <div class="mt-6 rounded-3xl border border-[#e5d5c2] bg-[#f7f0e6] p-6">
                    <p class="text-sm text-[#7d6f53]">Product:</p>
                    <p class="text-xl font-semibold text-[#1b1b18] mt-2">{{ $product }}</p>
                    <p class="text-sm text-[#7d6f53] mt-4">Unit price: <span class="font-semibold text-[#1b1b18]">₹{{ $price }}</span></p>
                    <p class="text-sm text-[#7d6f53] mt-2">Quantity: <span class="font-semibold text-[#1b1b18]">{{ $quantity }}</span></p>
                    <p class="text-sm text-[#7d6f53] mt-2">Unit: <span class="font-semibold text-[#1b1b18]">{{ $unit }}</span></p>
                    <p class="text-lg font-semibold text-[#1b1b18] mt-4">Total: ₹{{ $total }}</p>
                </div>

                <form method="POST" action="{{ route('order.submit') }}" class="mt-8 space-y-4">
                    @csrf
                    <input type="hidden" name="product" value="{{ $product }}">
                    <input type="hidden" name="price" value="{{ $price }}">
                    <input type="hidden" name="unit" value="{{ $unit }}">
                    <input type="hidden" name="quantity" value="{{ $quantity }}">

                    <button type="submit" class="w-full rounded-full bg-[#1b1b18] px-6 py-4 text-sm font-semibold text-white transition duration-200 hover:bg-[#f53003]">Confirm Order</button>
                </form>

                <a href="{{ url('/') }}" class="inline-flex items-center justify-center mt-4 w-full rounded-full border border-[#e5d5c2] bg-white px-6 py-4 text-sm font-semibold text-[#1b1b18] transition duration-200 hover:bg-[#f5f5f2]">Back to shop</a>
            </div>
        </div>
    </body>
</html>
