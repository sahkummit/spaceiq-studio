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

    <!-- Performance Resource Hints -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://img.youtube.com">
    <link rel="preload" as="image" href="{{ asset('img/logo.png') }}" fetchpriority="high">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Engine -->
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
        
        html, body { 
            font-family: var(--font-sans); 
            background-color: #f8fafc;
            color: #0f172a;
            overflow-x: hidden;
            max-width: 100vw;
            width: 100%;
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Prevent iOS Safari aggressive auto-zoom on focus */
        @media (max-width: 768px) {
            input, select, textarea {
                font-size: 16px !important;
            }
        }
        
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: var(--font-display);
        }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(14, 124, 123, 0.1);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
        }
        .glass-card:hover {
            border-color: rgba(14, 124, 123, 0.4);
            background: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(14, 124, 123, 0.1);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #0E7C7B 50%, #1A9E96 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Custom Rich Text Parser for Quill/HTML Output */
        .rich-text h1 { font-size: 2.25rem; font-weight: 700; margin-bottom: 1rem; margin-top: 2rem; font-family: var(--font-display); color: #0f172a; }
        .rich-text h2 { font-size: 1.75rem; font-weight: 700; margin-bottom: 1rem; margin-top: 2rem; font-family: var(--font-display); color: #0f172a; }
        .rich-text h3 { font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; margin-top: 1.5rem; font-family: var(--font-display); color: #0E7C7B; }
        .rich-text p { margin-bottom: 1.25rem; line-height: 1.8; color: #334155; font-weight: 300; }
        .rich-text ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.25rem; color: #334155; }
        .rich-text ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.25rem; color: #334155; }
        .rich-text li { margin-bottom: 0.5rem; padding-left: 0.25rem; }
        .rich-text li::marker { color: #0E7C7B; }
        .rich-text a { color: #0E7C7B; text-decoration: none; font-weight: 500; transition: color 0.2s; }
        .rich-text a:hover { color: #1A9E96; text-decoration: underline; }
        .rich-text strong, .rich-text b { color: #0f172a; font-weight: 600; }
        .rich-text blockquote { border-left: 4px solid #0E7C7B; padding-left: 1rem; font-style: italic; color: #475569; margin-bottom: 1.25rem; background: rgba(14, 124, 123, 0.05); padding: 1rem; border-radius: 0 4px 4px 0; }
        .rich-text pre { background: #0f172a; color: #f8fafc; padding: 1rem; border-radius: 0.5rem; overflow-x: auto; margin-bottom: 1.25rem; border: 1px solid rgba(14, 124, 123, 0.2); }
        .rich-text code { font-family: monospace; background: rgba(14, 124, 123, 0.1); color: #0E7C7B; padding: 0.1rem 0.3rem; border-radius: 0.25rem; font-size: 0.875em; }
        
        .btn-glow {
            box-shadow: 0 4px 20px rgba(14, 124, 123, 0.25);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .btn-glow:hover {
            box-shadow: 0 8px 30px rgba(26, 158, 150, 0.4);
            transform: translateY(-2px);
        }
 
        /* ── Global Rotating Logo Preloader ── */
        #page-preloader {
            position: fixed;
            inset: 0;
            z-index: 999999;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.4s ease;
            pointer-events: auto;
        }
        #page-preloader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        @keyframes spaceiq-logo-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spaceiq-rotating-logo {
            animation: spaceiq-logo-spin 1.4s linear infinite;
            will-change: transform;
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
            background: #ffffff;
            border: 1px solid #cbd5e1;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; z-index: 1000;
            opacity: 0; pointer-events: none;
            transition: opacity 0.3s, transform 0.3s, border-color 0.3s, box-shadow 0.3s;
            backdrop-filter: blur(8px);
        }
        #back-to-top.show {
            opacity: 1; pointer-events: auto;
        }
        #back-to-top:hover {
            border-color: #0E7C7B;
            box-shadow: 0 6px 20px rgba(14,124,123,0.2);
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
 
        /* ── Architectural Custom Magnetic Cursor Pill ── */
        @media (pointer: fine) {
            #cursor-ring {
                position: fixed;
                top: 0;
                left: 0;
                width: 32px;
                height: 32px;
                border: 1.5px solid rgba(14, 124, 123, 0.6);
                border-radius: 9999px;
                pointer-events: none;
                z-index: 999990;
                transform: translate(-50%, -50%);
                transition: width 0.35s cubic-bezier(0.16, 1, 0.3, 1), height 0.35s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.3s ease, border-color 0.3s ease, padding 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                opacity: 0;
            }
            #cursor-ring.active-hover {
                width: auto;
                min-width: 88px;
                height: 38px;
                padding: 0 16px;
                background-color: rgba(14, 124, 123, 0.92);
                border-color: rgba(255, 255, 255, 0.4);
                box-shadow: 0 8px 30px rgba(14, 124, 123, 0.35);
            }
            #cursor-ring.active-link {
                width: 44px;
                height: 44px;
                background-color: rgba(14, 124, 123, 0.15);
                border-color: rgba(14, 124, 123, 0.85);
            }
            #cursor-ring .cursor-label {
                font-size: 9px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.18em;
                color: #ffffff;
                opacity: 0;
                transform: scale(0.7);
                transition: opacity 0.25s ease, transform 0.25s ease;
                pointer-events: none;
                text-align: center;
                white-space: nowrap;
            }
            #cursor-ring.active-hover .cursor-label {
                opacity: 1;
                transform: scale(1);
            }
            #cursor-dot {
                position: fixed;
                top: 0;
                left: 0;
                width: 5px;
                height: 5px;
                background-color: #0E7C7B;
                border-radius: 50%;
                pointer-events: none;
                z-index: 999991;
                transform: translate(-50%, -50%);
                transition: opacity 0.2s ease, transform 0.2s ease;
                opacity: 0;
            }
            #cursor-ring.active-hover ~ #cursor-dot {
                opacity: 0;
            }
        }

        /* ── 1. Masked Line-by-Line Text Reveals ── */
        .mask-wrap {
            overflow: hidden;
            display: block;
        }
        .mask-line {
            display: block;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.8s ease;
        }

        /* ── 2. Smooth Image Zoom & De-Scale on Scroll ── */
        .scroll-scale-wrap {
            overflow: hidden;
            position: relative;
        }
        .scroll-scale-img {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform;
        }

        /* ── 3. Smooth Card & Section Reveals ── */
        .curtain-reveal {
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* ── 5. Staggered Grid Motion Delays ── */
        .stagger-1 { transition-delay: 0.04s; }
        .stagger-2 { transition-delay: 0.08s; }
        .stagger-3 { transition-delay: 0.12s; }
        .stagger-4 { transition-delay: 0.16s; }
        .stagger-5 { transition-delay: 0.20s; }
        .stagger-6 { transition-delay: 0.24s; }

        /* ── 6. Slow Atmospheric Ambient Drift ── */
        @keyframes ambient-drift-slow-1 {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(45px, -35px) scale(1.12); }
            66% { transform: translate(-35px, 45px) scale(0.94); }
        }
        @keyframes ambient-drift-slow-2 {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(-45px, 35px) scale(0.92); }
            66% { transform: translate(40px, -40px) scale(1.10); }
        }
        .ambient-drift-1 {
            animation: ambient-drift-slow-1 22s ease-in-out infinite alternate;
            will-change: transform;
        }
        .ambient-drift-2 {
            animation: ambient-drift-slow-2 28s ease-in-out infinite alternate;
            will-change: transform;
        }

        /* ── Luxury Button Glint Shimmer ── */
        .btn-glint, .btn-gold, .btn-glow {
            position: relative;
            overflow: hidden;
        }
        .btn-glint::after, .btn-gold::after, .btn-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -70%;
            width: 25%;
            height: 200%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.45), transparent);
            transform: rotate(25deg);
            pointer-events: none;
            transition: none;
        }
        .btn-glint:hover::after, .btn-gold:hover::after, .btn-glow:hover::after {
            left: 150%;
            transition: left 0.85s cubic-bezier(0.19, 1, 0.22, 1);
        }

        /* ── Organic Floating Spec Badges ── */
        @keyframes badge-drift-1 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-4px) rotate(0.5deg); }
        }
        @keyframes badge-drift-2 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-5px) rotate(-0.5deg); }
        }
        .animate-drift-1 {
            animation: badge-drift-1 4.2s ease-in-out infinite;
        }
        .animate-drift-2 {
            animation: badge-drift-2 5.1s ease-in-out infinite 1s;
        }

        /* ── 3D Perspective Card Tilt ── */
        .tilt-card-container {
            perspective: 1200px;
        }
        .tilt-card {
            transform-style: preserve-3d;
            transition: transform 0.15s ease-out, box-shadow 0.3s ease;
            will-change: transform;
        }
        .tilt-card-content {
            transform: translateZ(24px);
        }

        /* ── Blueprint Grid Spotlight ── */
        .blueprint-spotlight-bg {
            background-image: 
                radial-gradient(650px circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(14, 124, 123, 0.08) 0%, transparent 80%),
                linear-gradient(to right, rgba(15, 23, 42, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.04) 1px, transparent 1px);
            background-size: 100% 100%, 40px 40px, 40px 40px;
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
<body class="antialiased overflow-x-hidden relative bg-[#f8fafc] text-slate-800" x-data="{ pageLoaded: false }" x-init="window.addEventListener('load', () => pageLoaded = true)">
    <!-- Architectural Magnetic Ring Cursor -->
    <div id="cursor-ring"><span class="cursor-label" id="cursor-label">VIEW</span></div>
    <div id="cursor-dot"></div>

    @if(!request()->routeIs('home'))
    <!-- Global Rotating Logo Preloader for All Pages -->
    <div id="page-preloader">
        <div class="flex flex-col items-center justify-center">
            <div class="w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center relative">
                <img src="{{ asset('img/logo_emblem.png') }}" 
                     alt="Space IQ Loading..." 
                     class="w-full h-full object-contain spaceiq-rotating-logo drop-shadow-[0_4px_20px_rgba(14,124,123,0.3)]">
            </div>
            <p class="mt-4 text-[10px] uppercase tracking-[0.35em] text-accent-500 font-semibold animate-pulse">Loading</p>
        </div>
    </div>
    @endif

    @if(request()->routeIs('home'))
    <!-- Opening Curtain & Centered Exact Brand Lockup -->
    <div id="intro-curtain" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 99998; background: #000000; pointer-events: none; will-change: transform; transform: translate3d(0, 0, 0); -webkit-transform: translate3d(0, 0, 0); backface-visibility: hidden; -webkit-backface-visibility: hidden;"></div>
    
    <div id="intro-brand" style="position: fixed; top: 0; left: 0; transform-origin: 0 0; z-index: 99999; pointer-events: none; will-change: transform, opacity; transform: translate3d(-9999px, -9999px, 0); -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; backface-visibility: hidden; -webkit-backface-visibility: hidden;">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" alt="Space IQ Design Studio" class="h-12 w-auto drop-shadow-lg" style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
            <div class="flex flex-col leading-tight">
                <span class="font-display font-bold tracking-wider text-white text-lg">Space IQ</span>
                <span class="font-display font-light tracking-widest text-white/70 uppercase text-[10px]">Design Studio</span>
            </div>
        </div>
    </div>

    <script>
    (function() {
        function runIntro() {
            const navContainer = document.getElementById('nav-brand-container');
            const curtain      = document.getElementById('intro-curtain');
            const brand        = document.getElementById('intro-brand');

            if (!navContainer || !curtain || !brand) return;

            const introImg = brand.querySelector('img');
            function startSequence() {
                const baseWidth  = brand.offsetWidth || 180;
                const baseHeight = brand.offsetHeight || 48;

                // Center screen scale (3.2x on desktop, 2.2x on mobile)
                const initialScale = window.innerWidth < 640 ? 2.2 : (window.innerWidth < 1024 ? 2.8 : 3.2);

                const startX = (window.innerWidth - (baseWidth * initialScale)) / 2;
                const startY = (window.innerHeight - (baseHeight * initialScale)) / 2;

                // Position center
                brand.style.transform = `translate3d(${startX}px, ${startY}px, 0px) scale(${initialScale})`;

                // Hold on pure black screen, then simultaneously glide logo and lift curtain
                setTimeout(() => {
                    requestAnimationFrame(() => {
                        const targetRect = navContainer.getBoundingClientRect();
                        const targetX = targetRect.left;
                        const targetY = targetRect.top;

                        const duration = 1400; // 1.4s synchronized flight & curtain lift
                        const ease     = 'cubic-bezier(0.76, 0, 0.24, 1)';

                        // 1. Logo glides from center to top-left navbar position
                        brand.style.transition = `transform ${duration}ms ${ease}, opacity 300ms ease ${duration - 150}ms`;
                        brand.style.transform  = `translate3d(${targetX}px, ${targetY}px, 0px) scale(1)`;

                        // 2. Black curtain lifts upwards at the EXACT same time
                        curtain.style.transition = `transform ${duration}ms ${ease}`;
                        curtain.style.transform  = 'translate3d(0, -100%, 0)';

                        // Seamless handoff to navbar container
                        setTimeout(() => {
                            navContainer.style.transition = 'opacity 300ms ease';
                            navContainer.style.opacity = '1';
                            brand.style.opacity = '0';
                        }, duration - 150);

                        // Clean up curtain and brand from DOM after completion
                        setTimeout(() => {
                            if (curtain && curtain.parentNode) curtain.remove();
                            if (brand && brand.parentNode) brand.remove();
                        }, duration + 150);
                    });
                }, 750);
            }

            if (introImg && !introImg.complete) {
                introImg.onload = startSequence;
            } else {
                startSequence();
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', runIntro);
        } else {
            runIntro();
        }
    })();
    </script>
    @endif

    <!-- Page Loading Bar -->
    <div id="page-loader"></div>
    
    <!-- Navbar -->
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)" 
            class="fixed w-full left-0 z-50 transition-all duration-300 pointer-events-none"
            :class="scrolled ? 'top-4 px-4' : 'top-0 px-0'">
        <div class="w-full transition-all duration-300 pointer-events-auto"
             :class="scrolled ? 'max-w-6xl mx-auto px-5 lg:px-6 py-2 bg-white/95 backdrop-blur-md border border-slate-200/90 rounded-full shadow-xl text-slate-900' : 'px-6 md:px-12 py-5 {{ request()->routeIs('home') ? 'bg-transparent border-transparent text-white' : 'border-b border-slate-200/60 bg-white/80 backdrop-blur-sm text-slate-900' }}'">
            <div class="flex items-center justify-between w-full"
                 :class="scrolled ? 'gap-4 xl:gap-8' : 'gap-8'">
                <!-- Logo (Extreme Left) -->
                <a href="{{ route('home') }}" id="nav-brand-container" class="flex-shrink-0 flex items-center gap-3 group" style="{{ request()->routeIs('home') ? 'opacity: 0;' : '' }}">
                    <img id="nav-brand-img" src="{{ asset('img/logo.png') }}" alt="Space IQ Design Studio" 
                         class="w-auto drop-shadow-md transition-all duration-300 group-hover:scale-105"
                         :class="scrolled ? 'h-8 xl:h-9' : 'h-12'">
                    <div class="flex flex-col leading-tight">
                        <span id="nav-brand-text" class="font-display font-bold tracking-wider transition-all duration-300"
                              :class="scrolled ? 'text-xs xl:text-sm text-slate-900' : 'text-lg {{ request()->routeIs('home') ? 'text-white' : 'text-slate-900' }}'">Space IQ</span>
                        <span id="nav-brand-sub" class="font-display font-light tracking-widest uppercase transition-all duration-300"
                              :class="scrolled ? 'text-[7px] xl:text-[8px] text-slate-500' : 'text-[10px] {{ request()->routeIs('home') ? 'text-white/70' : 'text-slate-500' }}'">Design Studio</span>
                    </div>
                </a>

                <!-- Services Links (Middle) -->
                <div class="hidden lg:flex flex-grow items-center justify-center flex-nowrap whitespace-nowrap tracking-widest uppercase font-medium"
                     :class="scrolled ? 'gap-x-3.5 xl:gap-x-5 text-[10px] xl:text-[11px] text-slate-800' : 'gap-x-4 xl:gap-x-5 text-[10.5px] xl:text-[11px] {{ request()->routeIs('home') ? 'text-white' : 'text-slate-800' }}'"
                     x-data="{ activeMenu: null }">
                    
                    <!-- Exterior Renders Dropdown -->
                    <div class="relative" @mouseenter="activeMenu = 'exterior'" @mouseleave="activeMenu = null">
                        <a href="{{ route('service.show', 'exterior-renders') }}" class="nav-link-underline hover:text-accent-500 transition-colors whitespace-nowrap flex items-center gap-1 cursor-pointer focus:outline-none uppercase font-semibold">
                            Exterior Renders
                            <svg class="w-3 h-3 transition-transform duration-200" :class="activeMenu === 'exterior' ? 'rotate-180 text-accent-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div x-show="activeMenu === 'exterior'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-1/2 -translate-x-1/2 mt-3 w-48 bg-white/98 backdrop-blur-md border border-slate-200 shadow-2xl rounded-xl py-2 z-50 text-left"
                             style="display: none;">

                            <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'residential']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">Residential</a>
                            <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'commercial']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">Commercial</a>
                            <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'aerial']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">Aerial</a>
                            <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'landscape']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">Landscape</a>
                        </div>
                    </div>

                    <span :class="scrolled ? 'text-slate-300' : '{{ request()->routeIs('home') ? 'text-white/20' : 'text-slate-300' }}'">|</span>

                    <!-- Interior Renders Dropdown -->
                    <div class="relative" @mouseenter="activeMenu = 'interior'" @mouseleave="activeMenu = null">
                        <a href="{{ route('service.show', 'interior-renders') }}" class="nav-link-underline hover:text-accent-500 transition-colors whitespace-nowrap flex items-center gap-1 cursor-pointer focus:outline-none uppercase font-semibold">
                            Interior Renders
                            <svg class="w-3 h-3 transition-transform duration-200" :class="activeMenu === 'interior' ? 'rotate-180 text-accent-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div x-show="activeMenu === 'interior'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-1/2 -translate-x-1/2 mt-3 w-48 bg-white/98 backdrop-blur-md border border-slate-200 shadow-2xl rounded-xl py-2 z-50 text-left"
                             style="display: none;">

                            <a href="{{ route('service.show', ['slug' => 'interior-renders', 'subcategory' => 'residential']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">Residential</a>
                            <a href="{{ route('service.show', ['slug' => 'interior-renders', 'subcategory' => 'commercial']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">Commercial</a>
                        </div>
                    </div>

                    <span :class="scrolled ? 'text-slate-300' : '{{ request()->routeIs('home') ? 'text-white/20' : 'text-slate-300' }}'">|</span>

                    <!-- 3D Animation Link -->
                    <a href="{{ route('service.show', 'walkthrough-animation') }}" class="nav-link-underline hover:text-accent-500 transition-colors whitespace-nowrap">3D Animation</a>

                    <span :class="scrolled ? 'text-slate-300' : '{{ request()->routeIs('home') ? 'text-white/20' : 'text-slate-300' }}'">|</span>

                    <!-- 360 Views Link -->
                    <a href="{{ route('service.show', '360-views') }}" class="nav-link-underline hover:text-accent-500 transition-colors whitespace-nowrap">360 Views</a>

                    <span :class="scrolled ? 'text-slate-300' : '{{ request()->routeIs('home') ? 'text-white/20' : 'text-slate-300' }}'">|</span>

                    <!-- Floor Plans Dropdown -->
                    <div class="relative" @mouseenter="activeMenu = 'floorplans'" @mouseleave="activeMenu = null">
                        <a href="{{ route('service.show', 'floor-plans') }}" class="nav-link-underline hover:text-accent-500 transition-colors whitespace-nowrap flex items-center gap-1 cursor-pointer focus:outline-none uppercase font-semibold">
                            Floor Plans
                            <svg class="w-3 h-3 transition-transform duration-200" :class="activeMenu === 'floorplans' ? 'rotate-180 text-accent-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div x-show="activeMenu === 'floorplans'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-1/2 -translate-x-1/2 mt-3 w-48 bg-white/98 backdrop-blur-md border border-slate-200 shadow-2xl rounded-xl py-2 z-50 text-left"
                             style="display: none;">

                            <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'b-w']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">B&W</a>
                            <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'color']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">Color</a>
                            <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'site-plan']) }}" class="block px-4 py-2.5 text-[10px] text-slate-700 hover:text-accent-500 hover:bg-slate-50 transition-colors tracking-widest font-semibold uppercase">Site Plans</a>
                        </div>
                    </div>


                </div>

                <!-- Contact Us (Extreme Right) -->
                <nav class="hidden lg:flex flex-shrink-0 items-center">
                    <a href="{{ route('contact') }}" 
                       class="text-[11px] uppercase tracking-widest font-bold bg-accent-500 hover:bg-accent-600 text-white transition-all duration-300 shadow-md hover:shadow-lg whitespace-nowrap"
                       :class="scrolled ? 'rounded-full px-5 py-2.5' : 'rounded-full px-6 py-3'">CONTACT US</a>
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        type="button"
                        aria-label="Toggle mobile menu"
                        class="lg:hidden flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center transition-colors focus:outline-none"
                        :class="scrolled ? 'text-slate-900 bg-slate-100/80 hover:bg-slate-200' : '{{ request()->routeIs('home') ? 'text-white bg-white/10 hover:bg-white/20' : 'text-slate-900 bg-slate-100/80 hover:bg-slate-200' }}'">
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Backdrop Overlay -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false"
             class="lg:hidden fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 pointer-events-auto"
             style="display: none;"></div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-250 transform"
             x-transition:enter-start="opacity-0 -translate-y-4 scale-[0.98]"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-4 scale-[0.98]"
             @click.outside="mobileMenuOpen = false"
             class="lg:hidden absolute top-full left-0 right-0 mx-3 sm:mx-4 mt-2 bg-white/98 backdrop-blur-xl border border-slate-200/90 rounded-3xl p-5 sm:p-6 flex flex-col gap-3.5 shadow-2xl text-left overflow-y-auto max-h-[82vh] pointer-events-auto z-50"
             style="display: none;"
             x-data="{ activeMobileSub: null }">
            
            <!-- Exterior Rendering Accordion -->
            <div class="border-b border-slate-100 pb-2.5">
                <button @click="activeMobileSub = (activeMobileSub === 'exterior' ? null : 'exterior')" class="w-full flex items-center justify-between py-1.5 text-xs font-bold uppercase tracking-widest text-slate-800 hover:text-accent-500 focus:outline-none">
                    <span>Exterior Renders</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSub === 'exterior' ? 'rotate-180 text-accent-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="activeMobileSub === 'exterior'" x-transition class="pl-3.5 mt-2 flex flex-col gap-1.5 border-l-2 border-accent-500/30" style="display: none;">
                    <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'residential']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">Residential</a>
                    <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'commercial']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">Commercial</a>
                    <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'aerial']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">Aerial</a>
                    <a href="{{ route('service.show', ['slug' => 'exterior-renders', 'subcategory' => 'landscape']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">Landscape</a>
                </div>
            </div>

            <!-- Interior Rendering Accordion -->
            <div class="border-b border-slate-100 pb-2.5">
                <button @click="activeMobileSub = (activeMobileSub === 'interior' ? null : 'interior')" class="w-full flex items-center justify-between py-1.5 text-xs font-bold uppercase tracking-widest text-slate-800 hover:text-accent-500 focus:outline-none">
                    <span>Interior Renders</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSub === 'interior' ? 'rotate-180 text-accent-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="activeMobileSub === 'interior'" x-transition class="pl-3.5 mt-2 flex flex-col gap-1.5 border-l-2 border-accent-500/30" style="display: none;">
                    <a href="{{ route('service.show', ['slug' => 'interior-renders', 'subcategory' => 'residential']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">Residential</a>
                    <a href="{{ route('service.show', ['slug' => 'interior-renders', 'subcategory' => 'commercial']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">Commercial</a>
                </div>
            </div>

            <!-- 3D Animation Link -->
            <div class="border-b border-slate-100 pb-2.5">
                <a href="{{ route('service.show', 'walkthrough-animation') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-xs font-bold uppercase tracking-widest text-slate-800 hover:text-accent-500">3D Animation</a>
            </div>
            
            <!-- 360 Views Link -->
            <div class="border-b border-slate-100 pb-2.5">
                <a href="{{ route('service.show', '360-views') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-xs font-bold uppercase tracking-widest text-slate-800 hover:text-accent-500">360 Views</a>
            </div>
            
            <!-- Floor Plans Accordion -->
            <div class="border-b border-slate-100 pb-2.5">
                <button @click="activeMobileSub = (activeMobileSub === 'floorplans' ? null : 'floorplans')" class="w-full flex items-center justify-between py-1.5 text-xs font-bold uppercase tracking-widest text-slate-800 hover:text-accent-500 focus:outline-none">
                    <span>Floor Plans</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="activeMobileSub === 'floorplans' ? 'rotate-180 text-accent-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="activeMobileSub === 'floorplans'" x-transition class="pl-3.5 mt-2 flex flex-col gap-1.5 border-l-2 border-accent-500/30" style="display: none;">
                    <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'b-w']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">B&amp;W Plans</a>
                    <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'color']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">Color Plans</a>
                    <a href="{{ route('service.show', ['slug' => 'floor-plans', 'subcategory' => 'site-plan']) }}" @click="mobileMenuOpen = false" class="text-xs uppercase tracking-wider text-slate-600 hover:text-accent-600 py-1.5 font-medium">Site Plans</a>
                </div>
            </div>
            
            <div class="pt-2">
                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false"
                   class="block w-full text-center text-xs font-bold uppercase tracking-widest bg-accent-500 hover:bg-accent-600 text-white py-3.5 px-6 rounded-full transition-all duration-300 shadow-md">CONTACT US</a>
            </div>
        </div>
    </header>

    <main class="min-h-screen page-entrance" :class="pageLoaded ? 'loaded' : ''">
        @yield('content')
    </main>

    @php
        $settings = \App\Models\Setting::pluck('value', 'key');
    @endphp

    <!-- Footer -->
    <footer class="relative border-t border-slate-300/80 bg-[#edf2f7] pt-20 pb-10 text-slate-700 shadow-[0_-12px_32px_-12px_rgba(0,0,0,0.06)]">
        <!-- Top Accent Line -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/3 h-[2px] bg-gradient-to-r from-transparent via-teal-600/40 to-transparent"></div>
        
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                <!-- Column 1: About -->
                <div class="col-span-1 md:col-span-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-6 group">
                        <img src="{{ asset('img/logo.png') }}" alt="Space IQ Design Studio" 
                             class="h-12 w-auto opacity-95 group-hover:opacity-100 transition-opacity">
                        <div class="flex flex-col leading-tight">
                            <span class="font-display font-bold text-lg tracking-wider text-slate-900">Space IQ</span>
                            <span class="font-display font-medium text-[10px] tracking-widest text-slate-500 uppercase">Design Studio</span>
                        </div>
                    </a>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal max-w-sm">
                        {{ \App\Models\Setting::where('key', 'seo_description')->value('value') ?? 'High-Fidelity Renders. Professional Delivery. Zero Compromise.' }}
                    </p>
                </div>
                
                <!-- Column 2: Services -->
                <div class="col-span-1 md:col-span-3">
                    <h3 class="font-bold uppercase tracking-widest text-xs mb-4 text-teal-800">Services</h3>
                    <ul class="space-y-2.5">
                        @foreach(\App\Models\Service::where('is_active', true)->orderBy('sort_order')->get() as $service)
                        <li>
                            <a href="{{ route('service.show', $service->slug) }}" class="inline-block text-slate-600 hover:text-teal-800 text-sm transition-all duration-200 font-medium hover:translate-x-1 transform">
                                {{ $service->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Column 3: Company -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="font-bold uppercase tracking-widest text-xs mb-4 text-teal-800">Company</h3>
                    <ul class="space-y-2.5">
                        <li>
                            <a href="{{ route('home') }}#process" class="inline-block text-slate-600 hover:text-teal-800 text-sm transition-all duration-200 font-medium hover:translate-x-1 transform">
                                Our Process
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="inline-block text-slate-600 hover:text-teal-800 text-sm transition-all duration-200 font-medium hover:translate-x-1 transform">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('page.show', 'privacy-policy') }}" class="inline-block text-slate-600 hover:text-teal-800 text-sm transition-all duration-200 font-medium hover:translate-x-1 transform">
                                Privacy Policy
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Column 4: Connect -->
                <div class="col-span-1 md:col-span-3">
                    <h3 class="font-bold uppercase tracking-widest text-xs mb-4 text-teal-800">Connect</h3>
                    <ul class="space-y-3 font-normal text-sm text-slate-600">
                        <!-- Instagram -->
                        <li>
                            <a href="https://instagram.com/space_iq_" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 hover:text-teal-800 transition-all duration-200 group max-w-full hover:translate-x-1 transform">
                                <span class="w-8 h-8 rounded-lg bg-white border border-slate-200 shadow-xs flex items-center justify-center text-teal-700 group-hover:bg-teal-700 group-hover:text-white transition-all flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                </span>
                                <span class="font-medium">@space_iq_</span>
                            </a>
                        </li>
                        
                        <!-- Email -->
                        <li>
                            <a href="mailto:spaceiqstudio@gmail.com" class="flex items-center gap-3 hover:text-teal-800 transition-all duration-200 group max-w-full hover:translate-x-1 transform">
                                <span class="w-8 h-8 rounded-lg bg-white border border-slate-200 shadow-xs flex items-center justify-center text-teal-700 group-hover:bg-teal-700 group-hover:text-white transition-all flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </span>
                                <span class="font-medium break-all sm:break-normal">spaceiqstudio@gmail.com</span>
                            </a>
                        </li>

                        <!-- Phone -->
                        <li>
                            <a href="tel:+918121376325" class="flex items-center gap-3 hover:text-teal-800 transition-all duration-200 group max-w-full hover:translate-x-1 transform">
                                <span class="w-8 h-8 rounded-lg bg-white border border-slate-200 shadow-xs flex items-center justify-center text-teal-700 group-hover:bg-teal-700 group-hover:text-white transition-all flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </span>
                                <span class="font-medium">+91 81213 76325</span>
                            </a>
                        </li>

                        <!-- Address -->
                        <li class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-white border border-slate-200 shadow-xs flex items-center justify-center text-teal-700 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </span>
                            <span class="leading-relaxed font-medium">Mohali, Punjab (India)</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer CTA Strip -->
            <div class="reveal mb-16 rounded-3xl overflow-hidden relative border border-slate-200/90 shadow-md bg-white p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                <div>
                    <p class="text-xs uppercase tracking-widest text-teal-800 font-bold mb-2">Ready to get started?</p>
                    <h3 class="text-2xl md:text-3xl font-display font-bold text-slate-900">Turn your vision into reality.<br class="hidden md:block"> <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-700 to-teal-900">Let's talk today.</span></h3>
                </div>
                <a href="{{ route('contact') }}" class="flex-shrink-0 px-10 py-4 bg-teal-700 hover:bg-teal-800 text-white text-xs uppercase tracking-widest font-semibold rounded-full shadow-lg shadow-teal-700/20 transition-all duration-300 hover:scale-105">
                    Book a Free Consultation
                </a>
            </div>

            <div class="border-t border-slate-300/80 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-xs font-medium uppercase tracking-widest">
                    &copy; {{ date('Y') }} Space IQ Design Studio. All rights reserved.
                </p>
                <div class="text-slate-500 text-xs font-medium uppercase tracking-widest">
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
        // ── Global Rotating Logo Preloader ──
        (function() {
            const preloader = document.getElementById('page-preloader');
            if (!preloader) return;

            function dismiss() {
                setTimeout(() => {
                    preloader.classList.add('loaded');
                }, 200);
            }

            if (document.readyState === 'complete') {
                dismiss();
            } else {
                window.addEventListener('load', dismiss);
            }

            // Show rotating logo preloader when clicking internal page links
            document.addEventListener('click', (e) => {
                const link = e.target.closest('a');
                if (!link) return;
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:') || link.target === '_blank') return;
                if (href.startsWith(window.location.origin) || href.startsWith('/')) {
                    preloader.classList.remove('loaded');
                }
            });
        })();

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

        // ── Scroll Reveal & Curtain Observers ──
        (function() {
            if (!('IntersectionObserver' in window)) {
                document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .curtain-reveal, .mask-wrap').forEach(el => el.classList.add('visible'));
                return;
            }
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                        observer.unobserve(e.target);
                    }
                });
            }, { threshold: 0.08, rootMargin: '0px 0px 60px 0px' });
            
            function observeElements() {
                document.querySelectorAll('.reveal:not(.visible), .reveal-left:not(.visible), .reveal-right:not(.visible), .curtain-reveal:not(.visible), .mask-wrap:not(.visible)').forEach(el => {
                    observer.observe(el);
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', observeElements);
            } else {
                observeElements();
            }
            window.addEventListener('load', observeElements);
            window.addEventListener('scroll', observeElements, { passive: true });
        })();

        // ── 2. Smooth Image Zoom & De-Scale on Scroll Engine ──
        (function() {
            const scaleImgs = () => {
                const items = document.querySelectorAll('.scroll-scale-img');
                const winH = window.innerHeight;
                items.forEach(img => {
                    const rect = img.getBoundingClientRect();
                    if (rect.bottom >= 0 && rect.top <= winH) {
                        // Calculate normalized position relative to center of screen (0 to 1)
                        const centerDiff = Math.abs((rect.top + rect.height / 2) - (winH / 2));
                        const factor = Math.min(centerDiff / (winH / 1.2), 1);
                        // Scale from 1.0 (dead center) up to 1.10 (edges)
                        const scale = 1.0 + (factor * 0.10);
                        img.style.transform = `scale3d(${scale.toFixed(3)}, ${scale.toFixed(3)}, 1)`;
                    }
                });
            };
            window.addEventListener('scroll', scaleImgs, { passive: true });
            window.addEventListener('load', scaleImgs);
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

        // ── Custom Magnetic Pill Cursor ──
        (function() {
            if (window.matchMedia('(pointer: coarse)').matches) return;
            
            const ring = document.getElementById('cursor-ring');
            const dot = document.getElementById('cursor-dot');
            const label = document.getElementById('cursor-label');
            if (!ring || !dot) return;

            let mouseX = -100, mouseY = -100;
            let ringX = -100, ringY = -100;
            let dotX = -100, dotY = -100;
            let isVisible = false;

            window.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                if (!isVisible) {
                    isVisible = true;
                    ring.style.opacity = '1';
                    dot.style.opacity = '1';
                }
            });

            document.addEventListener('mouseleave', () => {
                ring.style.opacity = '0';
                dot.style.opacity = '0';
                isVisible = false;
            });

            function render() {
                // Smooth Lerp Physics
                ringX += (mouseX - ringX) * 0.16;
                ringY += (mouseY - ringY) * 0.16;
                dotX += (mouseX - dotX) * 0.65;
                dotY += (mouseY - dotY) * 0.65;

                ring.style.left = `${ringX}px`;
                ring.style.top = `${ringY}px`;
                dot.style.left = `${dotX}px`;
                dot.style.top = `${dotY}px`;

                requestAnimationFrame(render);
            }
            requestAnimationFrame(render);

            // Dynamic Cursor Pill Labeling
            document.addEventListener('mouseover', (e) => {
                const target = e.target.closest('[data-cursor-label], .group, .tilt-card, a, button, .btn-gold, .btn-glow');
                if (!target) {
                    ring.classList.remove('active-hover', 'active-link');
                    if (label) label.textContent = '';
                    return;
                }

                const customText = target.getAttribute('data-cursor-label');
                if (customText) {
                    if (label) label.textContent = customText;
                    ring.classList.add('active-hover');
                } else if (target.closest('#services') && target.closest('.group')) {
                    if (label) label.textContent = 'VIEW';
                    ring.classList.add('active-hover');
                } else if (target.tagName === 'A' || target.tagName === 'BUTTON') {
                    ring.classList.add('active-link');
                }
            });

            document.addEventListener('mouseout', (e) => {
                const target = e.target.closest('[data-cursor-label], .group, .tilt-card, a, button, .btn-gold, .btn-glow');
                if (target) {
                    ring.classList.remove('active-hover', 'active-link');
                }
            });
        })();

        // ── Magnetic Button Pull ──
        (function() {
            if (window.matchMedia('(pointer: coarse)').matches) return;
            
            const attachMagnetic = () => {
                document.querySelectorAll('.btn-gold, .btn-glow, .btn-magnetic').forEach(btn => {
                    btn.addEventListener('mousemove', function(e) {
                        const rect = this.getBoundingClientRect();
                        const x = e.clientX - rect.left - rect.width / 2;
                        const y = e.clientY - rect.top - rect.height / 2;
                        this.style.transform = `translate3d(${x * 0.22}px, ${y * 0.22}px, 0)`;
                    });
                    btn.addEventListener('mouseleave', function() {
                        this.style.transform = 'translate3d(0, 0, 0)';
                    });
                });
            };
            window.addEventListener('load', attachMagnetic);
        })();

        // ── Blueprint Spotlight Mouse Tracker ──
        (function() {
            document.addEventListener('mousemove', (e) => {
                const spotlights = document.querySelectorAll('.blueprint-spotlight-bg');
                spotlights.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    el.style.setProperty('--mouse-x', `${x}px`);
                    el.style.setProperty('--mouse-y', `${y}px`);
                });
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
                
                card.style.transform = `perspective(1000px) rotateX(${rx}deg) rotateY(${ry}deg) scale3d(1.012, 1.012, 1.012)`;
            }
            
            function handleMouseLeave() {
                this.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            }
            
            window.addEventListener('load', initTilt);
            setInterval(initTilt, 2500);
        })();
    </script>
    @stack('scripts')
</body>
</html>
