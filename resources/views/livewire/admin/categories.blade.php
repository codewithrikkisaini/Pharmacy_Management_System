<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Categories</h2>
            <p class="text-sm font-medium text-slate-500 mt-1">Manage medicine categories and their presentation.</p>
        </div>
        <button wire:click="openModal" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3.5 rounded-2xl font-bold transition-all shadow-lg shadow-emerald-100 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Category
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-bold text-sm">{{ session('message') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-[32px] card-shadow overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
            <div class="relative">
                <input type="text" wire:model.live="search" placeholder="Search categories..." class="bg-slate-50 border-none rounded-xl px-5 py-3 text-sm w-80 focus:ring-2 focus:ring-emerald-500 transition-all">
                <svg class="w-4 h-4 text-slate-400 absolute right-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-slate-400 text-[11px] font-bold uppercase tracking-[0.1em]">
                    <tr>
                        <th class="px-8 py-5">Image</th>
                        <th class="px-8 py-5">Category Details</th>
                        <th class="px-8 py-5">Description</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($categories as $category)
                    <tr class="hover:bg-slate-50/30 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-sm border border-slate-100 group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ $category->image ? Storage::url($category->image) : 'https://ui-avatars.com/api/?name='.urlencode($category->name).'&color=10b981&background=ecfdf5' }}" class="w-16 h-16 rounded-2xl object-cover shadow-md">
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="font-bold text-slate-900">{{ $category->name }}</div>
                            <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mt-1">Slug: {{ $category->slug }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm text-slate-500 max-w-xs line-clamp-2 font-medium">{{ $category->description ?: 'No description provided.' }}</p>
                        </td>
                        <td class="px-8 py-5 text-right space-x-3">
                            <button wire:click="edit({{ $category->id }})" class="text-emerald-600 hover:text-emerald-700 font-bold text-sm bg-emerald-50 px-4 py-2 rounded-xl transition-all">Edit</button>
                            <button onclick="confirm('Delete this category?') || event.stopImmediatePropagation()" wire:click="delete({{ $category->id }})" class="text-red-600 hover:text-red-700 font-bold text-sm bg-red-50 px-4 py-2 rounded-xl transition-all">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="text-slate-400 font-bold">No categories found.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50">
            {{ $categories->links() }}
        </div>
    </div>

    <!-- Modern Modal -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-xl rounded-[40px] shadow-2xl overflow-hidden transform transition-all">
            <div class="p-10 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div>
                    <h3 class="text-2xl font-black text-slate-900">{{ $category_id ? 'Update Category' : 'Create Category' }}</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Provide category details below</p>
                </div>
                <button wire:click="closeModal" class="text-slate-400 hover:text-slate-900 bg-white p-2 rounded-full shadow-sm transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form wire:submit.prevent="save" class="p-10 space-y-8">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Category Name</label>
                    <input type="text" wire:model="name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 font-medium" placeholder="e.g. Tablets, Syrups">
                    @error('name') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Description</label>
                    <textarea wire:model="description" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 font-medium" rows="4" placeholder="Briefly describe this category..."></textarea>
                    @error('description') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Display Image</label>
                    <div class="flex items-center space-x-6">
                        <div class="w-24 h-24 rounded-3xl bg-slate-50 flex items-center justify-center overflow-hidden border-2 border-dashed border-slate-200">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                            @elseif($category_id && ($old_cat = \App\Models\Category::find($category_id)) && $old_cat->image)
                                <img src="{{ Storage::url($old_cat->image) }}" class="w-20 h-20 rounded-2xl object-cover shadow-lg">
                            @else
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                        <label class="cursor-pointer bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">
                            Choose File
                            <input type="file" wire:model="image" class="hidden">
                        </label>
                    </div>
                    @error('image') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
                <div class="pt-6">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-emerald-100 transition-all transform hover:scale-[1.01]">
                        {{ $category_id ? 'Update Category' : 'Create Category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

