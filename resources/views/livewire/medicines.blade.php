<div class="pb-20">
    <!-- Header Section -->
    <div class="bg-emerald-600 pt-32 pb-24 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-6xl font-black mb-6 tracking-tight">Our Medicine Store</h1>
            <p class="text-emerald-50 text-xl max-w-3xl mx-auto font-medium leading-relaxed opacity-90">
                Browse our curated selection of high-quality medicines and healthcare products. Fast delivery and professional care guaranteed.
            </p>
        </div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-emerald-400/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Notifications -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-20">
        @if(session()->has('success'))
            <div class="bg-white border border-emerald-500/20 text-emerald-600 px-8 py-5 rounded-[32px] font-black text-sm shadow-2xl flex items-center gap-4">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Filter & Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-80 space-y-8 lg:sticky lg:top-32 h-fit">
                <div class="glass p-10 rounded-[40px] border border-emerald-50 shadow-sm">
                    <div class="space-y-10">
                        <div>
                            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-6">Search Store</h3>
                            <div class="relative group">
                                <input type="text" wire:model.live="search" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-5 text-sm focus:ring-2 focus:ring-emerald-500 font-bold placeholder:text-slate-300 transition-all" placeholder="What are you looking for?">
                                <svg class="w-5 h-5 text-slate-300 absolute right-6 top-5 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-6">Health Categories</h3>
                            <div class="space-y-4">
                                <label class="flex items-center gap-4 cursor-pointer group">
                                    <input type="radio" wire:model.live="category_id" value="" class="hidden">
                                    <div class="w-6 h-6 rounded-xl border-2 border-slate-100 flex items-center justify-center transition-all group-hover:border-emerald-500 {{ $category_id == '' ? 'bg-emerald-500 border-emerald-500 shadow-lg shadow-emerald-200' : '' }}">
                                        @if($category_id == '') <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> @endif
                                    </div>
                                    <span class="text-sm font-black transition-colors {{ $category_id == '' ? 'text-emerald-600' : 'text-slate-400 group-hover:text-slate-600' }}">All Medicines</span>
                                </label>

                                @foreach($categories as $category)
                                <label class="flex items-center gap-4 cursor-pointer group">
                                    <input type="radio" wire:model.live="category_id" value="{{ $category->id }}" class="hidden">
                                    <div class="w-6 h-6 rounded-xl border-2 border-slate-100 flex items-center justify-center transition-all group-hover:border-emerald-500 {{ $category_id == $category->id ? 'bg-emerald-500 border-emerald-500 shadow-lg shadow-emerald-200' : '' }}">
                                        @if($category_id == $category->id) <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> @endif
                                    </div>
                                    <span class="text-sm font-black transition-colors {{ $category_id == $category->id ? 'text-emerald-600' : 'text-slate-400 group-hover:text-slate-600' }}">{{ $category->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-6">Medication Type</h3>
                            <select wire:model.live="type" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-5 text-sm focus:ring-2 focus:ring-emerald-500 font-black text-slate-700">
                                <option value="">All Formats</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Syrup">Syrup</option>
                                <option value="Capsule">Capsule</option>
                                <option value="Injection">Injection</option>
                            </select>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Medicines Grid -->
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-10">
                    @forelse($medicines as $medicine)
                    <div class="glass group rounded-[48px] overflow-hidden hover:shadow-3xl transition-all duration-700 flex flex-col h-full border border-transparent hover:border-emerald-100/50">
                        <div class="h-72 overflow-hidden relative">
                            <img src="{{ $medicine->image ? Storage::url($medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" 
                                 onerror="this.src='https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80'"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-8 right-8 bg-white/95 backdrop-blur px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest text-emerald-600 shadow-xl shadow-slate-900/5">
                                {{ $medicine->type }}
                            </div>
                        </div>
                        <div class="p-10 space-y-5 flex flex-col flex-1">
                            <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">{{ $medicine->category->name }}</div>
                            <h3 class="font-black text-2xl group-hover:text-emerald-600 transition-colors leading-tight">{{ $medicine->name }}</h3>
                            <p class="text-sm text-slate-500 font-medium line-clamp-3 leading-relaxed opacity-70">{{ $medicine->description }}</p>
                            
                            <div class="flex items-center justify-between pt-8 mt-auto">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Price</span>
                                    <span class="text-3xl font-black text-slate-900">${{ number_format($medicine->price, 2) }}</span>
                                </div>
                                <button wire:click="addToCart({{ $medicine->id }})" class="bg-emerald-500 text-white p-5 rounded-[24px] font-black text-xs shadow-2xl shadow-emerald-200 hover:bg-emerald-600 hover:-translate-y-1 transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-48 text-center glass rounded-[48px] border-dashed border-2 border-slate-100">
                        <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-8 text-emerald-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900">No matches found</h3>
                        <p class="text-slate-500 font-bold mt-3">Try adjusting your filters or search term.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-20">
                    {{ $medicines->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
