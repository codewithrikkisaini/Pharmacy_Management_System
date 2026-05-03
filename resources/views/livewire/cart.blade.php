<div class="py-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-4">
                <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Your Selection</span>
                <h1 class="text-5xl font-black text-slate-900 tracking-tight">Shopping <span class="text-emerald-600">Cart</span></h1>
            </div>
            <div class="flex items-center space-x-2 text-sm font-bold text-slate-400 uppercase tracking-widest">
                <span>Items: {{ count($cartItems) }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-8">
                @forelse($cartItems as $id => $item)
                <div class="bg-white p-8 rounded-[40px] flex flex-col sm:flex-row items-center gap-10 shadow-xl shadow-slate-200/50 border border-white hover:border-emerald-100 transition-all group">
                    <div class="w-32 h-32 rounded-3xl overflow-hidden shadow-lg group-hover:scale-105 transition-transform duration-500">
                        <img src="{{ $item['image'] ? Storage::url($item['image']) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="flex-1 space-y-2 text-center sm:text-left">
                        <div class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Premium Quality</div>
                        <h3 class="font-black text-2xl text-slate-900 leading-tight">{{ $item['name'] }}</h3>
                        <p class="text-lg font-black text-slate-400 tracking-tight">${{ number_format($item['price'], 2) }} <span class="text-xs font-medium uppercase tracking-widest ml-1">per unit</span></p>
                    </div>

                    <div class="flex items-center space-x-6 bg-slate-50 p-2 rounded-2xl">
                        <button wire:click="decrementQuantity({{ $id }})" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center font-black text-slate-600 hover:bg-emerald-600 hover:text-white transition-all">-</button>
                        <span class="font-black text-lg w-6 text-center text-slate-900">{{ $item['quantity'] }}</span>
                        <button wire:click="incrementQuantity({{ $id }})" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center font-black text-slate-600 hover:bg-emerald-600 hover:text-white transition-all">+</button>
                    </div>

                    <div class="text-center sm:text-right min-w-[120px] space-y-2">
                        <div class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Subtotal</div>
                        <p class="font-black text-2xl text-emerald-600 tracking-tight">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        <button wire:click="removeItem({{ $id }})" class="text-[10px] font-black text-red-500 uppercase tracking-[0.2em] hover:text-red-600 transition-colors pt-2">Remove Item</button>
                    </div>
                </div>
                @empty
                <div class="bg-white p-24 rounded-[60px] text-center shadow-xl shadow-slate-200/50 border border-white">
                    <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-10 text-emerald-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Your cart is empty</h3>
                    <p class="text-slate-500 font-medium text-lg mb-12 max-w-md mx-auto leading-relaxed">Discover our premium range of medicines and healthcare products.</p>
                    <a href="{{ route('medicines') }}" class="inline-block bg-emerald-600 text-white px-12 py-5 rounded-3xl font-black shadow-2xl shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all">Start Shopping</a>
                </div>
                @endforelse
            </div>

            <!-- Summary Card -->
            @if(count($cartItems) > 0)
            <div class="space-y-10">
                <div class="bg-slate-900 p-10 rounded-[60px] text-white shadow-2xl shadow-slate-900/20 sticky top-32 border border-white/5 overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                    <h3 class="text-2xl font-black mb-10 tracking-tight">Order Summary</h3>
                    
                    <div class="space-y-6 mb-12 relative z-10">
                        <div class="flex justify-between text-slate-400 font-bold text-sm uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="text-white">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-400 font-bold text-sm uppercase tracking-widest">
                            <span>Delivery</span>
                            <span class="text-emerald-400">Free</span>
                        </div>
                        <div class="pt-8 border-t border-white/10 flex justify-between items-end">
                            <div class="space-y-1">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Total Amount</span>
                                <div class="text-5xl font-black text-emerald-500 tracking-tight">${{ number_format($total, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 space-y-4">
                        @auth
                            <a href="{{ route('checkout') }}" class="w-full block text-center bg-emerald-600 text-white py-6 rounded-3xl font-black shadow-xl shadow-emerald-500/20 hover:bg-emerald-700 hover:-translate-y-1 transition-all">Checkout Now</a>
                        @else
                            <div class="bg-white/5 p-6 rounded-3xl mb-4 border border-white/5">
                                <p class="text-xs text-slate-400 font-bold text-center leading-relaxed">Securely store your orders by logging in.</p>
                            </div>
                            <a href="{{ route('login') }}" class="w-full block text-center bg-white text-slate-900 py-6 rounded-3xl font-black hover:bg-emerald-500 hover:text-white transition-all duration-300">Login to Continue</a>
                        @endauth
                        <a href="{{ route('medicines') }}" class="w-full block text-center text-slate-500 font-black text-xs uppercase tracking-widest hover:text-white transition-colors py-2">Continue Shopping</a>
                    </div>
                </div>

                @if(session()->has('error'))
                <div class="bg-red-500/10 border border-red-500/20 text-red-500 p-6 rounded-[32px] text-xs font-black uppercase tracking-widest leading-relaxed">
                    {{ session('error') }}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
