<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CartMasala - Spice Shop</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-black:#000;--color-white:#fff;--text-base:1rem;--leading-normal:1.5;--radius-lg:.5rem;--spacing:.25rem;}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,body{font-family:var(--font-sans);line-height:1.5}img{max-width:100%;height:auto}button,input,select,textarea{font:inherit}}@layer utilities{.min-h-screen{min-height:100vh}.bg-[#fff8f0]{background-color:#fff8f0}.bg-[#1b1b18]{background-color:#1b1b18}.bg-[#f7f0e6]{background-color:#f7f0e6}.bg-[#e8d8c1]{background-color:#e8d8c1}.bg-[#fff2f2]{background-color:#fff2f2}.bg-[#f5f5f2]{background-color:#f5f5f2}.text-[#1b1b18]{color:#1b1b18}.text-[#4d4a47]{color:#4d4a47}.text-[#7d6f53]{color:#7d6f53}.text-[#f53003]{color:#f53003}.text-white{color:#fff}.font-semibold{font-weight:600}.font-medium{font-weight:500}.font-bold{font-weight:700}.leading-tight{line-height:1.25}.shadow-lg{box-shadow:0 15px 30px rgba(0,0,0,0.12)}.rounded-2xl{border-radius:1rem}.rounded-xl{border-radius:.75rem}.rounded-full{border-radius:9999px}.border{border-width:1px}.border-[#e5d5c2]{border-color:#e5d5c2}.border-[#f0dbcf]{border-color:#f0dbcf}.p-6{padding:1.5rem}.p-8{padding:2rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.py-6{padding-top:1.5rem;padding-bottom:1.5rem}.m-4{margin:1rem}.mb-6{margin-bottom:1.5rem}.mb-4{margin-bottom:1rem}.mb-2{margin-bottom:.5rem}.mt-2{margin-top:.5rem}.mt-4{margin-top:1rem}.grid{display:grid}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}.sm\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.lg\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.gap-6{gap:1.5rem}.text-sm{font-size:.875rem}.text-base{font-size:1rem}.text-lg{font-size:1.125rem}.text-xl{font-size:1.25rem}.text-2xl{font-size:1.5rem}.uppercase{text-transform:uppercase}.tracking-[0.12em]{letter-spacing:.12em}.hover\:bg-[#1b1b18]:hover{background-color:#1b1b18}.hover\:text-white:hover{color:#fff}.transition{transition:all .2s ease}.duration-200{transition-duration:.2s}.w-full{width:100%}.max-w-7xl{max-width:80rem}.mx-auto{margin-left:auto;margin-right:auto}.flex{display:flex}.items-center{align-items:center}.justify-between{justify-content:space-between}.justify-center{justify-content:center}.flex-col{flex-direction:column}.sm\:flex-row{flex-direction:row}.gap-4{gap:1rem}.rounded-lg{border-radius:.5rem}.overflow-hidden{overflow:hidden}.bg-cover{background-size:cover}.bg-center{background-position:center}.border-none{border:none}.cursor-pointer{cursor:pointer}}</style>
        @endif
    </head>
    <body class="bg-[#fff8f0] text-[#1b1b18] min-h-screen">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <section class="relative mb-10 overflow-hidden rounded-2xl p-8 shadow-lg" style="background: radial-gradient(circle at top left, rgba(245,48,3,0.12), transparent 25%), linear-gradient(180deg, #fff8f0, #fdf0e6);">
                <div class="absolute -top-12 -right-16 h-72 w-72 rounded-full bg-[#f53003]/20" style="filter:blur(48px);"></div>
                <div class="relative grid gap-6 sm:grid-cols-2 items-center">
                    <div class="max-w-2xl">
                        <span class="inline-flex items-center rounded-full bg-[#fff2f2] px-4 py-2 text-sm font-semibold text-[#f53003]">Limited offer: 10% off bundle orders</span>
                        <h1 class="mt-6 text-2xl sm:text-3xl font-bold leading-tight text-[#1b1b18]">Spices lekar aaiye apne kitchen mein <span class="text-[#f53003]">rang</span> aur <span class="text-[#f53003]">zayka</span>.</h1>
                        <p class="mt-5 text-base sm:text-lg text-[#4d4a47]">CartMasala par milenge taaza, premium masale jisse aapki sabzi, biryani aur chai mehenge dikhaye bina khaas ban jaayein.</p>
                        <div class="mt-8 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <a href="#products" class="inline-flex items-center justify-center rounded-xl bg-[#1b1b18] px-8 py-4 text-sm font-semibold text-white transition duration-200 hover:bg-[#f53003]">Abhi order karein</a>
                            <div class="rounded-full border border-[#e5d5c2] bg-white px-4 py-3 text-sm text-[#4d4a47]">Cash on delivery available</div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-white p-4 border border-[#f0dbcf] shadow-lg">
                                <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Fresh pack</p>
                                <p class="mt-2 text-sm text-[#4d4a47]">Same-day packing for har order.</p>
                            </div>
                            <div class="rounded-2xl bg-white p-4 border border-[#f0dbcf] shadow-lg">
                                <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Premium quality</p>
                                <p class="mt-2 text-sm text-[#4d4a47]">100% natural ingredients.</p>
                            </div>
                            <div class="rounded-2xl bg-white p-4 border border-[#f0dbcf] shadow-lg">
                                <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Fast delivery</p>
                                <p class="mt-2 text-sm text-[#4d4a47]">Delivery within 1-2 days.</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl overflow-hidden border border-[#f0dbcf] bg-white shadow-lg">
                        <div class="bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1627354957477-224307e11f90?auto=format&fit=crop&w=900&q=80'); height:20rem;"></div>
                        <div class="p-6">
                            <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Best seller bundle</p>
                            <h3 class="mt-4 text-2xl font-semibold text-[#1b1b18]">Spice collection pack</h3>
                            <p class="mt-3 text-sm text-[#4d4a47]">Ideal seasoning set for biryani, curry aur chai. Har packet carefully packed.</p>
                            <div class="mt-6 inline-flex items-center gap-3 rounded-full bg-[#fff2f2] px-4 py-3 text-sm font-semibold text-[#f53003]">Limited stock</div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="products" class="mb-10">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-[#7d6f53] uppercase tracking-[0.12em]">Popular Spices</p>
                        <h2 class="text-2xl sm:text-3xl font-semibold mt-2">Masale jo aapki kitchen ke liye perfect hain</h2>
                    </div>
                    <p class="text-sm text-[#4d4a47]">Cash on delivery available</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($spices as $spice)
                        <article class="bg-white rounded-2xl shadow-lg overflow-hidden border border-[#f0dbcf]">
                            <div class="h-48 bg-cover bg-center" style="background-image:url('{{ $spice['image'] }}');"></div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">{{ $spice['name'] }}</h3>
                                <p class="text-sm text-[#4d4a47] leading-relaxed mb-4">{{ $spice['description'] }}</p>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="font-semibold text-[#1b1b18]">₹{{ $spice['price'] }} / {{ $spice['unit'] }}</span>
                                    <span class="text-sm text-[#7d6f53]">High quality</span>
                                </div>
                                <form method="POST" action="{{ route('order.submit') }}">
                                    @csrf
                                    <input type="hidden" name="product" value="{{ $spice['name'] }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-[#1b1b18] text-white rounded-xl py-3 transition duration-200 hover:bg-[#f53003]">Order Now</button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="bg-[#f5f5f2] rounded-2xl p-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">Fast delivery</p>
                    <p class="text-base text-[#4d4a47]">Hum aapke masalon ko fresh pack kar ke jaldi bhejte hain.</p>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">Trusted quality</p>
                    <p class="text-base text-[#4d4a47]">Har spice ko quality check kar ke ship karte hain.</p>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">Easy order</p>
                    <p class="text-base text-[#4d4a47]">Sirf ek click mein order place karein.</p>
                </div>
            </section>
        </div>
    </body>
</html>
