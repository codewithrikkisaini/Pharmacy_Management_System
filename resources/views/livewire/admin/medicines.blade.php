<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Products Inventory</h2>
            <p class="text-sm font-medium text-slate-500 mt-1">Manage your medicine stock and product listings.</p>
        </div>
        <button wire:click="openModal" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3.5 rounded-2xl font-bold transition-all shadow-lg shadow-emerald-100 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Product
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-bold text-sm">{{ session('message') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-[32px] card-shadow overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="relative w-full md:w-96">
                <input type="text" wire:model.live="search" placeholder="Search medicines..." class="bg-slate-50 border-none rounded-xl px-5 py-3 text-sm w-full focus:ring-2 focus:ring-emerald-500 transition-all">
                <svg class="w-4 h-4 text-slate-400 absolute right-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            
            <div class="flex items-center space-x-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Filter by:</span>
                <select class="bg-slate-50 border-none rounded-xl px-4 py-2 text-xs font-bold focus:ring-2 focus:ring-emerald-500">
                    <option>All Types</option>
                    <option>Tablet</option>
                    <option>Syrup</option>
                </select>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-slate-400 text-[11px] font-bold uppercase tracking-[0.1em]">
                    <tr>
                        <th class="px-8 py-5">Medicine</th>
                        <th class="px-8 py-5">Category</th>
                        <th class="px-8 py-5">Price</th>
                        <th class="px-8 py-5">Stock Level</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($medicines as $medicine)
                    <tr class="hover:bg-slate-50/30 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-sm border border-slate-100 group-hover:rotate-3 transition-transform duration-300">
                                    <img src="{{ $medicine->image ? Storage::url($medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900">{{ $medicine->name }}</div>
                                    <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mt-0.5">{{ $medicine->type }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-sm font-semibold text-slate-600">
                            {{ $medicine->category->name }}
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-lg font-black text-slate-900">${{ number_format($medicine->price, 2) }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between text-[10px] font-bold uppercase">
                                    <span class="{{ $medicine->stock < 10 ? 'text-red-500' : 'text-emerald-500' }}">
                                        {{ $medicine->stock < 10 ? 'Low Stock' : 'In Stock' }}
                                    </span>
                                    <span class="text-slate-400">{{ $medicine->stock }} units</span>
                                </div>
                                <div class="w-24 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full {{ $medicine->stock < 10 ? 'bg-red-500' : 'bg-emerald-500' }}" style="width: {{ min($medicine->stock, 100) }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-right space-x-2">
                            <button wire:click="edit({{ $medicine->id }})" class="text-emerald-600 hover:text-emerald-700 font-bold text-sm bg-emerald-50 px-4 py-2 rounded-xl transition-all">Edit</button>
                            <button onclick="confirm('Delete this product?') || event.stopImmediatePropagation()" wire:click="delete({{ $medicine->id }})" class="text-red-600 hover:text-red-700 font-bold text-sm bg-red-50 px-4 py-2 rounded-xl transition-all">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="text-slate-400 font-bold">No medicines found in inventory.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50">
            {{ $medicines->links() }}
        </div>
    </div>

    <!-- Modern Modal -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-[40px] shadow-2xl overflow-hidden transform transition-all">
            <div class="p-10 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div>
                    <h3 class="text-2xl font-black text-slate-900">{{ $medicine_id ? 'Update Product' : 'Add New Product' }}</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Configure medicine specifications</p>
                </div>
                <button wire:click="closeModal" class="text-slate-400 hover:text-slate-900 bg-white p-2 rounded-full shadow-sm transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form wire:submit.prevent="save" class="p-10 grid grid-cols-2 gap-8 max-h-[70vh] overflow-y-auto">
                <div class="col-span-2">
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Product Name</label>
                    <input type="text" wire:model="name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 font-medium" placeholder="e.g. Paracetamol 500mg">
                    @error('name') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Category</label>
                    <select wire:model="category_id" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 font-bold">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Type</label>
                    <select wire:model="type" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 font-bold">
                        <option value="">Select Type</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Syrup">Syrup</option>
                        <option value="Capsule">Capsule</option>
                        <option value="Injection">Injection</option>
                    </select>
                    @error('type') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Price ($)</label>
                    <input type="number" step="0.01" wire:model="price" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 font-bold">
                    @error('price') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Initial Stock</label>
                    <input type="number" wire:model="stock" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 font-bold">
                    @error('stock') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Product Image</label>
                    <div class="flex items-center gap-6">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="w-20 h-20 rounded-2xl object-cover shadow-lg border-2 border-emerald-500">
                        @elseif($medicine_id && ($old_medicine = \App\Models\Medicine::find($medicine_id)) && $old_medicine->image)
                            <img src="{{ Storage::url($old_medicine->image) }}" class="w-20 h-20 rounded-2xl object-cover shadow-lg">
                        @endif
                        <input type="file" wire:model="image" class="text-sm font-bold text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
                    </div>
                    <div wire:loading wire:target="image" class="text-[10px] font-black text-emerald-600 mt-2">Uploading image...</div>
                    @error('image') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-black text-slate-700 mb-3 uppercase tracking-widest">Description</label>
                    <textarea wire:model="description" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 font-medium" rows="3" placeholder="Medicine details, dosage, etc."></textarea>
                    @error('description') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2 pt-6">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-emerald-100 transition-all transform hover:scale-[1.01]">
                        {{ $medicine_id ? 'Update Product' : 'Add Product' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

