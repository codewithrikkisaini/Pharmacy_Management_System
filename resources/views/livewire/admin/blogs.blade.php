<div class="p-6 md:p-10">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Articles & News</h1>
            <p class="text-slate-500 font-medium">Publish educational content and store updates.</p>
        </div>
        <button wire:click="openModal" class="bg-emerald-600 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-emerald-200">
            Write New Article
        </button>
    </div>

    <div class="glass rounded-[40px] overflow-hidden">
        <div class="p-8 border-b">
            <input type="text" wire:model.live="search" class="w-full max-w-md bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm" placeholder="Search articles...">
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Article</th>
                        <th class="px-8 py-5">Author</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5">Date</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($blogs as $blog)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
                                    <img src="{{ asset('storage/'.$blog->image) }}" class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold text-slate-900">{{ $blog->title }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-500">{{ $blog->user->name }}</td>
                        <td class="px-8 py-6">
                            <span class="inline-block px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest {{ $blog->status ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-400' }}">
                                {{ $blog->status ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-xs text-slate-400">{{ $blog->created_at->format('M d, Y') }}</td>
                        <td class="px-8 py-6 text-right space-x-2">
                            <button wire:click="edit({{ $blog->id }})" class="text-emerald-600 font-bold text-xs hover:underline">Edit</button>
                            <button wire:click="delete({{ $blog->id }})" class="text-red-500 font-bold text-xs hover:underline">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t">
            {{ $blogs->links() }}
        </div>
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-4xl rounded-[40px] p-10 shadow-2xl flex flex-col max-h-[90vh]">
            <h3 class="text-2xl font-black mb-8">{{ $blog_id ? 'Edit Article' : 'New Article' }}</h3>
            <form wire:submit.prevent="save" class="space-y-6 overflow-y-auto pr-4">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Article Title</label>
                    <input type="text" wire:model="title" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Content</label>
                    <textarea wire:model="content" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm h-64"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Featured Image</label>
                        <input type="file" wire:model="image" class="w-full text-xs">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Publish Status</label>
                        <select wire:model="status" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                            <option value="1">Published</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-4 pt-6">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-emerald-100">Save Article</button>
                    <button type="button" wire:click="$set('isModalOpen', false)" class="flex-1 bg-slate-100 text-slate-600 font-black py-4 rounded-2xl">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
