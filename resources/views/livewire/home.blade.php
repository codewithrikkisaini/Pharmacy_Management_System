<div class="space-y-32 pb-32">
    <!-- Hero Banner Slider -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        @if($banners->count() > 0)
        <div x-data="{ 
                activeSlide: 0, 
                slides: {{ $banners->count() }},
                next() { this.activeSlide = (this.activeSlide + 1) % this.slides },
                prev() { this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides }
            }" 
            x-init="setInterval(() => next(), 6000)"
            class="relative rounded-[60px] overflow-hidden h-[600px] shadow-2xl group">
            
            @foreach($banners as $index => $banner)
            <div x-show="activeSlide === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 transform scale-110"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="absolute inset-0">
                <img src="{{ Storage::url($banner->image) }}" 
                     onerror="this.src='https://images.unsplash.com/photo-1587854685352-25d82fb393ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/50 to-transparent flex items-center">
                    <div class="max-w-3xl px-12 md:px-24 space-y-8">
                        <div class="flex items-center space-x-4">
                            <span class="w-12 h-[2px] bg-emerald-500"></span>
                            <span class="text-emerald-400 text-xs font-black uppercase tracking-[0.4em]">Official Medicare Store</span>
                        </div>
                        <h2 class="text-6xl md:text-7xl font-black text-white leading-[1.1] drop-shadow-2xl">
                            {{ $banner->title }}
                        </h2>
                        <p class="text-slate-200 text-xl font-medium max-w-lg leading-relaxed opacity-90">
                            {{ $banner->subtitle }}
                        </p>
                        <div class="flex items-center space-x-6 pt-4">
                            <a href="/medicines" class="bg-emerald-600 text-white px-12 py-5 rounded-2xl font-black shadow-2xl shadow-emerald-500/40 hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300">
                                Explore Store
                            </a>
                            <a href="/doctors" class="bg-white/10 backdrop-blur-md text-white border border-white/20 px-12 py-5 rounded-2xl font-black hover:bg-white/20 transition-all duration-300">
                                Consultation
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Navigation Controls -->
            <div class="absolute bottom-12 left-24 flex items-center space-x-6 z-20">
                <div class="flex space-x-3">
                    @foreach($banners as $index => $banner)
                    <button @click="activeSlide = {{ $index }}" 
                            :class="activeSlide === {{ $index }} ? 'w-12 bg-emerald-500' : 'w-3 bg-white/30'"
                            class="h-1.5 rounded-full transition-all duration-500"></button>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <!-- Fallback Hero -->
        <div class="bg-slate-900 rounded-[60px] overflow-hidden min-h-[600px] flex items-center relative">
            <div class="absolute inset-0 opacity-40">
                <img src="https://images.unsplash.com/photo-1587854685352-25d82fb393ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" class="w-full h-full object-cover">
            </div>
            <div class="relative z-10 max-w-3xl px-12 md:px-24 space-y-8">
                <span class="bg-emerald-500 text-white px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Premium Care</span>
                <h1 class="text-7xl font-black leading-tight text-white">Your Wellness <br><span class="text-emerald-500 underline decoration-8 decoration-emerald-500/30">Redefined</span></h1>
                <p class="text-slate-300 text-xl max-w-md font-medium leading-relaxed">Trusted healthcare solutions delivered with precision and speed. Your health is our priority.</p>
                <div class="flex flex-col space-y-6 pt-4">
                    <div class="relative w-full max-w-lg group">
                        <input type="text" wire:model="search" wire:keydown.enter="performSearch" class="w-full bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl px-8 py-5 text-white font-bold placeholder-white/50 focus:ring-2 focus:ring-emerald-500 transition-all outline-none" placeholder="Search medicines, health products...">
                        <button wire:click="performSearch" class="absolute right-3 top-2.5 bg-emerald-500 text-white p-3 rounded-2xl hover:bg-emerald-600 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                    <div class="flex space-x-6">
                        <a href="/medicines" class="bg-emerald-600 text-white px-12 py-5 rounded-2xl font-black shadow-2xl shadow-emerald-500/40 hover:bg-emerald-700 transition-all">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>

    <!-- Trust Badges / Stats -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="glass p-10 rounded-[40px] text-center space-y-4 border-2 border-slate-50">
                <div class="text-4xl font-black text-emerald-600">50k+</div>
                <div class="text-xs font-black text-slate-400 uppercase tracking-widest">Happy Customers</div>
            </div>
            <div class="glass p-10 rounded-[40px] text-center space-y-4 border-2 border-slate-50">
                <div class="text-4xl font-black text-emerald-600">120+</div>
                <div class="text-xs font-black text-slate-400 uppercase tracking-widest">Expert Doctors</div>
            </div>
            <div class="glass p-10 rounded-[40px] text-center space-y-4 border-2 border-slate-50">
                <div class="text-4xl font-black text-emerald-600">15m</div>
                <div class="text-xs font-black text-slate-400 uppercase tracking-widest">Fast Delivery</div>
            </div>
            <div class="glass p-10 rounded-[40px] text-center space-y-4 border-2 border-slate-50">
                <div class="text-4xl font-black text-emerald-600">24/7</div>
                <div class="text-xs font-black text-slate-400 uppercase tracking-widest">Live Support</div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="space-y-4">
                <span class="text-emerald-600 text-xs font-black uppercase tracking-[0.3em]">Health Hub</span>
                <h2 class="text-5xl font-black text-slate-900 leading-tight">Explore by <span class="text-emerald-600">Category</span></h2>
            </div>
            <a href="/categories" class="group flex items-center space-x-3 text-slate-900 font-black uppercase tracking-widest text-xs hover:text-emerald-600 transition-colors">
                <span>View All Categories</span>
                <div class="w-10 h-10 bg-slate-900 group-hover:bg-emerald-600 text-white rounded-full flex items-center justify-center transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
            @foreach($categories as $category)
            <a href="/medicines?category={{ $category->id }}" class="group relative">
                <div class="glass p-8 rounded-[48px] text-center space-y-6 transition-all duration-500 border-2 border-transparent group-hover:border-emerald-500 group-hover:-translate-y-4 shadow-xl shadow-slate-100 group-hover:shadow-emerald-200/50">
                    <div class="w-20 h-20 bg-emerald-50 rounded-3xl mx-auto flex items-center justify-center overflow-hidden">
                        <img src="{{ $category->image ? Storage::url($category->image) : 'https://ui-avatars.com/api/?name='.urlencode($category->name).'&color=10b981&background=ecfdf5' }}" 
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($category->name) }}&color=10b981&background=ecfdf5'"
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-black text-sm text-slate-900 tracking-tight">{{ $category->name }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <!-- Products Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
        <div class="bg-slate-50 p-16 rounded-[80px] space-y-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div class="space-y-4 text-center md:text-left">
                    <span class="bg-emerald-600 text-white px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-[0.3em]">Trending Now</span>
                    <h2 class="text-5xl font-black text-slate-900">Latest <span class="text-emerald-600">Medicines</span></h2>
                </div>
                <a href="/medicines" class="bg-white px-10 py-5 rounded-3xl font-black text-sm shadow-xl shadow-slate-200 hover:bg-emerald-600 hover:text-white transition-all">
                    Browse All Products
                </a>
            </div>

            @if(session()->has('success'))
                <div class="bg-emerald-500 text-white px-8 py-5 rounded-3xl font-black text-sm animate-bounce">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($latest_medicines as $medicine)
                <div class="bg-white group rounded-[50px] p-4 hover:shadow-[0_40px_80px_-20px_rgba(0,0,0,0.1)] transition-all duration-700 flex flex-col h-full border border-slate-50">
                    <div class="h-64 rounded-[40px] overflow-hidden relative">
                        <img src="{{ $medicine->image ? Storage::url($medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" 
                             onerror="this.src='https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80'"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        <div class="absolute top-6 left-6 bg-emerald-600 text-white px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                            {{ $medicine->type }}
                        </div>
                    </div>
                    <div class="p-8 space-y-5 flex flex-col flex-1">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $medicine->category->name }}</span>
                            <span class="text-xs font-black text-emerald-600">★ 4.8</span>
                        </div>
                        <h3 class="font-black text-xl text-slate-900 leading-snug">
                            <a href="{{ route('medicine.detail', $medicine->slug) }}" class="hover:text-emerald-600 transition-colors">{{ $medicine->name }}</a>
                        </h3>
                        <div class="flex items-center justify-between pt-8 mt-auto">
                            <span class="text-3xl font-black text-slate-900">${{ number_format($medicine->price, 2) }}</span>
                            <button wire:click="addToCart({{ $medicine->id }})" class="bg-slate-900 text-white w-14 h-14 rounded-2xl hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section class="bg-slate-900 py-40 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <span class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </span>
                        <span class="text-emerald-400 text-xs font-black uppercase tracking-[0.4em]">Expert Medical Team</span>
                    </div>
                    <h2 class="text-6xl font-black text-white leading-tight">Qualified <span class="text-emerald-500">Specialists</span></h2>
                    <p class="text-slate-400 text-xl max-w-2xl font-medium leading-relaxed">Consult with our network of certified medical professionals for expert advice and personalized care.</p>
                </div>
                <a href="/doctors" class="bg-emerald-600 text-white px-12 py-5 rounded-2xl font-black shadow-2xl shadow-emerald-500/20 hover:bg-emerald-700 transition-all shrink-0">
                    View Team
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($doctors as $doctor)
                <div class="bg-white/5 backdrop-blur-3xl border border-white/10 rounded-[60px] overflow-hidden group hover:bg-white/10 transition-all duration-700">
                    <div class="h-[400px] overflow-hidden relative">
                        <img src="{{ $doctor->image ? Storage::url($doctor->image) : 'https://ui-avatars.com/api/?name='.urlencode($doctor->name).'&size=800&color=10b981&background=ecfdf5' }}" 
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=800&color=10b981&background=ecfdf5'"
                             class="w-full h-full object-cover group-hover:scale-110 grayscale group-hover:grayscale-0 transition-all duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent"></div>
                        <div class="absolute bottom-10 left-10 right-10">
                            <div class="text-emerald-400 text-[10px] font-black uppercase tracking-[0.3em] mb-2">{{ $doctor->specialization }}</div>
                            <h3 class="font-black text-2xl group-hover:text-emerald-600 transition-colors leading-tight">
                                {{ $doctor->name }}
                            </h3>
                        </div>
                    </div>
                    <div class="p-10 space-y-8">
                        <div class="flex items-center space-x-4">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-emerald-500 border-2 border-slate-900"></div>
                                <div class="w-8 h-8 rounded-full bg-slate-700 border-2 border-slate-900"></div>
                            </div>
                            <span class="text-slate-400 text-xs font-black uppercase tracking-widest">{{ $doctor->experience }} Experience</span>
                        </div>
                        <a href="/doctors" class="w-full inline-block text-center bg-white text-slate-900 py-5 rounded-2xl font-black text-sm hover:bg-emerald-500 hover:text-white transition-all duration-300">
                            Book Now
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] bg-emerald-500/5 rounded-full blur-[120px]"></div>
    </section>

    <!-- App Promo / App Download -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-emerald-600 rounded-[80px] p-16 md:p-24 text-white flex flex-col md:flex-row items-center justify-between gap-16 overflow-hidden relative shadow-2xl shadow-emerald-200">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/10 rounded-full -mr-32 -mt-32 blur-[80px]"></div>
            <div class="md:w-1/2 space-y-10 relative z-10">
                <div class="inline-block bg-white/20 px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest">Mobile App Coming Soon</div>
                <h2 class="text-6xl font-black leading-[1.1]">Healthcare in <br><span class="text-slate-900">Your Pocket</span></h2>
                <p class="text-emerald-50 text-xl font-medium leading-relaxed opacity-90">Manage prescriptions, book appointments, and chat with specialists 24/7 with our upcoming mobile experience.</p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black flex items-center space-x-3 hover:scale-105 transition-all">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.5 12c0-2.3-1.4-4.3-3.4-5.2.8-1.5 2.4-2.5 4.3-2.5 2.8 0 5 2.2 5 5s-2.2 5-5 5c-1.9 0-3.5-1-4.3-2.5 2 1 3.4 2.9 3.4 5.2z"></path></svg>
                        <div class="text-left">
                            <div class="text-[10px] uppercase font-black tracking-widest opacity-60">Coming to</div>
                            <div class="text-sm">App Store</div>
                        </div>
                    </button>
                </div>
            </div>
            <div class="md:w-1/2 relative z-10 flex justify-end">
                <div class="relative">
                    <div class="absolute -inset-10 bg-white/20 rounded-full blur-[60px]"></div>
                    <img src="https://images.unsplash.com/photo-1559839734-2b71f1e3c770?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="rounded-[60px] shadow-2xl w-[400px] relative z-10" alt="App Preview">
                </div>
            </div>
        </div>
    </section>
</div>
