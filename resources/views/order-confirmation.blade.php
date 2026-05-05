@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
        <div class="min-h-screen flex items-center justify-center">
            <div class="max-w-xl mx-auto bg-white rounded-3xl shadow-xl p-8 text-center">
                <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Order placed</p>
                <h1 class="text-2xl font-semibold mt-4">Shukriya!</h1>
                <p class="text-[#4d4a47] mt-4">Your order request has been received. See the order summary below:</p>
                <div class="mt-6 rounded-3xl border border-[#e5d5c2] bg-[#f7f0e6] p-6 text-left">
                    <p class="text-sm text-[#7d6f53]">Order ID: <span class="font-semibold text-[#1b1b18]">{{ $orderId }}</span></p>
                    <div class="mt-4 space-y-3">
                        @foreach($cartData as $item)
                            <div class="border-b border-[#e5d5c2] pb-3 last:border-b-0 last:pb-0">
                                <p class="text-lg font-semibold text-[#1b1b18]">{{ $item['name'] }}</p>
                                <p class="text-sm text-[#7d6f53]">Quantity: {{ $item['quantity'] }} × ₹{{ $item['price'] }} / {{ $item['unit'] }}</p>
                                <p class="text-sm font-semibold text-[#1b1b18]">Subtotal: ₹{{ $item['price'] * $item['quantity'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-lg font-semibold text-[#1b1b18] mt-4 pt-3 border-t border-[#e5d5c2]">Total: ₹{{ $total }}</p>
                </div>
                <div class="inline-flex items-center gap-2 mt-6 rounded-full bg-[#f7f0e6] px-4 py-2 text-[#4d4a47] border border-[#e5d5c2]">
                    <span>Delivery in 1-2 days</span>
                </div>
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center mt-8 w-full rounded-full bg-[#1b1b18] text-white py-3 transition duration-200 hover:bg-[#f53003]">Back to Home</a>
            </div>
        </div>

@endsection
