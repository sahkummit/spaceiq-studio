<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Space IQ Design Studio</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (CDN for development/no-node fallback) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-brand-500: #0E7C7B;
            --color-brand-600: #0B6462;
            --font-sans: 'Inter', sans-serif;
        }
        body { font-family: 'Inter', sans-serif; }
    </style>

    <!-- Alpine.js (CDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen text-gray-900 flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 transition-opacity lg:hidden" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'translate-x-0 ease-out z-30' : '-translate-x-full ease-in z-0'" class="fixed inset-y-0 left-0 w-64 bg-[#0a1f1f] overflow-y-auto transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0 lg:block lg:z-auto">
        <div class="flex items-center justify-center mt-8 px-4">
            <a href="/admin" class="block">
                <img src="{{ asset('img/logo.png') }}" alt="SpaceIQ Design Studio" class="h-12 w-auto drop-shadow-md">
            </a>
        </div>

            <a class="flex items-center px-4 py-2 mt-2 {{ request()->routeIs('admin.dashboard') ? 'text-gray-100 bg-gray-800' : 'text-gray-500 hover:bg-gray-700 hover:text-gray-100' }} rounded-lg transition" href="{{ route('admin.dashboard') }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="mx-4 font-medium">Dashboard</span>
            </a>

            <a class="flex items-center px-4 py-2 mt-2 {{ request()->routeIs('admin.services.*') ? 'text-gray-100 bg-gray-800' : 'text-gray-500 hover:bg-gray-700 hover:text-gray-100' }} rounded-lg transition-colors" href="{{ route('admin.services.index') }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="mx-4 font-medium">Services</span>
            </a>

            <a class="flex items-center px-4 py-2 mt-2 {{ request()->routeIs('admin.inquiries.*') ? 'text-gray-100 bg-gray-800' : 'text-gray-500 hover:bg-gray-700 hover:text-gray-100' }} rounded-lg transition-colors" href="{{ route('admin.inquiries.index') }}">
                 <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="mx-4 font-medium">Inquiries</span>
            </a>
            
            <a class="flex items-center px-4 py-2 mt-2 {{ request()->routeIs('admin.settings.*') ? 'text-gray-100 bg-gray-800' : 'text-gray-500 hover:bg-gray-700 hover:text-gray-100' }} rounded-lg transition-colors" href="{{ route('admin.settings.index') }}">
                 <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="mx-4 font-medium">Settings</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden min-h-screen">
        <!-- Top Header -->
        <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-[#0E7C7B]">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <div class="flex items-center" x-data="{ dropdownOpen: false }">
                <div class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none">
                        <div class="w-8 h-8 rounded-full bg-brand-500 text-white flex items-center justify-center font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10 hidden" :class="{'hidden': !dropdownOpen }">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-brand-500 hover:text-white">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Inner Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
