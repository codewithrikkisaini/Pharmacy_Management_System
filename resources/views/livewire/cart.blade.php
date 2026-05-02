<div class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-black mb-12">Shopping Cart</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-6">
                @forelse($cartItems as $id => $item)
                <div class="glass p-6 rounded-[30px] flex items-center gap-6">
                    <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-24 h-24 rounded-2xl object-cover">
                    <div class="flex-1">
                        <h3 class="font-bold text-lg">{{ $item['name'] }}</h3>
                        <p class="text-emerald-600 font-black">${{ number_format($item['price'], 2) }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button wire:click="decrementQuantity({{ $id }})" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center font-bold hover:bg-slate-200 transition-colors">-</button>
                        <span class="font-bold w-8 text-center">{{ $item['quantity'] }}</span>
                        <button wire:click="incrementQuantity({{ $id }})" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center font-bold hover:bg-slate-200 transition-colors">+</button>
                    </div>
                    <div class="text-right min-w-[100px]">
                        <p class="font-black text-lg">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        <button wire:click="removeItem({{ $id }})" class="text-xs font-bold text-red-500 hover:text-red-600 mt-2">Remove</button>
                    </div>
                </div>
                @empty
                <div class="glass p-20 rounded-[40px] text-center">
                    <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 text-emerald-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Your cart is empty</h3>
                    <p class="text-slate-500 font-medium mt-2 mb-8">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('medicines') }}" class="inline-block bg-emerald-600 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition-all">Start Shopping</a>
                </div>
                @endforelse
            </div>

            <!-- Summary -->
            @if(count($cartItems) > 0)
            <div class="space-y-8">
                <div class="glass p-8 rounded-[40px] sticky top-32">
                    <h3 class="text-xl font-black mb-8">Order Summary</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-slate-500 font-medium">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-500 font-medium">
                            <span>Delivery Fee</span>
                            <span class="text-emerald-500">Free</span>
                        </div>
                        <div class="pt-4 border-t flex justify-between items-center">
                            <span class="font-bold">Total</span>
                            <span class="text-3xl font-black text-emerald-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    @auth
                        <a href="{{ route('checkout') }}" class="w-full block text-center bg-emerald-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition-all">Proceed to Checkout</a>
                    @else
                        <div class="bg-emerald-50 p-6 rounded-2xl mb-6">
                            <p class="text-xs text-emerald-600 font-bold text-center leading-relaxed">Please login to complete your order and track your delivery.</p>
                        </div>
                        <a href="{{ route('login') }}" class="w-full block text-center bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-slate-800 transition-all">Login to Continue</a>
                    @endauth
                </div>

                @if(session()->has('error'))
                <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-sm font-bold border border-red-100">
                    {{ session('error') }}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

