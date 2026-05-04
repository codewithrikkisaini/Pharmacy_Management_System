<div class="py-32 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-6 mb-20">
            <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Help Center</span>
            <h1 class="text-6xl font-black text-slate-900 leading-tight">Got <span class="text-emerald-600">Questions?</span></h1>
            <p class="text-slate-500 text-xl font-medium">Find quick answers to common questions about our services and delivery.</p>
        </div>

        <div class="space-y-6" x-data="{ active: null }">
            @php
                $faqs = [
                    ['q' => 'How fast is your delivery?', 'a' => 'Our express delivery team typically arrives at your doorstep within 15-30 minutes of order confirmation.'],
                    ['q' => 'Do you require a prescription?', 'a' => 'Yes, for restricted medicines, a valid prescription from a certified doctor is required. You can upload it during checkout.'],
                    ['q' => 'What payment methods do you accept?', 'a' => 'We accept Cash on Delivery (COD), credit/debit cards, and popular mobile wallets.'],
                    ['q' => 'Can I return my order?', 'a' => 'Yes, we have a 7-day easy return policy for unopened and undamaged medical products.'],
                ];
            @endphp

            @foreach($faqs as $index => $faq)
            <div class="bg-white rounded-[32px] overflow-hidden shadow-sm border border-slate-100">
                <button @click="active = (active === {{ $index }} ? null : {{ $index }})" class="w-full px-10 py-8 flex items-center justify-between text-left transition-all hover:bg-slate-50/50">
                    <span class="text-lg font-black text-slate-900">{{ $faq['q'] }}</span>
                    <svg class="w-6 h-6 text-emerald-500 transition-transform duration-300" :class="active === {{ $index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="active === {{ $index }}" x-collapse>
                    <div class="px-10 pb-8 text-slate-500 font-medium leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
