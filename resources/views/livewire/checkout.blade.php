<div class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-black mb-12">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="glass p-10 rounded-[40px] space-y-8">
                    <h2 class="text-2xl font-black mb-6">Shipping Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-4">Full Name</label>
                            <input type="text" wire:model="name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-indigo-500">
                            @error('name') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-4">Phone Number</label>
                            <input type="text" wire:model="phone" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-indigo-500" placeholder="+1 (555) 000-0000">
                            @error('phone') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-4">Delivery Address</label>
                        <textarea wire:model="address" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-indigo-500" placeholder="Enter your full street address..."></textarea>
                        @error('address') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-8 border-t">
                        <h2 class="text-2xl font-black mb-6">Payment Method</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <label class="relative flex items-center p-6 glass rounded-3xl cursor-pointer hover:border-indigo-500 transition-all border-2 {{ $payment_method == 'cash' ? 'border-indigo-500 bg-indigo-50/50' : 'border-transparent' }}">
                                <input type="radio" wire:model="payment_method" value="cash" class="hidden">
                                <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mr-4 text-indigo-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-black">Cash on Delivery</p>
                                    <p class="text-xs text-slate-500 font-medium">Pay when you receive</p>
                                </div>
                            </label>

                            <label class="relative flex items-center p-6 glass rounded-3xl cursor-pointer hover:border-indigo-500 transition-all border-2 {{ $payment_method == 'online' ? 'border-indigo-500 bg-indigo-50/50' : 'border-transparent' }}">
                                <input type="radio" wire:model="payment_method" value="online" class="hidden">
                                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center mr-4 text-emerald-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-black">Online Payment</p>
                                    <p class="text-xs text-slate-500 font-medium">Credit/Debit Card</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="space-y-8">
                <div class="glass p-8 rounded-[40px]">
                    <h3 class="text-xl font-black mb-8">Items in Order</h3>
                    
                    <div class="space-y-6 mb-8">
                        @foreach($cartItems as $item)
                        <div class="flex items-center gap-4">
                            <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-16 h-16 rounded-xl object-cover">
                            <div class="flex-1">
                                <p class="font-bold text-sm">{{ $item['name'] }}</p>
                                <p class="text-xs text-slate-500 font-medium">{{ $item['quantity'] }} x ${{ number_format($item['price'], 2) }}</p>
                            </div>
                            <p class="font-black text-sm text-indigo-600">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="pt-6 border-t space-y-4">
                        <div class="flex justify-between text-slate-500 font-medium">
                            <span>Total Items</span>
                            <span>{{ count($cartItems) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold">Order Total</span>
                            <span class="text-2xl font-black text-indigo-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button wire:click="placeOrder" class="w-full mt-8 bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">Confirm Order</button>
                </div>

                @if(session()->has('error'))
                <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-sm font-bold border border-red-100">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
