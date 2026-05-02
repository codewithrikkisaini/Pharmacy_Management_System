<div class="space-y-20 pb-20">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 flex flex-col md:flex-row items-center justify-between gap-12">
        <div class="md:w-1/2 space-y-8">
            <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest">Health First</span>
            <h1 class="text-6xl font-black leading-tight">Your Trusted <br><span class="text-indigo-600">Pharmacy</span> Online</h1>
            <p class="text-slate-500 text-lg max-w-md">Get your medicines delivered with care. Fast, reliable, and secure online medical store.</p>
            <div class="flex space-x-4">
                <a href="/medicines" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition-all">Shop Medicines</a>
                <a href="/doctors" class="bg-white dark:bg-slate-800 px-8 py-4 rounded-2xl font-bold border hover:bg-slate-50 transition-all">Book Appointment</a>
            </div>
        </div>
        <div class="md:w-1/2">
            <div class="relative">
                <div class="absolute -inset-4 bg-indigo-500/20 blur-3xl rounded-full"></div>
                <img src="https://images.unsplash.com/photo-1587854685352-25d82fb393ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="relative rounded-[40px] shadow-2xl object-cover" alt="Pharmacy">
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="flex items-end justify-between">
            <div class="space-y-2">
                <h2 class="text-3xl font-black">Browse Categories</h2>
                <p class="text-slate-500">Find what you need by department</p>
            </div>
            <a href="/categories" class="text-indigo-600 font-bold hover:underline">View All</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
            <a href="/medicines?category={{ $category->id }}" class="glass p-6 rounded-[32px] text-center space-y-4 hover:scale-105 transition-all duration-300 border-2 border-transparent hover:border-indigo-100">
                <div class="w-16 h-16 bg-indigo-50 dark:bg-indigo-900/30 rounded-2xl mx-auto flex items-center justify-center text-2xl">
                    <img src="{{ $category->image ? asset('storage/'.$category->image) : 'https://ui-avatars.com/api/?name='.urlencode($category->name).'&color=4f46e5&background=EBF4FF' }}" class="w-10 h-10 rounded-xl object-cover">
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
            <a href="/medicines" class="text-indigo-600 font-bold hover:underline">See Everything</a>
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
            <div class="glass group rounded-[40px] overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col h-full border-2 border-transparent hover:border-indigo-50">
                <div class="h-60 overflow-hidden relative">
                    <img src="{{ $medicine->image ? asset('storage/'.$medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-indigo-600">
                        {{ $medicine->type }}
                    </div>
                </div>
                <div class="p-8 space-y-4 flex flex-col flex-1">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $medicine->category->name }}</div>
                    <h3 class="font-bold text-xl">{{ $medicine->name }}</h3>
                    <div class="flex items-center justify-between pt-6 mt-auto">
                        <span class="text-2xl font-black text-indigo-600">${{ number_format($medicine->price, 2) }}</span>
                        <button wire:click="addToCart({{ $medicine->id }})" class="bg-indigo-600 text-white p-3 rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
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
        <div class="bg-indigo-600 rounded-[60px] p-12 md:p-20 text-white flex flex-col md:flex-row items-center justify-between gap-12 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="md:w-1/2 space-y-8 relative z-10">
                <h2 class="text-5xl font-black leading-tight">Need a Consultation?</h2>
                <p class="text-indigo-100 text-lg">Book an appointment with our specialist doctors today. Get professional advice from the comfort of your home.</p>
                <a href="/doctors" class="inline-block bg-white text-indigo-600 px-10 py-5 rounded-3xl font-black shadow-2xl hover:scale-105 transition-all">Find a Doctor</a>
            </div>
            <div class="md:w-1/2 relative z-10">
                <img src="https://images.unsplash.com/photo-1559839734-2b71f1e3c770?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="rounded-[40px] shadow-2xl" alt="Doctor">
            </div>
        </div>
    </section>
</div>
