<div class="py-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4 mb-16 text-center">
            <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Health Hub</span>
            <h1 class="text-5xl font-black text-slate-900 tracking-tight">Latest <span class="text-emerald-600">Articles</span> & News</h1>
            <p class="text-slate-500 max-w-2xl mx-auto font-medium">Expert advice, health tips, and the latest medical news to help you live a healthier life.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($blogs as $blog)
            <div class="group bg-white rounded-[40px] overflow-hidden shadow-xl shadow-slate-200/50 border border-white hover:border-emerald-100 transition-all duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $blog->image ? Storage::url($blog->image) : 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-6 left-6">
                        <span class="bg-white/90 backdrop-blur text-slate-900 px-4 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-sm">Medical Tips</span>
                    </div>
                </div>
                <div class="p-10 space-y-4">
                    <div class="flex items-center space-x-3 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <span>{{ $blog->created_at->format('M d, Y') }}</span>
                        <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                        <span>5 Min Read</span>
                    </div>
                    <a href="{{ route('blog.detail', $blog->slug) }}">
                        <h3 class="text-2xl font-black text-slate-900 leading-tight group-hover:text-emerald-600 transition-colors line-clamp-2">{{ $blog->title }}</h3>
                    </a>
                    <p class="text-slate-500 text-sm font-medium line-clamp-3 leading-relaxed">
                        {{ Str::limit(strip_tags($blog->content), 120) }}
                    </p>
                    <div class="pt-6">
                        <a href="{{ route('blog.detail', $blog->slug) }}" class="flex items-center space-x-3 text-emerald-600 font-black uppercase tracking-widest text-[10px] group-hover:translate-x-2 transition-transform">
                            <span>Read Full Article</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-24 text-center">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900">No articles yet</h3>
                <p class="text-slate-500 font-medium">Check back soon for latest health news.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
