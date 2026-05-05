@extends('layouts.app')

@section('content')

            <section class="relative mb-10 overflow-hidden rounded-2xl p-8 shadow-lg" style="background: radial-gradient(circle at top left, rgba(245,48,3,0.12), transparent 25%), linear-gradient(180deg, #fff8f0, #fdf0e6);">
                <div class="absolute -top-12 -right-16 h-72 w-72 rounded-full bg-[#f53003]/20" style="filter:blur(48px);"></div>
                <div class="relative grid gap-6 sm:grid-cols-2 items-center">
                    <div class="max-w-2xl">
                        <span class="inline-flex items-center rounded-full bg-[#fff2f2] px-4 py-2 text-sm font-semibold text-[#f53003]">Limited offer: 10% off bundle orders</span>
                        <h2 class="mt-6 text-3xl sm:text-5xl font-bold leading-tight text-[#1b1b18]">Fresh spices delivered fast for a happier kitchen.</h2>
                        <p class="mt-5 text-base sm:text-lg text-[#4d4a47]">Shop turmeric, chili, coriander, garam masala and more from home.</p>
                        <div class="mt-8 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <a href="#products" class="inline-flex items-center justify-center rounded-xl bg-[#1b1b18] px-8 py-4 text-sm font-semibold text-white transition duration-200 hover:bg-[#f53003]">Order Now</a>
                            <div class="rounded-full border border-[#e5d5c2] bg-white px-4 py-3 text-sm text-[#4d4a47]">Cash on delivery available</div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-white p-4 border border-[#f0dbcf] shadow-lg">
                                <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Fresh pack</p>
                                <p class="mt-2 text-sm text-[#4d4a47]">Every order is carefully sealed and packed.</p>
                            </div>
                            <div class="rounded-2xl bg-white p-4 border border-[#f0dbcf] shadow-lg">
                                <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Premium quality</p>
                                <p class="mt-2 text-sm text-[#4d4a47]">100% authentic spices, free from additives.</p>
                            </div>
                            <div class="rounded-2xl bg-white p-4 border border-[#f0dbcf] shadow-lg">
                                <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Fast delivery</p>
                                <p class="mt-2 text-sm text-[#4d4a47]">Delivery within 1-2 business days.</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl overflow-hidden border border-[#f0dbcf] bg-white shadow-lg">
                        <div class="bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1627354957477-224307e11f90?auto=format&fit=crop&w=900&q=80'); height:20rem;"></div>
                        <div class="p-6">
                            <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Best seller bundle</p>
                            <h3 class="mt-4 text-2xl font-semibold text-[#1b1b18]">Spice collection pack</h3>
                            <p class="mt-3 text-sm text-[#4d4a47]">Perfect starter set for biryani, curry, snacks and tea.</p>
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
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product" value="{{ $spice['name'] }}">
                                    <input type="hidden" name="price" value="{{ $spice['price'] }}">
                                    <input type="hidden" name="unit" value="{{ $spice['unit'] }}">
                                    <div class="mb-4">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="font-semibold text-[#1b1b18]">₹{{ $spice['price'] }} / {{ $spice['unit'] }}</span>
                                            <span class="text-sm text-[#7d6f53]">High quality</span>
                                        </div>
                                        <label class="block text-sm text-[#7d6f53] mb-2">Quantity</label>
                                        <select name="quantity" class="w-full rounded-xl border border-[#e5d5c2] px-3 py-2 text-sm text-[#1b1b18]">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">{{ $i }} pack</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <button type="submit" class="w-full bg-[#1b1b18] text-white rounded-xl py-3 transition duration-200 hover:bg-[#f53003]">Add to Cart</button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section id="how-it-works" class="mb-10">
                <div class="mb-6">
                    <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53]">Easy order process</p>
                    <h2 class="text-2xl sm:text-3xl font-semibold">What happens after Order Now</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="rounded-2xl bg-white p-6 border border-[#f0dbcf] shadow-lg">
                        <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">1. Select product</p>
                        <p class="text-sm text-[#4d4a47]">Choose your preferred spice and quantity from the card.</p>
                    </div>
                    <div class="rounded-2xl bg-white p-6 border border-[#f0dbcf] shadow-lg">
                        <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">2. Review order</p>
                        <p class="text-sm text-[#4d4a47]">Click Review Order to see the full order summary before final confirmation.</p>
                    </div>
                    <div class="rounded-2xl bg-white p-6 border border-[#f0dbcf] shadow-lg">
                        <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">3. Confirm and ship</p>
                        <p class="text-sm text-[#4d4a47]">Confirm the review screen and your order will be ready for delivery.</p>
                    </div>
                </div>
            </section>

            <section id="features" class="bg-[#f5f5f2] rounded-2xl p-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">Fast delivery</p>
                    <p class="text-base text-[#4d4a47]">We pack your spices fresh and ship them quickly.</p>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">Trusted quality</p>
                    <p class="text-base text-[#4d4a47]">Every spice is quality checked before shipping.</p>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-[0.12em] text-[#7d6f53] mb-3">Easy order</p>
                    <p class="text-base text-[#4d4a47]">Place your order with a single click.</p>
                </div>
            </section>

@endsection
