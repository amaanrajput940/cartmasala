@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto bg-white rounded-3xl shadow-xl p-8">
        <h1 class="text-2xl font-semibold text-center mb-6">Login to CartMasala</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm text-[#7d6f53] mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full rounded-xl border border-[#e5d5c2] px-4 py-3 text-[#1b1b18] focus:border-[#f53003] focus:outline-none">
                @error('email')
                    <p class="text-[#f53003] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm text-[#7d6f53] mb-2">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full rounded-xl border border-[#e5d5c2] px-4 py-3 text-[#1b1b18] focus:border-[#f53003] focus:outline-none">
                @error('password')
                    <p class="text-[#f53003] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-[#1b1b18] text-white rounded-xl py-3 transition duration-200 hover:bg-[#f53003]">
                Login
            </button>
        </form>

        <p class="text-center mt-6 text-sm text-[#4d4a47]">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-[#f53003] hover:text-[#d42a00]">Register here</a>
        </p>
    </div>
</div>
@endsection
