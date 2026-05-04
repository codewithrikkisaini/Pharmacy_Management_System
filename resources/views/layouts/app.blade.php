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

        .hero-gradient {
            background: radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
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

<body class="bg-slate-50 text-slate-900 antialiased hero-gradient min-h-screen flex flex-col" x-data="{ mobileMenuOpen: false }">
    <!-- Navigation -->
    <nav class="glass sticky top-0 z-50 border-b border-emerald-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-black flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-200 group-hover:rotate-12 transition-transform overflow-hidden">
                            @if(!empty($site_settings->site_logo))
                                <img src="{{ Storage::url($site_settings->site_logo) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            @endif
                        </div>
                        <span class="text-gradient hidden sm:block">{{ $site_settings->site_name ?? 'MediCare' }}</span>
                    </a>
                    <div class="hidden lg:ml-10 lg:flex lg:space-x-8">
                        <a href="{{ route('home') }}" class="text-sm font-bold {{ request()->routeIs('home') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }} transition-all">Home</a>
                        <a href="{{ route('medicines') }}" class="text-sm font-bold {{ request()->routeIs('medicines') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }} transition-all">Medicines</a>
                        <a href="{{ route('doctors') }}" class="text-sm font-bold {{ request()->routeIs('doctors') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }} transition-all">Doctors</a>
                        <a href="{{ route('blogs') }}" class="text-sm font-bold {{ request()->routeIs('blogs') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }} transition-all">Health Articles</a>
                    </div>
                </div>

                <div class="flex items-center space-x-2 sm:space-x-6">
                    <!-- Cart -->
                    <a href="{{ route('cart') }}" class="relative group p-2">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-emerald-500 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @php $cartCount = count(session()->get('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-emerald-500 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-400 hover:text-emerald-500 transition-all">
                        <svg class="w-6 h-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg class="w-6 h-6" x-show="mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>

                    <div class="hidden lg:flex items-center space-x-6">
                        @auth
                            <div class="flex items-center space-x-6">
                                <a href="{{ route('profile') }}" class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-all">My Profile</a>
                                @if(auth()->user()->role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-white bg-emerald-600 px-6 py-3 rounded-xl shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition-all animate-pulse">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Go to Backend
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-slate-400 hover:text-red-500 transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-all">Login</a>
                            <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-8 py-3.5 rounded-2xl font-black text-sm shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all">Join Now</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="lg:hidden bg-white border-t border-slate-100 p-6 space-y-4 shadow-xl">
            <a href="{{ route('home') }}" class="block text-lg font-black text-slate-900">Home</a>
            <a href="{{ route('medicines') }}" class="block text-lg font-black text-slate-900">Medicines</a>
            <a href="{{ route('doctors') }}" class="block text-lg font-black text-slate-900">Doctors</a>
            <a href="{{ route('blogs') }}" class="block text-lg font-black text-slate-900">Health Articles</a>
            <hr class="border-slate-100">
            @auth
                <a href="{{ route('profile') }}" class="block text-lg font-black text-emerald-600">My Profile</a>
                <a href="{{ route('my-orders') }}" class="block text-lg font-black text-slate-900">My Orders</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block text-lg font-black text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-lg font-black text-slate-900">Login</a>
                <a href="{{ route('register') }}" class="block text-lg font-black text-emerald-600">Register</a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-20 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="space-y-6">
                <div class="text-2xl font-black flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <span>{{ $site_settings->site_name ?? 'MediCare' }}</span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed">{{ $site_settings->site_description ?? 'Your trusted pharmacy partner.' }}</p>
            </div>
            <div>
                <h4 class="font-black text-xs uppercase tracking-widest text-slate-500 mb-6">Quick Links</h4>
                <ul class="space-y-4 text-sm font-bold text-slate-300">
                    <li><a href="{{ route('about') }}" class="hover:text-emerald-500">About Us</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-emerald-500">FAQ</a></li>
                    <li><a href="{{ route('how-to-order') }}" class="hover:text-emerald-500">How to Order</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-xs uppercase tracking-widest text-slate-500 mb-6">Contact</h4>
                <ul class="space-y-4 text-sm font-bold text-slate-300">
                    <li>{{ $site_settings->site_email ?? 'support@medicare.com' }}</li>
                    <li>{{ $site_settings->site_phone ?? '+1 (555) 000-0000' }}</li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-xs uppercase tracking-widest text-slate-500 mb-6">Social</h4>
                <div class="flex space-x-4">
                    <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-emerald-500 transition-all cursor-pointer">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-20 pt-8 border-t border-white/5 text-center text-[10px] font-black uppercase tracking-[0.4em] text-slate-600">
            &copy; {{ date('Y') }} {{ $site_settings->site_name ?? 'MediCare' }} - All Rights Reserved.
        </div>
    </footer>

    @livewireScripts
</body>

</html>