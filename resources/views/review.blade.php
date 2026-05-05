@extends('layouts.app')

@section('title', 'Order Review')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-xl p-8">
        <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Order Review</p>
        <h1 class="text-2xl font-semibold mt-4">Review your order</h1>
        <p class="text-[#4d4a47] mt-4">Below is your cart summary. Please review and confirm.</p>

        <div class="mt-6 space-y-4">
            @foreach($cartData as $item)
                <div class="rounded-3xl border border-[#e5d5c2] bg-[#f7f0e6] p-6">
                    <p class="text-sm text-[#7d6f53]">Product:</p>
                    <p class="text-xl font-semibold text-[#1b1b18] mt-2">{{ $item['name'] }}</p>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <p class="text-sm text-[#7d6f53]">Unit price:</p>
                            <p class="font-semibold text-[#1b1b18]">₹{{ $item['price'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-[#7d6f53]">Quantity:</p>
                            <p class="font-semibold text-[#1b1b18]">{{ $item['quantity'] }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-[#7d6f53] mt-2">Unit: {{ $item['unit'] }}</p>
                    <p class="text-lg font-semibold text-[#1b1b18] mt-4">Subtotal: ₹{{ $item['price'] * $item['quantity'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6 rounded-3xl border border-[#e5d5c2] bg-[#f7f0e6] p-6 text-center">
            <p class="text-lg font-semibold text-[#1b1b18]">Total: ₹{{ $total }}</p>
        </div>

        <form method="POST" action="{{ route('order.submit') }}" class="mt-8 space-y-4">
            @csrf
            @foreach($cartData as $product => $item)
                <input type="hidden" name="cart[{{ $product }}][name]" value="{{ $item['name'] }}">
                <input type="hidden" name="cart[{{ $product }}][price]" value="{{ $item['price'] }}">
                <input type="hidden" name="cart[{{ $product }}][unit]" value="{{ $item['unit'] }}">
                <input type="hidden" name="cart[{{ $product }}][quantity]" value="{{ $item['quantity'] }}">
            @endforeach
            <input type="hidden" name="total" value="{{ $total }}">

            <button type="submit" class="w-full rounded-full bg-[#1b1b18] px-6 py-4 text-sm font-semibold text-white transition duration-200 hover:bg-[#f53003]">Confirm Order</button>
        </form>

        <a href="{{ route('cart.index') }}" class="inline-flex items-center justify-center mt-4 w-full rounded-full border border-[#e5d5c2] bg-white px-6 py-4 text-sm font-semibold text-[#1b1b18] transition duration-200 hover:bg-[#f5f5f2]">Back to Cart</a>
    </div>
</div>
@endsection
