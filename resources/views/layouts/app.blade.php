<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MediCare') }} - Pharmacy Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.01em;
            color: #1e293b;
        }

        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.05);
        }

        .dark .glass {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .hero-gradient {
            background: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(20, 184, 166, 0.05) 0px, transparent 50%),
                #f8fafc;
        }

        .text-gradient {
            background: linear-gradient(135deg, #059669 0%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body
    class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased hero-gradient min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="glass sticky top-0 z-50 border-b border-emerald-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-black flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-200 group-hover:rotate-12 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <span class="text-gradient">MediCare</span>
                    </a>
                    <div class="hidden md:ml-10 md:flex md:space-x-10">
                        <a href="{{ route('home') }}"
                            class="text-sm font-bold {{ request()->routeIs('home') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }} transition-all">Home</a>
                        <a href="{{ route('medicines') }}"
                            class="text-sm font-bold {{ request()->routeIs('medicines') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }} transition-all">Medicines</a>
                        <a href="{{ route('doctors') }}"
                            class="text-sm font-bold {{ request()->routeIs('doctors') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }} transition-all">Doctors</a>
                        <a href="/contact" class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-all">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <!-- Cart Link -->
                    <a href="{{ route('cart') }}" class="relative group p-2">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-emerald-500 transition-all"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @php $cartCount = count(session()->get('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-emerald-500 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">{{ $cartCount }}</span>
                        @endif
                    </a>

                    @auth
                        <div class="flex items-center space-x-8">
                            <a href="{{ route('my-orders') }}"
                                class="text-sm font-bold {{ request()->routeIs('my-orders') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }} transition-all">My
                                Orders</a>
                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-4 py-2 rounded-xl border border-emerald-100 hover:bg-emerald-100 transition-all">Admin</a>
                            @endif
                            <div class="flex flex-col items-end leading-none">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Account</span>
                                <span class="text-sm font-bold text-slate-700">{{ auth()->user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="text-slate-400 hover:text-red-500 transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-all">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-emerald-600 text-white px-8 py-3.5 rounded-2xl font-black text-sm shadow-xl shadow-emerald-100 hover:bg-emerald-700 hover:-translate-y-0.5 transition-all">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white border-t border-white/5 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-16">
            <div class="space-y-8">
                <a href="/" class="text-3xl font-black flex items-center gap-2">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <span class="text-white">Medi<span class="text-emerald-500">Care</span></span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed font-medium">Your trusted partner for all medical
                    needs. Quality medicines delivered with care and professional integrity.</p>
            </div>
            <div>
                <h3 class="font-black text-xs uppercase tracking-[0.2em] text-slate-500 mb-8">Quick Links</h3>
                <ul class="space-y-4 text-sm text-slate-400 font-bold">
                    <li><a href="/about" class="hover:text-emerald-500 transition-all">About Us</a></li>
                    <li><a href="/faq" class="hover:text-emerald-500 transition-all">FAQ</a></li>
                    <li><a href="/how-to-order" class="hover:text-emerald-500 transition-all">How to Order</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-black text-xs uppercase tracking-[0.2em] text-slate-500 mb-8">Policies</h3>
                <ul class="space-y-4 text-sm text-slate-400 font-bold">
                    <li><a href="/terms" class="hover:text-emerald-500 transition-all">Terms & Conditions</a></li>
                    <li><a href="/return-policy" class="hover:text-emerald-500 transition-all">Return Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-black text-xs uppercase tracking-[0.2em] text-slate-500 mb-8">Contact Info</h3>
                <ul class="space-y-6 text-sm text-slate-400 font-bold">
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-emerald-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        support@medicare.com
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-emerald-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        +1 (555) 123-4567
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 pt-10 border-t border-white/5 text-center text-[10px] font-black uppercase tracking-[0.4em] text-slate-600">
            &copy; {{ date('Y') }} MediCare – Pharmacy Management System. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>

</html>