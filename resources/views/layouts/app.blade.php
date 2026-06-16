<!DOCTYPE html>
<html lang="en" class="scroll-smooth" style="scroll-padding-top: 90px;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Space IQ')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::where('key', 'seo_description')->value('value') ?? 'Hyper-realistic 4K renders that captivate clients.')">
    <meta name="keywords" content="architectural rendering, 3D visualization, exterior render, interior render, floor plans, 360 views, walkthrough animation, CGI, architectural visualization studio">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ request()->url() }}">
    <meta name="theme-color" content="#0E7C7B">
    
    <!-- Open Graph SEO -->
    <meta property="og:title" content="@yield('title', 'Space IQ')">
    <meta property="og:description" content="@yield('meta_description', 'High-Fidelity Renders. Professional Delivery. Zero Compromise.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:image" content="@yield('og_image', asset('img/exterior_render.png'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Space IQ')">
    <meta name="twitter:description" content="@yield('meta_description', 'High-Fidelity Renders. Professional Delivery. Zero Compromise.')">
    <meta name="twitter:image" content="@yield('og_image', asset('img/exterior_render.png'))">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "ProfessionalService",
        "name": "Space IQ Design Studio",
        "description": "Hyper-realistic 4K architectural renders, 360 virtual tours, walkthrough animations, and floor plans.",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('img/logo.png') }}",
        "image": "{{ asset('img/exterior_render.png') }}",
        "sameAs": [],
        "serviceType": ["Architectural Visualization", "3D Rendering", "360 Virtual Tours", "Walkthrough Animation", "Floor Plans"],
        "areaServed": "Worldwide"
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN for development) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-brand-950: #080e0e;
            --color-brand-900: #0c1818;
            --color-brand-800: #122828;
            --color-brand-700: #1a3a3a;
            --color-brand-600: #0E7C7B;
            --color-brand-500: #1A9E96;
            --color-brand-400: #3AADAA;
            --color-brand-300: #7EC8C0;
            --color-accent-500: #0E7C7B;
            --color-accent-400: #1A9E96;
            --color-accent-300: #3AADAA;
            --font-display: 'Montserrat', sans-serif;
            --font-sans: 'Montserrat', sans-serif;
        }
        
        body { 
            font-family: var(--font-sans); 
            background-color: var(--color-brand-950);
            color: #f8fafc;
        }
        
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: var(--font-display);
        }
        
        .glass-nav {
            background: rgba(8, 14, 14, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(14, 124, 123, 0.1);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease;
        }
        .glass-card:hover {
            border-color: rgba(14, 124, 123, 0.35);
            background: rgba(14, 124, 123, 0.04);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #7EC8C0 50%, #1A9E96 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Custom Rich Text Parser for Quill/HTML Output */
        .rich-text h1 { font-size: 2.25rem; font-weight: 700; margin-bottom: 1rem; margin-top: 2rem; font-family: var(--font-display); color: #ffffff; }
        .rich-text h2 { font-size: 1.75rem; font-weight: 700; margin-bottom: 1rem; margin-top: 2rem; font-family: var(--font-display); color: #ffffff; }
        .rich-text h3 { font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; margin-top: 1.5rem; font-family: var(--font-display); color: #3AADAA; }
        .rich-text p { margin-bottom: 1.25rem; line-height: 1.8; color: #d1d5db; font-weight: 300; }
        .rich-text ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.25rem; color: #d1d5db; }
        .rich-text ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.25rem; color: #d1d5db; }
        .rich-text li { margin-bottom: 0.5rem; padding-left: 0.25rem; }
        .rich-text li::marker { color: #1A9E96; }
        .rich-text a { color: #1A9E96; text-decoration: none; font-weight: 500; transition: color 0.2s; }
        .rich-text a:hover { color: #3AADAA; text-decoration: underline; }
        .rich-text strong, .rich-text b { color: #ffffff; font-weight: 600; }
        .rich-text blockquote { border-left: 4px solid #0E7C7B; padding-left: 1rem; font-style: italic; color: #9ca3af; margin-bottom: 1.25rem; background: rgba(14, 124, 123, 0.05); padding: 1rem; border-radius: 0 4px 4px 0; }
        .rich-text pre { background: #0c1818; padding: 1rem; border-radius: 0.5rem; overflow-x: auto; margin-bottom: 1.25rem; border: 1px solid rgba(14, 124, 123, 0.1); }
        .rich-text code { font-family: monospace; background: rgba(14, 124, 123, 0.15); padding: 0.1rem 0.3rem; border-radius: 0.25rem; font-size: 0.875em; }
        
        .btn-glow {
            box-shadow: 0 0 20px rgba(14, 124, 123, 0.25);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(26, 158, 150, 0.45);
            transform: translateY(-2px);
        }

        /* ── Page Loading Bar ── */
        #page-loader {
            position: fixed; top: 0; left: 0; width: 0%; height: 3px;
            background: linear-gradient(90deg, #0E7C7B, #3AADAA, #0E7C7B);
            background-size: 200% 100%;
            animation: loader-shimmer 1.2s linear infinite;
            z-index: 9999;
            transition: width 0.3s ease;
        }
        @keyframes loader-shimmer {
            0%   { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ── Scroll Reveal ── */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal-left.visible {
            opacity: 1;
            transform: translateX(0);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* ── Back To Top ── */
        #back-to-top {
            position: fixed; bottom: 100px; right: 24px;
            width: 44px; height: 44px;
            background: rgba(12,24,24,0.9);
            border: 1px solid rgba(26,158,150,0.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; z-index: 1000;
            opacity: 0; pointer-events: none;
            transition: opacity 0.3s, transform 0.3s, border-color 0.3s;
            backdrop-filter: blur(8px);
        }
        #back-to-top.show {
            opacity: 1; pointer-events: auto;
        }
        #back-to-top:hover {
            border-color: rgba(26,158,150,0.9);
            transform: translateY(-3px);
        }

        /* ── WhatsApp Button ── */
        #whatsapp-btn {
            position: fixed; bottom: 24px; right: 24px;
            width: 52px; height: 52px;
            background: #25D366;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; z-index: 1000;
            box-shadow: 0 4px 20px rgba(37,211,102,0.4);
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
        }
        #whatsapp-btn:hover {
            transform: scale(1.1) translateY(-2px);
            box-shadow: 0 6px 28px rgba(37,211,102,0.55);
        }
        #whatsapp-btn svg { width: 28px; height: 28px; }

        /* ── Active Nav ── */
        .nav-active {
            color: #1A9E96 !important;
            position: relative;
        }
        .nav-active::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0; right: 0;
            height: 2px;
            background: #1A9E96;
            border-radius: 1px;
        }

        /* ── Fix #10: Form Input Focus Glow ── */
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: rgba(26, 158, 150, 0.7) !important;
            box-shadow: 0 0 0 3px rgba(26, 158, 150, 0.18), 0 0 12px rgba(26, 158, 150, 0.12);
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }

        /* ── Nav Link Underline hover ── */
        .nav-link-underline {
            position: relative;
        }
        .nav-link-underline::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1.5px;
            bottom: -4px;
            left: 50%;
            background-color: #1A9E96;
            transition: width 0.3s ease, left 0.3s ease;
        }
        .nav-link-underline:hover::after {
            width: 100%;
            left: 0;
        }

        /* ── Page Entrance Transition ── */
        .page-entrance {
            opacity: 0;
            transform: translateY(12px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .page-entrance.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── 3D Perspective Card Tilt ── */
        .tilt-card {
            transition: transform 0.25s cubic-bezier(0.25, 1, 0.5, 1), border-color 0.3s ease, box-shadow 0.3s ease;
            transform-style: preserve-3d;
            will-change: transform;
        }
    </style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @yield('head')
</head>
<body class="antialiased overflow-x-hidden relative" x-data="{ pageLoaded: false }" x-init="window.addEventListener('load', () => pageLoaded = true)">
    <!-- Page Loading Bar -->
    <div id="page-loader"></div>
    
    <!-- Navbar -->
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)" 
            class="fixed w-full left-0 z-50 transition-all duration-300 pointer-events-none"
            :class="scrolled ? 'top-4 px-4' : 'top-0 px-0'">
        <div class="w-full transition-all duration-300 pointer-events-auto"
             :class="scrolled ? 'max-w-5xl mx-auto px-6 py-2 bg-brand-900/90 backdrop-blur-md border border-white/10 rounded-full shadow-2xl' : 'px-6 md:px-12 py-5 {{ request()->routeIs('home') ? 'bg-transparent border-transparent' : 'border-b border-white/5 bg-brand-950/20 backdrop-blur-sm' }}'">
            <div class="flex items-center justify-between gap-8 w-full">
                <!-- Logo (Extreme Left) -->
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Space IQ Design Studio" 
                         class="w-auto drop-shadow-lg transition-all duration-300 group-hover:scale-105"
                         :class="scrolled ? 'h-9' : 'h-12'">
                    <div class="flex flex-col leading-tight">
                        <span class="font-display font-bold tracking-wider text-white transition-all duration-300"
                              :class="scrolled ? 'text-sm' : 'text-lg'">Space IQ</span>
                        <span class="font-display font-light tracking-widest text-white/70 uppercase transition-all duration-300"
                              :class="scrolled ? 'text-[8px]' : 'text-[10px]'">Design Studio</span>
                    </div>
                </a>

                <!-- Services Links (Middle) -->
                <div class="hidden lg:flex flex-grow items-center justify-center flex-wrap gap-x-5 gap-y-3 text-[11px] tracking-widest uppercase text-white font-medium" x-data="{ activeMenu: null }">
                    
                    <!-- Exterior Renders Dropdown -->
                    <div class="relative" @mouseenter="activeMenu = 'exterior'" @mouseleave="activeMenu = null">
                        <a href="{{ route('service.show', 'exterior-renders') }}" class="nav-link-underline hover:text-accent-400 transition-colors whitespace-nowrap flex items-center gap-1 cursor-pointer focus:outline-none uppercase font-semibold">
                            Exterior Renders
                            <svg class="w-3 h-3 transition-transform duration-200" :class="activeMenu === 'exterior' ? 'rotate-180 text-accent-400' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div x-show="activeMenu === 'exterior'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-1/2 -translate-x-1/2 mt-3 w-48 bg-brand-900/98 backdrop-blur-md border border-white/10 shadow-2xl rounded-md py-2 z-50 text-left"
                             style="display: none;">

                            <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'residential']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">Residential</a>
                            <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'commercial']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">Commercial</a>
                            <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'aerial']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">Aerial</a>
                            <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'landscape']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">Landscape</a>
                        </div>
                    </div>

                    <span class="text-white/20">|</span>

                    <!-- Interior Renders Dropdown -->
                    <div class="relative" @mouseenter="activeMenu = 'interior'" @mouseleave="activeMenu = null">
                        <a href="{{ route('service.show', 'interior-renders') }}" class="nav-link-underline hover:text-accent-400 transition-colors whitespace-nowrap flex items-center gap-1 cursor-pointer focus:outline-none uppercase font-semibold">
                            Interior Renders
                            <svg class="w-3 h-3 transition-transform duration-200" :class="activeMenu === 'interior' ? 'rotate-180 text-accent-400' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div x-show="activeMenu === 'interior'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-1/2 -translate-x-1/2 mt-3 w-48 bg-brand-900/98 backdrop-blur-md border border-white/10 shadow-2xl rounded-md py-2 z-50 text-left"
                             style="display: none;">

                            <a href="{{ route('service.show', ['slug' => 'interior-renders', 'subcategory' => 'residential']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">Residential</a>
                            <a href="{{ route('service.show', ['slug' => 'interior-renders', 'subcategory' => 'commercial']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">Commercial</a>
                        </div>
                    </div>

                    <span class="text-white/20">|</span>

                    <!-- 3D Animation Link -->
                    <a href="{{ route('service.show', 'walkthrough-animation') }}" class="nav-link-underline hover:text-accent-400 transition-colors whitespace-nowrap">3D Animation</a>

                    <span class="text-white/20">|</span>

                    <!-- 360 Views Link -->
                    <a href="{{ route('service.show', '360-views') }}" class="nav-link-underline hover:text-accent-400 transition-colors whitespace-nowrap">360 Views</a>

                    <span class="text-white/20">|</span>

                    <!-- Floor Plans Dropdown -->
                    <div class="relative" @mouseenter="activeMenu = 'floorplans'" @mouseleave="activeMenu = null">
                        <a href="{{ route('service.show', 'floor-plans') }}" class="nav-link-underline hover:text-accent-400 transition-colors whitespace-nowrap flex items-center gap-1 cursor-pointer focus:outline-none uppercase font-semibold">
                            Floor Plans
                            <svg class="w-3 h-3 transition-transform duration-200" :class="activeMenu === 'floorplans' ? 'rotate-180 text-accent-400' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div x-show="activeMenu === 'floorplans'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-1/2 -translate-x-1/2 mt-3 w-48 bg-brand-900/98 backdrop-blur-md border border-white/10 shadow-2xl rounded-md py-2 z-50 text-left"
                             style="display: none;">

                            <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'b-w']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">B&W</a>
                            <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'color']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">Color</a>
                            <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'site-plan']) }}" class="block px-4 py-2.5 text-[10px] text-gray-300 hover:text-white hover:bg-brand-800 transition-colors tracking-widest font-semibold uppercase">Site Plan</a>
                        </div>
                    </div>

                    <span class="text-white/20">|</span>

                    <!-- 2D Drafting Link -->
                    <a href="{{ route('service.show', 'autocad-drafting') }}" class="nav-link-underline hover:text-accent-400 transition-colors whitespace-nowrap">2D Drafting</a>

                    <span class="text-white/20">|</span>

                    <!-- Design Link -->
                    <a href="{{ route('service.show', 'interior-design-consultation') }}" class="nav-link-underline hover:text-accent-400 transition-colors whitespace-nowrap">Design</a>
                </div>

                <!-- Contact Us (Extreme Right) -->
                <nav class="hidden lg:flex flex-shrink-0 items-center">
                    <a href="{{ route('contact') }}" 
                       class="text-[11px] uppercase tracking-widest font-bold bg-accent-500 hover:bg-accent-400 text-white transition-all duration-300 shadow-lg whitespace-nowrap"
                       :class="scrolled ? 'rounded-full px-5 py-2.5' : 'rounded-sm px-6 py-3'">CONTACT US</a>
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden flex-shrink-0 text-gray-300 hover:text-white focus:outline-none">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden absolute top-full left-0 w-full glass-nav border-t border-white/5 py-4 px-6 flex flex-col gap-4 shadow-xl text-left overflow-y-auto max-h-[80vh] pointer-events-auto"
             x-data="{ activeMobileSub: null }">
            
            <!-- Exterior Rendering Accordion -->
            <div>
                <button @click="activeMobileSub = (activeMobileSub === 'exterior' ? null : 'exterior')" class="w-full flex items-center justify-between text-xs font-medium uppercase tracking-widest text-gray-300 hover:text-white focus:outline-none">
                    <span>Exterior Rendering</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSub === 'exterior' ? 'rotate-180 text-accent-400' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="activeMobileSub === 'exterior'" x-transition class="pl-4 mt-2 flex flex-col gap-2 border-l border-white/10" style="display: none;">

                    <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'residential']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">Residential</a>
                    <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'commercial']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">Commercial</a>
                    <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'aerial']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">Aerial</a>
                    <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'landscape']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">Landscape</a>
                </div>
            </div>

            <!-- Interior Rendering Accordion -->
            <div>
                <button @click="activeMobileSub = (activeMobileSub === 'interior' ? null : 'interior')" class="w-full flex items-center justify-between text-xs font-medium uppercase tracking-widest text-gray-300 hover:text-white focus:outline-none">
                    <span>Interior Rendering</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSub === 'interior' ? 'rotate-180 text-accent-400' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="activeMobileSub === 'interior'" x-transition class="pl-4 mt-2 flex flex-col gap-2 border-l border-white/10" style="display: none;">

                    <a href="{{ route('service.show', ['slug' => 'interior-renders', 'subcategory' => 'residential']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">Residential</a>
                    <a href="{{ route('service.show', ['slug' => 'interior-renders', 'subcategory' => 'commercial']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">Commercial</a>
                </div>
            </div>

            <!-- 3D Animation Link -->
            <a href="{{ route('service.show', 'walkthrough-animation') }}" @click="mobileMenuOpen = false" class="text-xs font-medium uppercase tracking-widest text-gray-300 hover:text-white">3D Animation</a>
            
            <!-- 360 Views Link -->
            <a href="{{ route('service.show', '360-views') }}" @click="mobileMenuOpen = false" class="text-xs font-medium uppercase tracking-widest text-gray-300 hover:text-white">360 Views</a>
            
            <!-- Floor Plans Accordion -->
            <div>
                <button @click="activeMobileSub = (activeMobileSub === 'floorplans' ? null : 'floorplans')" class="w-full flex items-center justify-between text-xs font-medium uppercase tracking-widest text-gray-300 hover:text-white focus:outline-none">
                    <span>Floor Plans</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSub === 'floorplans' ? 'rotate-180 text-accent-400' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="activeMobileSub === 'floorplans'" x-transition class="pl-4 mt-2 flex flex-col gap-2 border-l border-white/10" style="display: none;">

                    <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'b-w']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">B&W</a>
                    <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'color']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">Color</a>
                    <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'site-plan']) }}" @click="mobileMenuOpen = false" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white py-1">Site Plan</a>
                </div>
            </div>

            <!-- 2D Drafting Link -->
            <a href="{{ route('service.show', 'autocad-drafting') }}" @click="mobileMenuOpen = false" class="text-xs font-medium uppercase tracking-widest text-gray-300 hover:text-white">2D Drafting</a>
            
            <!-- Design Link -->
            <a href="{{ route('service.show', 'interior-design-consultation') }}" @click="mobileMenuOpen = false" class="text-xs font-medium uppercase tracking-widest text-gray-300 hover:text-white">Design</a>
            
            <hr class="border-white/10 my-2">
            
            <a href="{{ route('contact') }}" @click="mobileMenuOpen = false"
               class="block w-full text-center text-sm font-bold uppercase tracking-widest bg-accent-500 hover:bg-accent-400 text-white py-3 px-6 transition-colors duration-300 shadow-lg">CONTACT US</a>
        </div>
    </header>

    <main class="min-h-screen page-entrance" :class="pageLoaded ? 'loaded' : ''">
        @yield('content')
    </main>

    @php
        $settings = \App\Models\Setting::pluck('value', 'key');
    @endphp

    <!-- Footer -->
    <footer class="relative border-t border-white/5 bg-brand-950 pt-20 pb-10">
        <!-- Glowing Top Border Accent Line -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-[1px] bg-gradient-to-r from-transparent via-accent-400/40 to-transparent"></div>
        
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                <!-- Column 1: About -->
                <div class="col-span-1 md:col-span-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-6 group">
                        <img src="{{ asset('img/logo.png') }}" alt="Space IQ Design Studio" 
                             class="h-12 w-auto drop-shadow-[0_0_15px_rgba(26,158,150,0.15)] opacity-90 group-hover:opacity-100 transition-opacity">
                        <div class="flex flex-col leading-tight">
                            <span class="font-display font-bold text-lg tracking-wider text-white">Space IQ</span>
                            <span class="font-display font-light text-[10px] tracking-widest text-white/60 uppercase">Design Studio</span>
                        </div>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6 font-light max-w-sm">
                        {{ \App\Models\Setting::where('key', 'seo_description')->value('value') ?? 'High-Fidelity Renders. Professional Delivery. Zero Compromise.' }}
                    </p>
                </div>
                
                <!-- Column 2: Services (Show all of them) -->
                <div class="col-span-1 md:col-span-3">
                    <h3 class="text-white font-bold uppercase tracking-widest text-xs mb-4 text-accent-400">Services</h3>
                    <ul class="space-y-2">
                        @foreach(\App\Models\Service::where('is_active', true)->orderBy('sort_order')->get() as $service)
                        <li>
                            <a href="{{ route('service.show', $service->slug) }}" class="inline-block text-gray-400 hover:text-accent-300 text-sm transition-all duration-300 font-light hover:translate-x-1 transform">
                                {{ $service->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Column 3: Company -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-white font-bold uppercase tracking-widest text-xs mb-4 text-accent-400">Company</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}#process" class="inline-block text-gray-400 hover:text-accent-300 text-sm transition-all duration-300 font-light hover:translate-x-1 transform">
                                Our Process
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="inline-block text-gray-400 hover:text-accent-300 text-sm transition-all duration-300 font-light hover:translate-x-1 transform">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('page.show', 'privacy-policy') }}" class="inline-block text-gray-400 hover:text-accent-300 text-sm transition-all duration-300 font-light hover:translate-x-1 transform">
                                Privacy Policy
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Column 4: Connect -->
                <div class="col-span-1 md:col-span-3">
                    <h3 class="text-white font-bold uppercase tracking-widest text-xs mb-4 text-accent-400">Connect</h3>
                    <ul class="space-y-2 font-light text-sm text-gray-400">
                        <!-- Instagram -->
                        <li>
                            <a href="https://instagram.com/space_iq_" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 hover:text-accent-300 transition-all duration-300 group w-max hover:translate-x-1 transform">
                                <svg class="w-5 h-5 text-accent-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                <span>@space_iq_</span>
                            </a>
                        </li>
                        
                        <!-- Email -->
                        <li>
                            <a href="mailto:spaceiqstudio@gmail.com" class="flex items-center gap-3 hover:text-accent-300 transition-all duration-300 group w-max hover:translate-x-1 transform">
                                <svg class="w-5 h-5 text-accent-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>spaceiqstudio@gmail.com</span>
                            </a>
                        </li>

                        <!-- Phone -->
                        <li>
                            <a href="tel:+918121376325" class="flex items-center gap-3 hover:text-accent-300 transition-all duration-300 group w-max hover:translate-x-1 transform">
                                <svg class="w-5 h-5 text-accent-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>+91 81213 76325</span>
                            </a>
                        </li>

                        <!-- Address -->
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-accent-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="leading-relaxed">Mohali, Punjab (India)</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer CTA Strip -->
            <div class="reveal mb-16 rounded-xl overflow-hidden relative border border-accent-400/20" style="background: linear-gradient(135deg, rgba(14,124,123,0.15) 0%, rgba(8,14,14,0.8) 60%, rgba(26,158,150,0.1) 100%)">
                <div class="absolute inset-0 opacity-5" style="background-image: repeating-linear-gradient(45deg, #1A9E96 0, #1A9E96 1px, transparent 0, transparent 50%); background-size: 12px 12px;"></div>
                <div class="relative z-10 px-8 py-12 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-accent-400 font-bold mb-2">Ready to get started?</p>
                        <h3 class="text-2xl md:text-3xl font-display font-bold text-white">Turn your vision into reality.<br class="hidden md:block"> <span class="text-gradient">Let's talk today.</span></h3>
                    </div>
                    <a href="{{ route('contact') }}" class="flex-shrink-0 px-10 py-4 bg-accent-500 hover:bg-accent-400 text-white font-bold uppercase tracking-widest text-sm transition-all duration-300 rounded-sm shadow-xl hover:shadow-accent-400/30 hover:-translate-y-1">
                        Book a Free Consultation
                    </a>
                </div>
            </div>

            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-xs font-light uppercase tracking-widest">
                    &copy; {{ date('Y') }} Space IQ Design Studio. All rights reserved.
                </p>
                <div class="text-gray-500 text-xs font-light uppercase tracking-widest">
                    High-Fidelity Renders. Professional Delivery. Zero Compromise.
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">
        <svg width="18" height="18" fill="none" stroke="#1A9E96" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
    </button>

    <!-- WhatsApp Floating Button -->
    <a id="whatsapp-btn" href="https://wa.me/918121376325?text=Hi%20Space%20IQ%20Design%20Studio%2C%20I%27d%20like%20to%20inquire%20about%20your%20services." target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
        <svg viewBox="0 0 32 32" fill="white" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 1C7.716 1 1 7.716 1 16c0 2.628.676 5.1 1.856 7.253L1 31l7.95-1.825A14.93 14.93 0 0016 31c8.284 0 15-6.716 15-15S24.284 1 16 1zm0 27.2a12.13 12.13 0 01-6.18-1.693l-.443-.263-4.717 1.083 1.108-4.6-.29-.474A12.16 12.16 0 013.8 16C3.8 9.263 9.263 3.8 16 3.8S28.2 9.263 28.2 16 22.737 28.2 16 28.2zm6.67-9.077c-.365-.183-2.16-1.065-2.494-1.187-.334-.122-.578-.183-.82.183-.244.366-.943 1.187-1.157 1.431-.213.244-.427.274-.792.092-.365-.183-1.54-.568-2.932-1.81-1.084-.967-1.815-2.161-2.028-2.527-.213-.366-.023-.563.16-.745.164-.163.365-.427.547-.64.183-.214.244-.366.366-.61.122-.244.061-.457-.03-.64-.092-.183-.82-1.98-1.124-2.71-.296-.71-.597-.613-.82-.625-.213-.01-.457-.012-.701-.012-.244 0-.64.091-.975.457-.335.365-1.278 1.248-1.278 3.044 0 1.797 1.309 3.532 1.49 3.776.183.244 2.577 3.935 6.245 5.518.872.377 1.553.602 2.083.77.875.278 1.672.239 2.302.145.702-.105 2.16-.883 2.465-1.736.305-.853.305-1.585.213-1.736-.09-.152-.335-.244-.7-.427z"/>
        </svg>
    </a>

    <script>
        // ── Page Loading Bar ──
        (function() {
            const bar = document.getElementById('page-loader');
            if (!bar) return;
            let w = 0;
            bar.style.width = '20%';
            const t = setInterval(() => {
                w = Math.min(w + Math.random() * 15, 85);
                bar.style.width = w + '%';
            }, 200);
            window.addEventListener('load', () => {
                clearInterval(t);
                bar.style.width = '100%';
                setTimeout(() => { bar.style.opacity = '0'; bar.style.transition = 'opacity 0.4s'; }, 300);
                setTimeout(() => { bar.style.display = 'none'; }, 800);
            });
        })();

        // ── Scroll Reveal ──
        (function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                        observer.unobserve(e.target);
                    }
                });
            }, { threshold: 0.12 });
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));
        })();

        // ── Back to Top ──
        (function() {
            const btn = document.getElementById('back-to-top');
            window.addEventListener('scroll', () => {
                btn.classList.toggle('show', window.scrollY > 400);
            });
        })();

        // ── Active Nav Highlight ──
        (function() {
            const path = window.location.pathname;
            document.querySelectorAll('header a').forEach(a => {
                if (a.querySelector('img')) return; // skip logo
                try {
                    const href = new URL(a.href).pathname;
                    if (href === path && href !== '/') {
                        a.classList.add('nav-active');
                    } else if (path === '/' && href === '/') {
                        a.classList.add('nav-active');
                    }
                } catch(e) {}
            });
        })();

        // ── 3D Perspective Card Tilt ──
        (function() {
            if (window.innerWidth < 768) return;
            
            const initTilt = () => {
                document.querySelectorAll('.tilt-card').forEach(card => {
                    card.removeEventListener('mousemove', handleMouseMove);
                    card.removeEventListener('mouseleave', handleMouseLeave);
                    
                    card.addEventListener('mousemove', handleMouseMove);
                    card.addEventListener('mouseleave', handleMouseLeave);
                });
            };
            
            function handleMouseMove(e) {
                const card = this;
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const xc = rect.width / 2;
                const yc = rect.height / 2;
                
                const dx = x - xc;
                const dy = y - yc;
                
                const rx = -(dy / yc) * 6;
                const ry = (dx / xc) * 6;
                
                card.style.transform = `perspective(1000px) rotateX(${rx}deg) rotateY(${ry}deg) scale3d(1.015, 1.015, 1.015)`;
            }
            
            function handleMouseLeave() {
                this.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            }
            
            window.addEventListener('load', initTilt);
            setInterval(initTilt, 2000);
        })();
    </script>
    @stack('scripts')
</body>
</html>
