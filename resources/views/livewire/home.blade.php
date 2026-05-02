<div class="space-y-20 pb-20">
    <!-- Hero Banner Slider -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        @if($banners->count() > 0)
        <div x-data="{ 
                activeSlide: 0, 
                slides: {{ $banners->count() }},
                next() { this.activeSlide = (this.activeSlide + 1) % this.slides },
                prev() { this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides }
            }" 
            x-init="setInterval(() => next(), 5000)"
            class="relative rounded-[50px] overflow-hidden h-[500px] shadow-2xl group">
            
            @foreach($banners as $index => $banner)
            <div x-show="activeSlide === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="absolute inset-0">
                <img src="{{ asset('storage/'.$banner->image) }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/40 to-transparent flex items-center">
                    <div class="max-w-2xl px-12 md:px-20 space-y-6">
                        <span class="inline-block bg-emerald-500 text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-emerald-500/20">Special Offer</span>
                        <h2 class="text-5xl md:text-6xl font-black text-white leading-tight">{{ $banner->title }}</h2>
                        <p class="text-slate-200 text-lg font-medium max-w-md">{{ $banner->subtitle }}</p>
                        <div class="pt-4">
                            <a href="/medicines" class="inline-block bg-emerald-600 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-emerald-500/20 hover:bg-emerald-700 hover:-translate-y-1 transition-all">Shop Collection</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Controls -->
            <button @click="prev()" class="absolute left-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button @click="next()" class="absolute right-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Indicators -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3">
                @foreach($banners as $index => $banner)
                <button @click="activeSlide = {{ $index }}" 
                        :class="activeSlide === {{ $index }} ? 'w-8 bg-emerald-500' : 'w-2 bg-white/50'"
                        class="h-2 rounded-full transition-all duration-500"></button>
                @endforeach
            </div>
        </div>
        @else
        <!-- Fallback Hero if no banners -->
        <div class="bg-slate-900 rounded-[50px] overflow-hidden min-h-[500px] flex flex-col md:flex-row items-center justify-between p-12 md:p-20 relative">
            <div class="absolute inset-0 opacity-20">
                <img src="https://images.unsplash.com/photo-1587854685352-25d82fb393ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" class="w-full h-full object-cover">
            </div>
            <div class="relative z-10 md:w-1/2 space-y-8">
                <span class="bg-emerald-500 text-white px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Health First</span>
                <h1 class="text-6xl font-black leading-tight text-white">Your Trusted <br><span class="text-emerald-500">Pharmacy</span> Online</h1>
                <p class="text-slate-300 text-lg max-w-md">Get your medicines delivered with care. Fast, reliable, and secure online medical store.</p>
                <div class="flex space-x-4">
                    <a href="/medicines" class="bg-emerald-600 text-white px-10 py-5 rounded-2xl font-black shadow-xl shadow-emerald-500/20 hover:bg-emerald-700 transition-all">Shop Now</a>
                    <a href="/doctors" class="bg-white/10 backdrop-blur text-white px-10 py-5 rounded-2xl font-black border border-white/20 hover:bg-white/20 transition-all">Appointments</a>
                </div>
            </div>
            <div class="relative z-10 md:w-1/2 flex justify-end">
                <div class="w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl absolute -mr-20 -mt-20"></div>
                <img src="https://images.unsplash.com/photo-1586015555751-63bb77f4322a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-72 h-96 object-cover rounded-[40px] shadow-2xl relative" alt="Pharmacy">
            </div>
        </div>
        @endif
    </section>

    <!-- Categories -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="flex items-end justify-between">
            <div class="space-y-2">
                <h2 class="text-3xl font-black">Browse Categories</h2>
                <p class="text-slate-500">Find what you need by department</p>
            </div>
            <a href="/categories" class="text-emerald-600 font-bold hover:underline">View All</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
            <a href="/medicines?category={{ $category->id }}" class="glass p-6 rounded-[32px] text-center space-y-4 hover:scale-105 transition-all duration-300 border-2 border-transparent hover:border-emerald-100">
                <div class="w-16 h-16 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl mx-auto flex items-center justify-center text-2xl">
                    <img src="{{ $category->image ? asset('storage/'.$category->image) : 'https://ui-avatars.com/api/?name='.urlencode($category->name).'&color=10b981&background=ecfdf5' }}" class="w-10 h-10 rounded-xl object-cover">
                </div>
                <h3 class="font-bold text-sm">{{ $category->name }}</h3>
            </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Medicines -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="flex items-end justify-between">
            <div class="space-y-2">
                <h2 class="text-3xl font-black">Latest Medicines</h2>
                <p class="text-slate-500">Recently added medicines and supplies</p>
            </div>
            <a href="/medicines" class="text-emerald-600 font-bold hover:underline">See Everything</a>
        </div>

        @if(session()->has('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="bg-red-500/10 border border-red-500/20 text-red-600 px-6 py-4 rounded-2xl font-bold text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($latest_medicines as $medicine)
            <div class="glass group rounded-[40px] overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col h-full border-2 border-transparent hover:border-emerald-50">
                <div class="h-60 overflow-hidden relative">
                    <img src="{{ $medicine->image ? asset('storage/'.$medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-emerald-600">
                        {{ $medicine->type }}
                    </div>
                </div>
                <div class="p-8 space-y-4 flex flex-col flex-1">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $medicine->category->name }}</div>
                    <h3 class="font-bold text-xl">{{ $medicine->name }}</h3>
                    <div class="flex items-center justify-between pt-6 mt-auto">
                        <span class="text-2xl font-black text-emerald-600">${{ number_format($medicine->price, 2) }}</span>
                        <button wire:click="addToCart({{ $medicine->id }})" class="bg-emerald-600 text-white p-3 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- App Promo -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-emerald-600 rounded-[60px] p-12 md:p-20 text-white flex flex-col md:flex-row items-center justify-between gap-12 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="md:w-1/2 space-y-8 relative z-10">
                <h2 class="text-5xl font-black leading-tight">Need a Consultation?</h2>
                <p class="text-emerald-100 text-lg">Book an appointment with our specialist doctors today. Get professional advice from the comfort of your home.</p>
                <a href="/doctors" class="inline-block bg-white text-emerald-600 px-10 py-5 rounded-3xl font-black shadow-2xl hover:scale-105 transition-all">Find a Doctor</a>
            </div>
            <div class="md:w-1/2 relative z-10">
                <img src="https://images.unsplash.com/photo-1559839734-2b71f1e3c770?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="rounded-[40px] shadow-2xl" alt="Doctor">
            </div>
        </div>
    </section>
</div>

