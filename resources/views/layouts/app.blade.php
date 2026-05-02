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
        }

        .glass {
            background: rgba(104, 104, 218, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark .glass {
            background: rgba(17, 24, 39, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.1), transparent),
                radial-gradient(circle at bottom left, rgba(16, 185, 129, 0.05), transparent);
        }
    </style>
</head>

<body
    class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 antialiased hero-gradient min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="glass sticky top-0 z-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-black text-blue-600 dark:text-blue-400">MediCare</a>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('home') }}"
                            class="text-sm font-bold {{ request()->routeIs('home') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">Home</a>
                        <a href="{{ route('medicines') }}"
                            class="text-sm font-bold {{ request()->routeIs('medicines') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">Medicines</a>
                        <a href="{{ route('doctors') }}"
                            class="text-sm font-bold {{ request()->routeIs('doctors') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">Doctors</a>
                        <a href="/contact" class="text-sm font-bold hover:text-blue-600 transition-colors">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <!-- Cart Link -->
                    <a href="{{ route('cart') }}" class="relative group p-2">
                        <svg class="w-6 h-6 text-slate-600 dark:text-slate-400 group-hover:text-blue-600 transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @php $cartCount = count(session()->get('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-blue-600 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center shadow-lg shadow-blue-200">{{ $cartCount }}</span>
                        @endif
                    </a>

                    @auth
                        <div class="flex items-center space-x-6">
                            <a href="{{ route('my-orders') }}"
                                class="text-sm font-bold {{ request()->routeIs('my-orders') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">My
                                Orders</a>
                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-indigo-600">Admin
                                    Panel</a>
                            @endif
                            <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="text-sm font-bold text-red-500 hover:text-red-600 transition-colors">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold hover:text-indigo-600 transition-colors">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition-all">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white border-t border-white/5 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-16">
            <div class="space-y-6">
                <h2 class="text-3xl font-black text-blue-500">MediCare</h2>
                <p class="text-slate-400 text-sm leading-relaxed font-medium">Your trusted partner for all medical
                    needs. Quality medicines delivered with care and professional integrity.</p>
            </div>
            <div>
                <h3 class="font-black text-xs uppercase tracking-[0.2em] text-slate-500 mb-8">Quick Links</h3>
                <ul class="space-y-4 text-sm text-slate-400 font-bold">
                    <li><a href="/about" class="hover:text-blue-500 transition-colors">About Us</a></li>
                    <li><a href="/faq" class="hover:text-blue-500 transition-colors">FAQ</a></li>
                    <li><a href="/how-to-order" class="hover:text-blue-500 transition-colors">How to Order</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-black text-xs uppercase tracking-[0.2em] text-slate-500 mb-8">Policies</h3>
                <ul class="space-y-4 text-sm text-slate-400 font-bold">
                    <li><a href="/terms" class="hover:text-blue-500 transition-colors">Terms & Conditions</a></li>
                    <li><a href="/return-policy" class="hover:text-blue-500 transition-colors">Return Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-black text-xs uppercase tracking-[0.2em] text-slate-500 mb-8">Contact Info</h3>
                <ul class="space-y-4 text-sm text-slate-400 font-bold">
                    <li class="flex items-center gap-3"><svg class="w-4 h-4 text-blue-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg> support@medicare.com</li>
                    <li class="flex items-center gap-3"><svg class="w-4 h-4 text-blue-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg> +1 (555) 123-4567</li>
                    <li class="flex items-center gap-3"><svg class="w-4 h-4 text-blue-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg> 123 Medical Ave, Health City</li>
                </ul>
            </div>
        </div>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 pt-8 border-t border-white/5 text-center text-[10px] font-black uppercase tracking-[0.3em] text-slate-600">
            &copy; {{ date('Y') }} MediCare – Pharmacy Management System. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>

</html>