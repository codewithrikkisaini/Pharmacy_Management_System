<div class="py-24 bg-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <a href="{{ route('blogs') }}" class="inline-flex items-center space-x-3 text-slate-400 font-black uppercase tracking-widest text-[10px] hover:text-emerald-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Back to Health Hub</span>
            </a>
        </div>

        <article class="space-y-12">
            <div class="space-y-6">
                <div class="flex items-center space-x-4">
                    <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Medical News</span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $blog->created_at->format('M d, Y') }}</span>
                </div>
                <h1 class="text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">{{ $blog->title }}</h1>
            </div>

            <div class="w-full aspect-video rounded-[60px] overflow-hidden shadow-2xl shadow-slate-200">
                <img src="{{ $blog->image ? Storage::url($blog->image) : 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80' }}" class="w-full h-full object-cover">
            </div>

            <div class="prose prose-xl prose-slate max-w-none prose-headings:font-black prose-headings:tracking-tight prose-p:font-medium prose-p:leading-relaxed prose-p:text-slate-600">
                {!! $blog->content !!}
            </div>

            <div class="pt-12 border-t border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 bg-slate-100 rounded-3xl flex items-center justify-center text-slate-400 font-black">
                        {{ substr($blog->user->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Written By</p>
                        <p class="text-lg font-black text-slate-900">{{ $blog->user->name ?? 'Medical Staff' }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button class="p-4 bg-slate-50 text-slate-400 rounded-2xl hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                    </button>
                    <button class="p-4 bg-slate-50 text-slate-400 rounded-2xl hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>
            </div>
        </article>
    </div>
</div>
