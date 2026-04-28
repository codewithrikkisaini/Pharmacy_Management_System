<div class="pb-20">
    <!-- Header Section -->
    <div class="bg-indigo-600 pt-32 pb-20 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-5xl font-black mb-6">Pharmacy Store</h1>
            <p class="text-indigo-100 text-lg max-w-2xl font-medium leading-relaxed">
                Browse our wide range of high-quality medicines, healthcare products, and wellness essentials. Fast delivery and authentic products guaranteed.
            </p>
        </div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Filter & Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-72 space-y-8 sticky top-32 h-fit">
                <div class="glass p-8 rounded-[40px] space-y-8">
                    <div>
                        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">Search</h3>
                        <div class="relative">
                            <input type="text" wire:model.live="search" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-indigo-500 font-medium" placeholder="Search medicines...">
                            <svg class="w-4 h-4 text-slate-400 absolute right-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">Categories</h3>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="radio" wire:model.live="category_id" value="" class="hidden">
                                <div class="w-5 h-5 rounded-lg border-2 border-indigo-100 flex items-center justify-center transition-all group-hover:border-indigo-600 {{ $category_id == '' ? 'bg-indigo-600 border-indigo-600' : '' }}">
                                    @if($category_id == '') <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> @endif
                                </div>
                                <span class="text-sm font-bold {{ $category_id == '' ? 'text-indigo-600' : 'text-slate-500' }}">All Categories</span>
                            </label>

                            @foreach($categories as $category)
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="radio" wire:model.live="category_id" value="{{ $category->id }}" class="hidden">
                                <div class="w-5 h-5 rounded-lg border-2 border-indigo-100 flex items-center justify-center transition-all group-hover:border-indigo-600 {{ $category_id == $category->id ? 'bg-indigo-600 border-indigo-600' : '' }}">
                                    @if($category_id == $category->id) <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> @endif
                                </div>
                                <span class="text-sm font-bold {{ $category_id == $category->id ? 'text-indigo-600' : 'text-slate-500' }}">{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">Type</h3>
                        <select wire:model.live="type" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-indigo-500 font-bold">
                            <option value="">All Types</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Capsule">Capsule</option>
                            <option value="Injection">Injection</option>
                        </select>
                    </div>
                </div>
            </aside>

            <!-- Medicines Grid -->
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($medicines as $medicine)
                    <div class="glass group rounded-[40px] overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col h-full border-2 border-transparent hover:border-indigo-50">
                        <div class="h-64 overflow-hidden relative">
                            <img src="{{ $medicine->image ? asset('storage/'.$medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-6 right-6 bg-white/95 dark:bg-slate-900/95 backdrop-blur px-4 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest text-indigo-600 shadow-sm">
                                {{ $medicine->type }}
                            </div>
                        </div>
                        <div class="p-8 space-y-4 flex flex-col flex-1">
                            <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ $medicine->category->name }}</div>
                            <h3 class="font-bold text-xl group-hover:text-indigo-600 transition-colors">{{ $medicine->name }}</h3>
                            <p class="text-xs text-slate-500 font-medium line-clamp-2 leading-relaxed">{{ $medicine->description }}</p>
                            
                            <div class="flex items-center justify-between pt-6 mt-auto">
                                <span class="text-3xl font-black text-indigo-600">${{ number_format($medicine->price, 2) }}</span>
                                <button class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold text-xs shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition-all">
                                    Order Now
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-40 text-center glass rounded-[40px]">
                        <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6 text-indigo-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900">No medicines found</h3>
                        <p class="text-slate-500 font-medium mt-2">Try adjusting your search or filters.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-16">
                    {{ $medicines->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
