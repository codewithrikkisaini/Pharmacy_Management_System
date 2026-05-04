<div class="py-24 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <!-- Contact Info -->
            <div class="space-y-12">
                <div class="space-y-6">
                    <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Get In Touch</span>
                    <h1 class="text-6xl font-black text-slate-900 leading-tight">We're here to <br><span class="text-emerald-600">Help You.</span></h1>
                    <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-md">
                        Have questions about medicines or need medical advice? Our team of experts is ready to assist you 24/7.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="glass p-8 rounded-[40px] border border-slate-50 space-y-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <h4 class="font-black text-slate-900 uppercase tracking-widest text-[10px]">Call Us</h4>
                        <p class="text-slate-500 font-bold">+1 (555) 000-0000</p>
                    </div>

                    <div class="glass p-8 rounded-[40px] border border-slate-50 space-y-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="font-black text-slate-900 uppercase tracking-widest text-[10px]">Email Us</h4>
                        <p class="text-slate-500 font-bold">support@medicare.com</p>
                    </div>
                </div>

                <div class="bg-slate-900 p-10 rounded-[50px] text-white flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-emerald-400">Our Location</p>
                        <p class="font-bold text-lg">123 Pharmacy St, New York, NY</p>
                    </div>
                    <div class="w-16 h-16 bg-white/10 rounded-3xl flex items-center justify-center text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-slate-50 p-16 rounded-[80px] border border-slate-100 shadow-2xl shadow-slate-200">
                <form wire:submit.prevent="sendMessage" class="space-y-8">
                    @if(session()->has('success'))
                        <div class="bg-emerald-500 text-white px-8 py-5 rounded-3xl font-black text-sm shadow-xl animate-bounce">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Your Name</label>
                            <input type="text" wire:model="name" class="w-full bg-white border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all shadow-sm" placeholder="John Doe">
                            @error('name') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Email Address</label>
                            <input type="email" wire:model="email" class="w-full bg-white border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all shadow-sm" placeholder="john@example.com">
                            @error('email') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Subject</label>
                        <input type="text" wire:model="subject" class="w-full bg-white border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all shadow-sm" placeholder="How can we help?">
                        @error('subject') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Message</label>
                        <textarea wire:model="message" class="w-full bg-white border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all shadow-sm h-40" placeholder="Type your message here..."></textarea>
                        @error('message') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 text-white py-6 rounded-3xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>