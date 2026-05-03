<div class="py-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4 mb-16">
            <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Final Step</span>
            <h1 class="text-5xl font-black text-slate-900 tracking-tight">Complete <span class="text-emerald-600">Checkout</span></h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <!-- Checkout Form -->
            <div class="lg:col-span-2 space-y-12">
                <div class="bg-white p-12 rounded-[60px] shadow-xl shadow-slate-200/50 border border-white space-y-12">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h2 class="text-3xl font-black text-slate-900">Delivery Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-2">Recipient Name</label>
                            <input type="text" wire:model="name" class="w-full bg-slate-50 border-none rounded-3xl px-8 py-5 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" placeholder="Enter full name">
                            @error('name') <span class="text-red-500 text-[10px] font-black uppercase tracking-widest mt-2 block px-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-2">Contact Phone</label>
                            <input type="text" wire:model="phone" class="w-full bg-slate-50 border-none rounded-3xl px-8 py-5 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" placeholder="+1 (555) 000-0000">
                            @error('phone') <span class="text-red-500 text-[10px] font-black uppercase tracking-widest mt-2 block px-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-2">Full Shipping Address</label>
                        <textarea wire:model="address" rows="4" class="w-full bg-slate-50 border-none rounded-3xl px-8 py-6 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all" placeholder="Enter your full street address, city, and zip code..."></textarea>
                        @error('address') <span class="text-red-500 text-[10px] font-black uppercase tracking-widest mt-2 block px-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="bg-white p-12 rounded-[60px] shadow-xl shadow-slate-200/50 border border-white space-y-12">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-slate-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h2 class="text-3xl font-black text-slate-900">Payment Strategy</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <label class="group relative flex items-center p-8 rounded-[40px] cursor-pointer transition-all border-4 {{ $payment_method == 'cash' ? 'border-emerald-500 bg-emerald-50/30' : 'border-slate-50 bg-slate-50/50 hover:border-emerald-200' }}">
                            <input type="radio" wire:model="payment_method" value="cash" class="hidden">
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mr-6 text-emerald-600 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div class="space-y-1">
                                <p class="font-black text-slate-900">Cash on Delivery</p>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Pay at doorstep</p>
                            </div>
                            @if($payment_method == 'cash')
                            <div class="absolute top-6 right-6">
                                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                            @endif
                        </label>

                        <label class="group relative flex items-center p-8 rounded-[40px] cursor-pointer transition-all border-4 {{ $payment_method == 'online' ? 'border-emerald-500 bg-emerald-50/30' : 'border-slate-50 bg-slate-50/50 hover:border-emerald-200' }}">
                            <input type="radio" wire:model="payment_method" value="online" class="hidden">
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mr-6 text-emerald-600 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-3.682A23.848 23.848 0 0010 11.586m0 0V4m0 0L8 4m2 0l2 0m7 8a9 9 0 01-9 9m9-9c0 2.262-.834 4.33-2.215 5.917"></path></svg>
                            </div>
                            <div class="space-y-1">
                                <p class="font-black text-slate-900">Secure Online</p>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Credit / Debit Card</p>
                            </div>
                            @if($payment_method == 'online')
                            <div class="absolute top-6 right-6">
                                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                            @endif
                        </label>
                    </div>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="space-y-10">
                <div class="bg-slate-900 p-10 rounded-[60px] text-white shadow-2xl shadow-slate-900/20 sticky top-32 border border-white/5 overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                    <h3 class="text-2xl font-black mb-10 tracking-tight">Basket Overview</h3>
                    
                    <div class="space-y-8 mb-12 relative z-10 max-h-[300px] overflow-y-auto pr-4 custom-scrollbar">
                        @foreach($cartItems as $item)
                        <div class="flex items-center gap-6 group">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-lg shrink-0">
                                <img src="{{ $item['image'] ? Storage::url($item['image']) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                            <div class="flex-1 space-y-1">
                                <p class="font-black text-sm text-white line-clamp-1 leading-tight">{{ $item['name'] }}</p>
                                <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest">{{ $item['quantity'] }} Units</p>
                            </div>
                            <p class="font-black text-sm text-emerald-400 tracking-tight">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="pt-8 border-t border-white/10 space-y-6 relative z-10">
                        <div class="flex justify-between text-slate-500 font-black text-[10px] uppercase tracking-[0.3em]">
                            <span>Delivery Package</span>
                            <span class="text-emerald-400">Standard Free</span>
                        </div>
                        <div class="flex justify-between items-end">
                            <div class="space-y-1">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Total Payable</span>
                                <div class="text-5xl font-black text-emerald-500 tracking-tight">${{ number_format($total, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-12 relative z-10">
                        <button wire:click="placeOrder" class="w-full bg-emerald-600 text-white py-6 rounded-3xl font-black shadow-xl shadow-emerald-500/20 hover:bg-emerald-700 hover:-translate-y-1 transition-all">Place Secure Order</button>
                        <p class="text-center text-[10px] text-slate-500 font-black uppercase tracking-widest mt-6">Secure 256-bit SSL Encryption</p>
                    </div>
                </div>

                @if(session()->has('error'))
                <div class="bg-red-500/10 border border-red-500/20 text-red-500 p-6 rounded-[32px] text-xs font-black uppercase tracking-widest leading-relaxed">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
