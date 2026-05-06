<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'CartMasala - Spice Shop')</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-black:#000;--color-white:#fff;--text-base:1rem;--leading-normal:1.5;--radius-lg:.5rem;--spacing:.25rem;}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,body{font-family:var(--font-sans);line-height:1.5}img{max-width:100%;height:auto}button,input,select,textarea{font:inherit}}@layer utilities{.min-h-screen{min-height:100vh}.bg-[#fff8f0]{background-color:#fff8f0}.bg-[#1b1b18]{background-color:#1b1b18}.bg-[#f7f0e6]{background-color:#f7f0e6}.bg-[#e8d8c1]{background-color:#e8d8c1}.bg-[#fff2f2]{background-color:#fff2f2}.bg-[#f5f5f2]{background-color:#f5f5f2}.text-[#1b1b18]{color:#1b1b18}.text-[#4d4a47]{color:#4d4a47}.text-[#7d6f53]{color:#7d6f53}.text-[#f53003]{color:#f53003}.text-white{color:#fff}.font-semibold{font-weight:600}.font-medium{font-weight:500}.font-bold{font-weight:700}.leading-tight{line-height:1.25}.shadow-lg{box-shadow:0 15px 30px rgba(0,0,0,0.12)}.rounded-2xl{border-radius:1rem}.rounded-xl{border-radius:.75rem}.rounded-full{border-radius:9999px}.border{border-width:1px}.border-[#e5d5c2]{border-color:#e5d5c2}.border-[#f0dbcf]{border-color:#f0dbcf}.p-6{padding:1.5rem}.p-8{padding:2rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.py-6{padding-top:1.5rem;padding-bottom:1.5rem}.m-4{margin:1rem}.mb-6{margin-bottom:1.5rem}.mb-4{margin-bottom:1rem}.mb-2{margin-bottom:.5rem}.mt-2{margin-top:.5rem}.mt-4{margin-top:1rem}.grid{display:grid}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}.sm\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.lg\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.gap-6{gap:1.5rem}.text-sm{font-size:.875rem}.text-base{font-size:1rem}.text-lg{font-size:1.125rem}.text-xl{font-size:1.25rem}.text-2xl{font-size:1.5rem}.uppercase{text-transform:uppercase}.tracking-[0.12em]{letter-spacing:.12em}.hover\:bg-[#1b1b18]:hover{background-color:#1b1b18}.hover\:text-white:hover{color:#fff}.transition{transition:all .2s ease}.duration-200{transition-duration:.2s}.w-full{width:100%}.max-w-7xl{max-width:80rem}.mx-auto{margin-left:auto;margin-right:auto}.flex{display:flex}.items-center{align-items:center}.justify-between{justify-content:space-between}.justify-center{justify-content:center}.flex-col{flex-direction:column}.sm\:flex-row{flex-direction:row}.gap-4{gap:1rem}.rounded-lg{border-radius:.5rem}.overflow-hidden{overflow:hidden}.bg-cover{background-size:cover}.bg-center{background-position:center}.border-none{border:none}.cursor-pointer{cursor:pointer}}</style>
        @endif
    </head>
    <body class="bg-[#fff8f3] text-[#1b1b18] min-h-screen">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <header class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-10">
                <div>
                    <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">CartMasala</p>
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#1b1b18]">Your online spice marketplace</h1>
                </div>
                <nav class="flex flex-wrap items-center gap-4 text-sm text-[#4d4a47]">
                    <a href="#products" class="hover:text-[#f53003]">Spices</a>
                    <a href="#how-it-works" class="hover:text-[#f53003]">Order Process</a>
                    <a href="#features" class="hover:text-[#f53003]">Benefits</a>
                    <a href="{{ route('cart.index') }}" class="hover:text-[#f53003] relative">
                        Cart
                        @php
                            $cartCount = 0;
                            try {
                                $identifier = ['user_id' => Auth::id(), 'session_id' => Auth::id() ? null : session()->getId()];
                                $cart = \App\Models\Cart::getCart($identifier['user_id'], $identifier['session_id']);
                                $cartCount = $cart ? count($cart->getCartData()) : 0;
                            } catch (\Exception $e) {
                                $cartCount = 0;
                            }
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-[#f53003] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-[#f53003]">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-[#f53003]">Register</a>
                    @else
                        <span class="text-[#7d6f53]">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-[#f53003]">Logout</button>
                        </form>
                    @endguest
                </nav>
                <a href="tel:+919000000000" class="rounded-full bg-[#1b1b18] px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-[#f53003]">Call Now</a>
            </header>

            @yield('content')

            <footer class="mt-16 border-t border-[#e5d5c2] pt-8 text-sm text-[#4d4a47]">
                <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p>© 2026 CartMasala. All rights reserved.</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="#products" class="hover:text-[#f53003]">Spices</a>
                        <a href="#how-it-works" class="hover:text-[#f53003]">Order Process</a>
                        <a href="#features" class="hover:text-[#f53003]">Benefits</a>
                        <a href="mailto:hello@cartmasala.com" class="hover:text-[#f53003]">hello@cartmasala.com</a>
                    </div>
                </div>
            </footer>
        </div>


        @stack('scripts')
    </body>
</html>
