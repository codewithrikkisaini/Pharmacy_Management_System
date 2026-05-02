<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MediCare Admin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <style>
            body { 
                font-family: 'Plus Jakarta Sans', sans-serif; 
                background-color: #f8fafc;
            }
            .sidebar-link.active {
                background-color: #0ea5e9;
                color: white;
            }
            .sidebar-link:not(.active) {
                color: #64748b;
            }
            .sidebar-link:not(.active):hover {
                background-color: #f1f5f9;
                color: #0f172a;
            }
            .card-shadow {
                box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            }
            .gradient-banner {
                background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r flex flex-col sticky top-0 h-screen z-20">
                <div class="p-6 flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold">M</div>
                    <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">MediCare</h1>
                </div>
                
                <nav class="flex-1 px-4 space-y-1 overflow-y-auto pt-4">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-4 mb-2">Main Menu</div>
                    
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.medicines') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.medicines') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Products
                    </a>

                    <a href="{{ route('admin.categories') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.categories') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                        Categories
                    </a>

                    <a href="{{ route('admin.orders') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.orders') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Orders
                    </a>

                    <div class="pt-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest px-4 mb-2">Team & Appointments</div>

                    <a href="{{ route('admin.doctors') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.doctors') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Doctors
                    </a>

                    <a href="{{ route('admin.appointments') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.appointments') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Appointments
                    </a>

                    <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Users
                    </a>

                    <a href="{{ route('admin.messages') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.messages') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        Enquiries
                    </a>

                    <a href="{{ route('admin.banners') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.banners') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h14a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Banners
                    </a>

                    <a href="{{ route('admin.blogs') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.blogs') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Blogs
                    </a>

                    <a href="{{ route('admin.settings') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.settings') ? 'active shadow-lg shadow-sky-100' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Settings
                    </a>
                </nav>

                <div class="p-4 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-sm font-bold text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-h-screen relative">
                <header class="h-16 bg-white flex items-center justify-between px-8 border-b sticky top-0 z-10">
                    <div class="flex items-center">
                        <h2 class="text-xl font-bold text-slate-800">Dashboard</h2>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <div class="relative hidden md:block">
                            <input type="text" placeholder="Search..." class="bg-slate-100 border-none rounded-full px-5 py-2 text-sm w-64 focus:ring-2 focus:ring-indigo-500 transition-all">
                            <svg class="w-4 h-4 text-slate-400 absolute right-4 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        
                        <button class="text-slate-400 hover:text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </button>

                        <div class="flex items-center space-x-3 border-l pl-6">
                            <div class="text-right">
                                <div class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Admin</div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white text-sm font-black">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @livewireScripts
    </body>
</html>
