<div class="py-24 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-12 text-[10px] font-black uppercase tracking-widest text-slate-400 space-x-3">
            <a href="/" class="hover:text-emerald-600 transition-colors">Home</a>
            <span>/</span>
            <a href="/medicines" class="hover:text-emerald-600 transition-colors">Store</a>
            <span>/</span>
            <span class="text-slate-900">{{ $medicine->name }}</span>
        </nav>

        @if(session()->has('success'))
            <div class="mb-10 bg-emerald-500 text-white px-8 py-5 rounded-3xl font-black text-sm shadow-xl animate-bounce">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
            <!-- Product Image -->
            <div class="space-y-6">
                <div class="aspect-square bg-slate-50 rounded-[60px] overflow-hidden border border-slate-100 group relative shadow-2xl shadow-slate-200">
                    <img src="{{ $medicine->image ? Storage::url($medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}" 
                         onerror="this.src='https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    <div class="absolute top-10 right-10 bg-white/90 backdrop-blur px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest text-emerald-600 shadow-xl">
                        {{ $medicine->type }}
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-10">
                <div class="space-y-4">
                    <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">
                        {{ $medicine->category->name }}
                    </span>
                    <h1 class="text-6xl font-black text-slate-900 leading-tight">{{ $medicine->name }}</h1>
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center text-amber-400">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <span class="text-sm font-black text-slate-400 uppercase tracking-widest">4.8 Rating (24 Reviews)</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Unit Price</p>
                    <div class="text-5xl font-black text-slate-900">${{ number_format($medicine->price, 2) }}</div>
                </div>

                <div class="prose prose-slate prose-p:font-medium prose-p:text-slate-500 prose-p:leading-relaxed">
                    {{ $medicine->description }}
                </div>

                <div class="pt-10 space-y-8">
                    <div class="flex items-center gap-10">
                        <div class="space-y-4">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Quantity</p>
                            <div class="flex items-center bg-slate-50 rounded-2xl p-2 border border-slate-100">
                                <button wire:click="decrement" class="w-12 h-12 flex items-center justify-center text-slate-400 hover:text-emerald-600 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                                </button>
                                <span class="w-16 text-center font-black text-xl text-slate-900">{{ $quantity }}</span>
                                <button wire:click="increment" class="w-12 h-12 flex items-center justify-center text-slate-400 hover:text-emerald-600 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex-1 space-y-4">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Availability</p>
                            <div class="h-[66px] flex items-center">
                                @if($medicine->stock > 0)
                                    <span class="inline-flex items-center text-emerald-600 font-black text-sm uppercase tracking-widest">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-3 animate-pulse"></span>
                                        In Stock ({{ $medicine->stock }} Units)
                                    </span>
                                @else
                                    <span class="text-red-500 font-black text-sm uppercase tracking-widest">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <button wire:click="addToCart" class="flex-1 bg-emerald-600 text-white py-6 rounded-3xl font-black text-lg shadow-2xl shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all flex items-center justify-center space-x-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <span>Add to Cart</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
