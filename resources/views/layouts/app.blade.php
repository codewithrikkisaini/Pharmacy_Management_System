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
            body { font-family: 'Outfit', sans-serif; }
            .glass {
                background: rgba(255, 255, 255, 0.7);
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
    <body class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 antialiased hero-gradient min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="glass sticky top-0 z-50 border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="/" class="text-2xl font-black text-blue-600 dark:text-blue-400">MediCare</a>
                        <div class="hidden md:ml-10 md:flex md:space-x-8">
                            <a href="{{ route('home') }}" class="text-sm font-bold {{ request()->routeIs('home') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">Home</a>
                            <a href="{{ route('medicines') }}" class="text-sm font-bold {{ request()->routeIs('medicines') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">Medicines</a>
                            <a href="{{ route('doctors') }}" class="text-sm font-bold {{ request()->routeIs('doctors') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">Doctors</a>
                            <a href="/contact" class="text-sm font-bold hover:text-blue-600 transition-colors">Contact</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        @auth
                            <div class="flex items-center space-x-4">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-indigo-600">Admin Panel</a>
                                @endif
                                <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-600 transition-colors">Logout</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold hover:text-indigo-600 transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition-all">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-slate-50 dark:bg-slate-900 border-t py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="space-y-4">
                    <h2 class="text-xl font-bold text-indigo-600">MediCare</h2>
                    <p class="text-sm text-slate-500">Your trusted partner for all medical needs. Quality medicines delivered with care.</p>
                </div>
                <div>
                    <h3 class="font-bold mb-6">Quick Links</h3>
                    <ul class="space-y-4 text-sm text-slate-500">
                        <li><a href="/about" class="hover:text-indigo-600">About Us</a></li>
                        <li><a href="/faq" class="hover:text-indigo-600">FAQ</a></li>
                        <li><a href="/how-to-order" class="hover:text-indigo-600">How to Order</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-6">Policies</h3>
                    <ul class="space-y-4 text-sm text-slate-500">
                        <li><a href="/terms" class="hover:text-indigo-600">Terms & Conditions</a></li>
                        <li><a href="/return-policy" class="hover:text-indigo-600">Return Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-6">Contact Info</h3>
                    <ul class="space-y-4 text-sm text-slate-500">
                        <li>support@medicare.com</li>
                        <li>+1 (555) 123-4567</li>
                        <li>123 Medical Ave, Health City</li>
                    </ul>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 pt-8 border-t text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} MediCare – Pharmacy Management System. All rights reserved.
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
