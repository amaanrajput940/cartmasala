@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="mb-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-[#7d6f53] uppercase tracking-[0.12em]">Your Cart</p>
            <h2 class="text-2xl sm:text-3xl font-semibold mt-2">Review your selected spices</h2>
        </div>
        @if(count($cartData) > 0)
            <form method="POST" action="{{ route('cart.clear') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm text-[#f53003] hover:text-[#d42a00]">Clear Cart</button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-[#f7f0e6] border border-[#e5d5c2] rounded-xl text-[#1b1b18]">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cartData) > 0)
        <form method="POST" action="{{ route('cart.update') }}">
            @csrf
            <div class="grid gap-6 mb-8">
                @foreach($cartData as $product => $item)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-[#f0dbcf]">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold">{{ $item['name'] }}</h3>
                                <form method="POST" action="{{ route('cart.remove', $product) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-[#f53003] hover:text-[#d42a00] text-sm">Remove</button>
                                </form>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <div>
                                    <p class="text-sm text-[#7d6f53]">Price per unit</p>
                                    <p class="font-semibold">₹{{ $item['price'] }} / {{ $item['unit'] }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm text-[#7d6f53] mb-2">Quantity</label>
                                    <select name="quantities[{{ $product }}]" class="rounded-xl border border-[#e5d5c2] px-3 py-2 text-sm">
                                        @for ($i = 0; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>
                                                {{ $i == 0 ? 'Remove' : $i . ' pack' }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-[#7d6f53]">Subtotal</p>
                                    <p class="font-semibold text-lg">₹{{ $item['price'] * $item['quantity'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                <button type="submit" class="bg-[#1b1b18] text-white rounded-xl px-6 py-3 transition duration-200 hover:bg-[#f53003]">
                    Update Cart
                </button>
                <div class="text-right">
                    <p class="text-sm text-[#7d6f53]">Total Amount</p>
                    <p class="text-2xl font-bold text-[#1b1b18]">₹{{ $total }}</p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('order.review') }}" class="inline-flex items-center justify-center bg-[#f53003] text-white rounded-xl px-8 py-4 text-lg font-semibold transition duration-200 hover:bg-[#d42a00]">
                    Proceed to Checkout
                </a>
            </div>
        </form>
    @else
        <div class="text-center py-12">
            <p class="text-lg text-[#4d4a47] mb-6">Your cart is empty</p>
            <a href="{{ url('/') }}#products" class="inline-flex items-center justify-center bg-[#1b1b18] text-white rounded-xl px-6 py-3 transition duration-200 hover:bg-[#f53003]">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection
