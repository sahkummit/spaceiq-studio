@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/pannellum.css') }}"/>
    <script src="{{ asset('js/pannellum.js') }}"></script>
    <style>
        /* ── Pannellum styles ── */
        .pnlm-container {
            background: #080e0e !important;
        }
        .pnlm-load-box {
            background-color: rgba(12, 24, 24, 0.85) !important;
            border: 1px solid rgba(26, 158, 150, 0.3) !important;
            border-radius: 6px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
        }
        .pnlm-lbox {
            border: 4px solid #1A9E96 !important;
            border-left-color: transparent !important;
        }
        .pnlm-ltext {
            color: #7EC8C0 !important;
            font-family: 'Montserrat', sans-serif !important;
            font-weight: 600 !important;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .pnlm-control-button {
            background-color: rgba(12, 24, 24, 0.8) !important;
            fill: #7EC8C0 !important;
        }
        .pnlm-control-button:hover {
            background-color: #1A9E96 !important;
            fill: #080e0e !important;
        }

        /* ── Shimmer Skeleton ── */
        @keyframes skeleton-shimmer {
            0%   { background-position: -800px 0; }
            100% { background-position:  800px 0; }
        }
        .skeleton-shimmer {
            background: linear-gradient(
                90deg,
                rgba(255,255,255,0.03) 25%,
                rgba(26,158,150,0.08) 50%,
                rgba(255,255,255,0.03) 75%
            );
            background-size: 800px 100%;
            animation: skeleton-shimmer 1.8s infinite linear;
        }

        /* ── Lazy-load fade in ── */
        .lazy-img {
            opacity: 0;
            transition: opacity 0.6s ease;
        }
        .lazy-img.loaded {
            opacity: 1;
        }

        /* ── Ken Burns Animation ── */
        @keyframes kenburns {
            0% { transform: scale(1.01); }
            100% { transform: scale(1.07); }
        }
        .animate-kenburns {
            animation: kenburns 15s ease-out infinite alternate;
        }

        /* ── Timeline Scroll Glow ── */
        .timeline-step-circle {
            transition: background-color 0.6s ease, border-color 0.6s ease, box-shadow 0.6s ease, color 0.6s ease;
        }
        .timeline-step-circle.active {
            background-color: #0E7C7B !important;
            border: 4px solid #080e0e !important;
            box-shadow: 0 0 20px rgba(26, 158, 150, 0.6);
            color: #ffffff !important;
        }

        /* ── Stats strip ── */
        .stats-strip-sep {
            width: 1px;
            background: rgba(255,255,255,0.12);
            height: 40px;
            align-self: center;
        }
    </style>
@endsection

@section('content')

<div x-data="{
    lightboxOpen: false,
    lightboxUrl: '',
    lightboxTitle: '',
    lightboxIndex: 0,
    lightboxImages: [],
    lightboxIsVideo: false,
    lightboxVideoUrl: '',
    is360: false,
    pannellumViewer: null,
    touchStartX: 0,
    touchEndX: 0,

    openLightbox(images, index = 0) {
        this.lightboxImages = Array.isArray(images) ? images : [];
        this.lightboxIndex = (typeof index === 'number') ? index : 0;
        const current = this.lightboxImages[this.lightboxIndex];
        this.lightboxUrl = current ? (current.img || current.url || '') : '';
        this.lightboxTitle = current ? (current.title || '') : '';
        this.lightboxIsVideo = current ? !!current.isVideo : false;
        this.lightboxVideoUrl = current ? (current.videoUrl || '') : '';
        this.is360 = current ? !!current.is360 : false;
        this.lightboxOpen = true;
        document.body.style.overflow = 'hidden';

        if (this.is360) {
            this.initPannellum(this.lightboxUrl);
        }
    },

    initPannellum(url) {
        this.$nextTick(() => {
            if (this.pannellumViewer) {
                try { this.pannellumViewer.destroy(); } catch(e) {}
                this.pannellumViewer = null;
            }
            const el = document.getElementById('home-panorama-viewer');
            if (el && typeof pannellum !== 'undefined') {
                this.pannellumViewer = pannellum.viewer('home-panorama-viewer', {
                    type: 'equirectangular',
                    panorama: url,
                    autoLoad: true,
                    compass: false,
                    autoRotate: -2,
                    autoRotateInactivityDelay: 3000,
                    mouseZoom: true,
                    doubleClickZoom: true,
                    showZoomCtrl: true,
                    showFullscreenCtrl: true
                });
            }
        });
    },

    closeLightbox() {
        this.lightboxOpen = false;
        this.lightboxIsVideo = false;
        this.lightboxVideoUrl = '';
        this.is360 = false;
        if (this.pannellumViewer) {
            try { this.pannellumViewer.destroy(); } catch(e) {}
            this.pannellumViewer = null;
        }
        document.body.style.overflow = '';
    },

    prevImage() {
        if (this.lightboxImages.length === 0) return;
        this.lightboxIndex = (this.lightboxIndex - 1 + this.lightboxImages.length) % this.lightboxImages.length;
        const current = this.lightboxImages[this.lightboxIndex];
        this.lightboxUrl = current ? (current.img || current.url || '') : '';
        this.lightboxTitle = current ? (current.title || '') : '';
        this.lightboxIsVideo = current ? !!current.isVideo : false;
        this.lightboxVideoUrl = current ? (current.videoUrl || '') : '';
        this.is360 = current ? !!current.is360 : false;

        if (this.is360) {
            this.initPannellum(this.lightboxUrl);
        } else if (this.pannellumViewer) {
            try { this.pannellumViewer.destroy(); } catch(e) {}
            this.pannellumViewer = null;
        }
    },

    nextImage() {
        if (this.lightboxImages.length === 0) return;
        this.lightboxIndex = (this.lightboxIndex + 1) % this.lightboxImages.length;
        const current = this.lightboxImages[this.lightboxIndex];
        this.lightboxUrl = current ? (current.img || current.url || '') : '';
        this.lightboxTitle = current ? (current.title || '') : '';
        this.lightboxIsVideo = current ? !!current.isVideo : false;
        this.lightboxVideoUrl = current ? (current.videoUrl || '') : '';
        this.is360 = current ? !!current.is360 : false;

        if (this.is360) {
            this.initPannellum(this.lightboxUrl);
        } else if (this.pannellumViewer) {
            try { this.pannellumViewer.destroy(); } catch(e) {}
            this.pannellumViewer = null;
        }
    }
}"
@open-lightbox-modal.window="openLightbox($event.detail.items || $event.detail.images, $event.detail.index)"
@open-lightbox.window="openLightbox($event.detail.items || $event.detail.images, $event.detail.index)">

<!-- Hero Section — actual landscape ratio filling full screen width on mobile, full screen video on desktop -->
<section class="relative w-full overflow-hidden bg-brand-950 flex flex-col justify-between md:block md:h-[100svh] md:min-h-[600px]">
    <!-- Background Video Wrapper -->
    <div class="relative w-full aspect-[16/9] min-w-full md:aspect-auto md:absolute md:inset-0 z-0 bg-brand-950 overflow-hidden" id="hero-video-container">
        <!-- Direct YouTube Autoplay Video with zero side gaps -->
        <iframe class="absolute inset-0 w-full h-full object-cover pointer-events-none opacity-90 select-none scale-[1.08] md:scale-[1.35] md:top-1/2 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/2 md:w-[100vw] md:h-[56.25vw] md:min-h-[100vh] md:min-w-[177.77vh]"
                src="https://www.youtube.com/embed/aTCQdR368LA?autoplay=1&mute=1&controls=0&loop=1&playlist=aTCQdR368LA&playsinline=1&showinfo=0&rel=0&modestbranding=1&start=26&iv_load_policy=3&disablekb=1&fs=0"
                frameborder="0"
                allow="autoplay; encrypted-media; fullscreen"
                allowfullscreen></iframe>
        <!-- Transparent click shield -->
        <div class="absolute inset-0 bg-transparent z-10 pointer-events-auto"></div>
    </div>

    <!-- Stats Banner — Cleanly under video on mobile, floating directly over video on desktop -->
    <div class="relative w-full py-6 sm:py-7 md:py-8 bg-brand-950 md:bg-transparent md:absolute md:bottom-0 md:left-0 z-20">
        <div class="container mx-auto px-4 sm:px-6 max-w-5xl">
            <div class="grid grid-cols-2 md:flex md:items-center md:justify-center gap-5 sm:gap-8 md:gap-16 text-center" id="stats-section">
                <div>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-white mb-0.5 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" data-count="12000" data-suffix="+">0</p>
                    <p class="text-[9px] sm:text-[10px] uppercase tracking-widest text-white font-semibold drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">Successful Projects</p>
                </div>
                <div class="stats-strip-sep hidden md:block"></div>
                <div>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-white mb-0.5 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" data-count="500" data-suffix="+">0</p>
                    <p class="text-[9px] sm:text-[10px] uppercase tracking-widest text-white font-semibold drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">Happy Clients</p>
                </div>
                <div class="stats-strip-sep hidden md:block"></div>
                <div>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-white mb-0.5 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" data-count="15" data-suffix="+">0</p>
                    <p class="text-[9px] sm:text-[10px] uppercase tracking-widest text-white font-semibold drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">Countries</p>
                </div>
                <div class="stats-strip-sep hidden md:block"></div>
                <div>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-white mb-0.5 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" data-count="10" data-suffix="+">0</p>
                    <p class="text-[9px] sm:text-[10px] uppercase tracking-widest text-white font-semibold drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">Years of Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Value Proposition Section — Clean Architectural Narrative (Slider on mobile, 3-col Grid on Desktop) -->
<section class="py-16 sm:py-20 border-y border-slate-200/80 bg-slate-50/80 relative overflow-hidden">
    <!-- Slow Atmospheric Ambient Drift -->
    <div class="ambient-drift-1 absolute -top-24 -left-24 w-80 h-80 bg-accent-500/5 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="ambient-drift-2 absolute -bottom-24 -right-24 w-80 h-80 bg-[#1A9E96]/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="container mx-auto px-6 xl:px-12 relative z-10" style="max-width:1536px">
        
        <!-- Desktop Grid View (Visible only on md and up) -->
        <div class="hidden md:grid md:grid-cols-3 gap-6 sm:gap-10 md:gap-12 text-center">
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-5 mx-auto">
                    <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="text-lg sm:text-xl font-display font-medium text-accent-500 mb-3 uppercase tracking-wider">Hyper-Realistic Precision</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-light">We don't just create images; we simulate reality. From the way light reflects off a window to the tactile texture of a brick facade, every detail is engineered for authenticity.</p>
            </div>
            
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-5 mx-auto">
                    <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-lg sm:text-xl font-display font-medium text-accent-500 mb-3 uppercase tracking-wider">Client-Centric Narrative</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-light">We populate your designs with life—modern landscaping, realistic lighting, and curated environments that help potential buyers see themselves in the space.</p>
            </div>
            
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-5 mx-auto">
                    <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                </div>
                <h3 class="text-lg sm:text-xl font-display font-medium text-accent-500 mb-3 uppercase tracking-wider">High Quality Delivery</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-light">Master high-resolution imagery and cinematics engineered to plug directly into your marketing decks, campaigns, and investor pitches.</p>
            </div>
        </div>

        <!-- Mobile One-Line Slider View (Visible only on mobile) -->
        <div class="md:hidden" 
             x-data="{ 
                 activeSlide: 0, 
                 totalSlides: 3,
                 touchStartX: 0,
                 touchEndX: 0,
                 handleTouchStart(e) { this.touchStartX = e.touches[0].clientX; },
                 handleTouchEnd(e) { 
                     this.touchEndX = e.changedTouches[0].clientX; 
                     const diff = this.touchStartX - this.touchEndX;
                     if (Math.abs(diff) > 40) {
                         if (diff > 0) { this.activeSlide = (this.activeSlide + 1) % this.totalSlides; }
                         else { this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides; }
                     }
                 }
             }">
             
            <div class="relative min-h-[260px] overflow-hidden" 
                 @touchstart="handleTouchStart($event)" 
                 @touchend="handleTouchEnd($event)"
                 style="touch-action: pan-y;">
                
                <!-- Slide 1: Hyper-Realistic Precision -->
                <div x-show="activeSlide === 0" 
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-8"
                     class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-md text-center flex flex-col justify-center h-full">
                    <div class="w-12 h-12 rounded-xl bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-base font-display font-bold text-accent-600 mb-2 uppercase tracking-wider">Hyper-Realistic Precision</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed font-normal">We don't just create images; we simulate reality. From light reflections to tactile brick textures, every detail is engineered for authenticity.</p>
                </div>

                <!-- Slide 2: Client-Centric Narrative -->
                <div x-show="activeSlide === 1" 
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-8"
                     class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-md text-center flex flex-col justify-center h-full"
                     style="display: none;">
                    <div class="w-12 h-12 rounded-xl bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-base font-display font-bold text-accent-600 mb-2 uppercase tracking-wider">Client-Centric Narrative</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed font-normal">We populate your designs with life—modern landscaping, realistic lighting, and curated environments that help buyers envision themselves in the space.</p>
                </div>

                <!-- Slide 3: High Quality Delivery -->
                <div x-show="activeSlide === 2" 
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-8"
                     class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-md text-center flex flex-col justify-center h-full"
                     style="display: none;">
                    <div class="w-12 h-12 rounded-xl bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                    </div>
                    <h3 class="text-base font-display font-bold text-accent-600 mb-2 uppercase tracking-wider">High Quality Delivery</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed font-normal">Master high-resolution 4K imagery and cinematics engineered to plug directly into your marketing decks, campaigns, and investor pitches.</p>
                </div>
            </div>

            <!-- Mobile Pagination Dots & Controls -->
            <div class="flex items-center justify-center gap-3 mt-6">
                <button type="button" @click="activeSlide = (activeSlide - 1 + totalSlides) % totalSlides" class="p-2 text-slate-400 hover:text-slate-700 transition-colors" aria-label="Previous slide">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div class="flex items-center gap-2">
                    <template x-for="i in totalSlides" :key="i">
                        <button type="button" 
                                @click="activeSlide = i - 1" 
                                class="h-2 rounded-full transition-all duration-300"
                                :class="activeSlide === (i - 1) ? 'w-6 bg-accent-500' : 'w-2 bg-slate-300'"
                                :aria-label="'Go to slide ' + i"></button>
                    </template>
                </div>
                <button type="button" @click="activeSlide = (activeSlide + 1) % totalSlides" class="p-2 text-slate-400 hover:text-slate-700 transition-colors" aria-label="Next slide">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

    </div>
</section>

<!-- Curated Architectural CGI Showcase — Aesthetic Asymmetric Zig-Zag Gallery -->
<section id="curated-showcase" class="py-20 sm:py-28 bg-[#f8fafc] border-b border-slate-200/80 relative overflow-hidden text-slate-900" 
         x-data="{ 
             items: [
                 { img: '{{ webp_asset('img/showcase/media_1787136440349.jpg') }}', title: 'The Palm Residence', category: 'Exterior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136449032.jpg') }}', title: 'Locally Sourced Artisan Market & Wine Bar', category: 'Interior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136449231.jpg') }}', title: 'Highland Forest Stone Villa', category: 'Exterior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136460065.jpg') }}', title: 'Olive Green Island & White Marble Kitchen', category: 'Interior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136841724.jpg') }}', title: 'Curved Bouclé Lounge', category: 'Interior Renders' },

                 { img: '{{ webp_asset('img/showcase/media_1787136460079.jpg') }}', title: 'Classical Arched Hearth Living Room', category: 'Interior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136440316.jpg') }}', title: 'Grand Promenade Retail Arcade', category: 'Exterior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136449246.jpg') }}', title: 'Brko Coffee & Lounge Showcase', category: 'Interior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136440362.jpg') }}', title: 'The Heritage Brick Estate', category: 'Exterior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136449247.jpg') }}', title: 'K-Line Fitness Center Cardio Zone', category: 'Interior Renders' },

                 { img: '{{ webp_asset('img/showcase/media_1787136440327.jpg') }}', title: 'Coffee Tim Botanical Pavilion', category: 'Exterior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136449219.jpg') }}', title: 'Upholstered Linen Feature Wall Master Bedroom', category: 'Interior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136440348.jpg') }}', title: 'K-Line Corporate Office Center', category: 'Exterior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136460085.jpg') }}', title: 'Contemporary Marble Dining Suite', category: 'Interior Renders' },
                 { img: '{{ webp_asset('img/showcase/media_1787136841731.jpg') }}', title: 'Marble & Bleached Oak Master Ensuite', category: 'Interior Renders' }
             ]
         }">
    
    <!-- Slow Atmospheric Ambient Drift Lights -->
    <div class="ambient-drift-1 absolute top-1/4 -left-48 w-96 h-96 bg-accent-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="ambient-drift-2 absolute top-2/3 -right-48 w-96 h-96 bg-[#1A9E96]/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="container mx-auto px-6 xl:px-12 relative z-10" style="max-width:1536px">
        
        <!-- Header: Hyper-Realistic Architectural in one line above Imagery & Visuals -->
        <div class="text-center max-w-4xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-display font-light text-slate-900 uppercase tracking-tight leading-tight">
                <span class="block sm:whitespace-nowrap">Hyper-Realistic Architectural</span>
                <span class="font-normal text-transparent bg-clip-text bg-gradient-to-r from-slate-950 via-accent-500 to-accent-400 block mt-1">Imagery &amp; Visuals</span>
            </h2>
            <p class="text-slate-500 text-sm md:text-base font-light mt-4 max-w-xl mx-auto leading-relaxed">
                A curated showcase of our latest exterior developments, luxury commercial spaces, and photorealistic interior environments.
            </p>
        </div>

        <!-- 3-Column Asymmetric Zig-Zag Masonry Grid (5 + 5 + 5 = 15 images) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-start">
            
            <!-- ── Column 1 (Left Stagger — 5 Items) ── -->
            <div class="space-y-6 lg:space-y-8 flex flex-col">
                
                <!-- 1. The Palm Residence -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 0 })">
                    <div class="relative overflow-hidden aspect-[16/11] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136440349.jpg') }}" 
                             alt="The Palm Residence"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Exterior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">The Palm Residence</h4>
                        </div>
                    </div>
                </div>

                <!-- 2. Artisan Marketplace & Bar -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 1 })">
                    <div class="relative overflow-hidden aspect-[4/3] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136449032.jpg') }}" 
                             alt="Artisan Marketplace & Central Bar"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Artisan Marketplace &amp; Central Bar</h4>
                        </div>
                    </div>
                </div>

                <!-- 3. Forest Turret Villa -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 2 })">
                    <div class="relative overflow-hidden aspect-[1/1] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136449231.jpg') }}" 
                             alt="Highland Forest Stone Villa"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Exterior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Highland Forest Stone Villa</h4>
                        </div>
                    </div>
                </div>

                <!-- 4. Olive & Marble Culinary Kitchen -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 3 })">
                    <div class="relative overflow-hidden aspect-[4/3] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136460065.jpg') }}" 
                             alt="Olive & Marble Culinary Kitchen"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Olive &amp; Marble Culinary Kitchen</h4>
                        </div>
                    </div>
                </div>

                <!-- 5. Curved Bouclé Lounge -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 4 })">
                    <div class="relative overflow-hidden aspect-[16/11] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136841724.jpg') }}" 
                             alt="Curved Bouclé Lounge"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Curved Bouclé Lounge</h4>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ── Column 2 (Center Stagger — Offset Downward — 5 Items) ── -->
            <div class="space-y-6 lg:space-y-8 flex flex-col lg:pt-14">
                
                <!-- 6. Classical Arched Hearth Lounge -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 5 })">
                    <div class="relative overflow-hidden aspect-[1/1] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136460079.jpg') }}" 
                             alt="Classical Arched Hearth Living"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Classical Arched Hearth Living</h4>
                        </div>
                    </div>
                </div>

                <!-- 7. Grand Promenade Arcade -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 6 })">
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136440316.jpg') }}" 
                             alt="Grand Promenade Retail Arcade"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Exterior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Grand Promenade Retail Arcade</h4>
                        </div>
                    </div>
                </div>

                <!-- 8. Brko Grand Cafe & Dining -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 7 })">
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136449246.jpg') }}" 
                             alt="Brko Grand Cafe & Dining Hall"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Brko Grand Cafe &amp; Dining Hall</h4>
                        </div>
                    </div>
                </div>

                <!-- 9. The Heritage Brick Estate -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 8 })">
                    <div class="relative overflow-hidden aspect-[16/11] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136440362.jpg') }}" 
                             alt="The Heritage Brick Estate"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Exterior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">The Heritage Brick Estate</h4>
                        </div>
                    </div>
                </div>

                <!-- 10. K-Line Wellness & Fitness -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 9 })">
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136449247.jpg') }}" 
                             alt="K-Line Wellness & Fitness Club"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">K-Line Wellness &amp; Fitness Club</h4>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ── Column 3 (Right Stagger — Moderate Offset — 5 Items) ── -->
            <div class="space-y-6 lg:space-y-8 flex flex-col lg:pt-6">
                
                <!-- 11. Coffee Tim Garden Pavilion -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 10 })">
                    <div class="relative overflow-hidden aspect-[16/11] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136440327.jpg') }}" 
                             alt="Coffee Tim Botanical Pavilion"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Exterior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Coffee Tim Botanical Pavilion</h4>
                        </div>
                    </div>
                </div>

                <!-- 12. Minimalist Master Suite -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 11 })">
                    <div class="relative overflow-hidden aspect-[1/1] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136449219.jpg') }}" 
                             alt="Minimalist Linen Master Suite"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Minimalist Linen Master Suite</h4>
                        </div>
                    </div>
                </div>

                <!-- 13. K-Line Commercial Center -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 12 })">
                    <div class="relative overflow-hidden aspect-[16/11] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136440348.jpg') }}" 
                             alt="K-Line Commercial Center"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Exterior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">K-Line Commercial Center</h4>
                        </div>
                    </div>
                </div>

                <!-- 14. Contemporary Marble Dining Suite -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 13 })">
                    <div class="relative overflow-hidden aspect-[4/3] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136460085.jpg') }}" 
                             alt="Contemporary Marble Dining Suite"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Contemporary Marble Dining Suite</h4>
                        </div>
                    </div>
                </div>

                <!-- 15. Marble & Bleached Oak Ensuite -->
                <div class="reveal group relative bg-white border border-slate-200/90 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: items, index: 14 })">
                    <div class="relative overflow-hidden aspect-[16/9] bg-slate-100">
                        <img src="{{ webp_asset('img/showcase/media_1787136841731.jpg') }}" 
                             alt="Marble & Bleached Oak Master Ensuite"
                             loading="lazy" decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-[10px] uppercase tracking-widest text-accent-300 font-bold mb-1">Interior Renders</span>
                            <h4 class="text-white font-display font-medium text-lg leading-snug">Marble &amp; Bleached Oak Master Ensuite</h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

<!-- Services & Portfolio Gallery — Clean, Intuitive Architectural Showcase -->
<section id="services" class="py-24 bg-[#f8fafc] border-b border-slate-200 relative overflow-hidden text-slate-900" x-data="{ 
    activeTab: 'all',
    displayLimit: 6,
    
    items: [
        { category: 'exterior', title: 'The Heritage Brick Estate', tag: 'Exterior Renders', img: '{{ webp_asset('storage/portfolio/exterior-renders/ext4.jpg') }}', slug: 'exterior-renders' },
        { category: 'interior', title: 'Rustic Modern Living Room with Exposed Beams', tag: 'Interior Renders', img: '{{ webp_asset('storage/services/int_res_1787836259_7.jpg') }}', slug: 'interior-renders' },
        { category: 'animation', title: 'Residential Architectural Walkthrough', tag: '3D Animation', img: 'https://img.youtube.com/vi/71NTGV8dpI8/maxresdefault.jpg', slug: 'walkthrough-animation', videoUrl: 'https://www.youtube.com/embed/71NTGV8dpI8?autoplay=1&rel=0', isVideo: true },
        { category: '360', title: 'Open Living & Dining 360° Sphere', tag: '360 Views', img: '{{ webp_asset('storage/services/jEV66oXsmU8uBTmSx9YxkbW6ezHqv9wd9v3AbWDi.jpg') }}', slug: '360-views', is360: true },
        { category: 'exterior', title: 'Modern Mediterranean Luxury Villa', tag: 'Exterior Renders', img: '{{ webp_asset('storage/services/ext_res_1787656416_2.jpg') }}', slug: 'exterior-renders' },
        { category: 'interior', title: 'Contemporary Kitchen with Arched Tiled Alcove', tag: 'Interior Renders', img: '{{ webp_asset('storage/services/int_res_1787836079_3.jpg') }}', slug: 'interior-renders' },

        { category: 'animation', title: 'Cinematic Luxury Estate Walkthrough', tag: '3D Animation', img: 'https://img.youtube.com/vi/aTCQdR368LA/maxresdefault.jpg', slug: 'walkthrough-animation', videoUrl: 'https://www.youtube.com/embed/aTCQdR368LA?autoplay=1&rel=0', isVideo: true },
        { category: 'exterior', title: 'Victorian Home Bird\'s Eye View', tag: 'Exterior Renders', img: '{{ webp_asset('storage/services/aerial_1787648123_1.jpg') }}', slug: 'exterior-renders' },
        { category: 'interior', title: 'Executive Blue Built-in Library & Lounge', tag: 'Interior Renders', img: '{{ webp_asset('storage/services/int_res_blue_library_1787837835.jpg') }}', slug: 'interior-renders' },
        { category: '360', title: 'Master Bedroom 360° Panorama', tag: '360 Views', img: '{{ webp_asset('storage/services/PUI6wPldPNsUukBvstp9IH4OjGxcO14cX4ksdbJ0.jpg') }}', slug: '360-views', is360: true },
        { category: 'exterior', title: 'Classic Coastal Two-Story Residence', tag: 'Exterior Renders', img: '{{ webp_asset('storage/services/ext_res_clean_1787835814.jpg') }}', slug: 'exterior-renders' },
        { category: 'interior', title: 'Luxury Blue Curved Home Bar & Arched Cabinet', tag: 'Interior Renders', img: '{{ webp_asset('storage/services/int_res_blue_bar_1787837683.jpg') }}', slug: 'interior-renders' },

        { category: 'cad', title: 'Multi-Style Presentation Plan', tag: 'Floor Plans', img: '{{ webp_asset('storage/services/color_fp_3plan_top_center_1787627402.jpg') }}', slug: 'floor-plans' },
        { category: 'exterior', title: 'Urban Oasis Palm Garden & Sun Loungers Deck', tag: 'Exterior Renders', img: '{{ webp_asset('storage/portfolio/exterior-renders/land2.jpg') }}', slug: 'exterior-renders' },
        { category: 'interior', title: 'Grand Marble Soaking Tub & Chandelier Ensuite', tag: 'Interior Renders', img: '{{ webp_asset('storage/services/4jxqK3BKWgaixtmrCglxgadCXE1UhRQUGQrrKg1X.png') }}', slug: 'interior-renders' },
        { category: '360', title: 'Luxury Bathroom 360° Panorama', tag: '360 Views', img: '{{ webp_asset('storage/services/DN1u6OJr8VHjgH5dn5PjCi6p30kr9BN5uV2XvYGt.jpg') }}', slug: '360-views', is360: true },
        { category: 'cad', title: 'Architectural Master Site Plan & Subdivision', tag: 'Floor Plans', img: '{{ webp_asset('storage/services/C1BX5iUSQa4SRW8IVD5aZ9NMc12tCoJWe2qQopZL.jpg') }}', slug: 'floor-plans' },
        { category: 'exterior', title: 'Contemporary Stone and Timber Mountain Residence', tag: 'Exterior Renders', img: '{{ webp_asset('storage/services/ext_res_1787656416_5.jpg') }}', slug: 'exterior-renders' },

        { category: 'interior', title: 'Modern Coastal Dining & Kitchen with Rattan', tag: 'Interior Renders', img: '{{ webp_asset('storage/services/int_res_1787836079_1.jpg') }}', slug: 'interior-renders' },
        { category: 'cad', title: '3D Illustrated Color Floor Plan', tag: 'Floor Plans', img: '{{ webp_asset('storage/services/color_fp_1787569743_2_c2e26f.png') }}', slug: 'floor-plans' },
        { category: 'exterior', title: 'Highland Forest Stone Villa', tag: 'Exterior Renders', img: '{{ webp_asset('storage/portfolio/exterior-renders/res11.jpg') }}', slug: 'exterior-renders' },
        { category: 'interior', title: 'Contemporary Home Office & Window Study Nook', tag: 'Interior Renders', img: '{{ webp_asset('storage/services/int_res_home_office_1787837683.jpg') }}', slug: 'interior-renders' },
        { category: 'cad', title: 'Residential Estate Master Layout & Landscape Plan', tag: 'Floor Plans', img: '{{ webp_asset('storage/services/cjHwMhDPqv3C8usSLQPjzAUlemlnX0pPpRiHYJlw.jpg') }}', slug: 'floor-plans' },
        { category: 'interior', title: 'Custom Mudroom & Entryway Built-in Storage', tag: 'Interior Renders', img: '{{ webp_asset('storage/services/int_res_mudroom_1787837683.jpg') }}', slug: 'interior-renders' }
    ],

    get filteredItems() {
        if (this.activeTab === 'all') return this.items;
        return this.items.filter(item => item.category === this.activeTab);
    },

    get visibleItems() {
        return this.filteredItems.slice(0, this.displayLimit);
    },

    get hasMore() {
        return this.displayLimit < this.filteredItems.length;
    },

    setTab(tab) {
        this.activeTab = tab;
        this.displayLimit = 6;
    }
}">
    <!-- Slow Atmospheric Ambient Drift Lights -->
    <div class="ambient-drift-1 absolute top-1/4 -left-48 w-96 h-96 bg-accent-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="ambient-drift-2 absolute top-2/3 -right-48 w-96 h-96 bg-[#1A9E96]/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="container mx-auto px-6 xl:px-12 relative z-10" style="max-width:1536px">
        
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-display font-light uppercase tracking-tight text-slate-900 leading-tight">
                Our <span class="font-normal text-transparent bg-clip-text bg-gradient-to-r from-slate-950 via-accent-500 to-accent-400">Services</span>
            </h2>
            <p class="text-sm sm:text-base text-slate-600 font-light mt-3 leading-relaxed">
                Explore our recent exterior &amp; interior renders, 3D animations, 360 views, and floor plans.
            </p>
        </div>

        {{-- Simple, Clean Filter Tabs Matching Core Services (Mobile Scrollable) --}}
        <div class="flex items-center gap-2 mb-10 overflow-x-auto pb-3 sm:pb-0 sm:flex-wrap sm:justify-center justify-start max-w-full px-2" style="scrollbar-width: none; -webkit-overflow-scrolling: touch;">
            <button @click="setTab('all')" :class="activeTab === 'all' ? 'bg-slate-900 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:border-accent-400 hover:text-slate-900'" class="flex-shrink-0 px-4 sm:px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300 cursor-pointer">
                All Works
            </button>
            <button @click="setTab('exterior')" :class="activeTab === 'exterior' ? 'bg-accent-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:border-accent-400 hover:text-slate-900'" class="flex-shrink-0 px-4 sm:px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300 cursor-pointer">
                Exterior Renders
            </button>
            <button @click="setTab('interior')" :class="activeTab === 'interior' ? 'bg-accent-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:border-accent-400 hover:text-slate-900'" class="flex-shrink-0 px-4 sm:px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300 cursor-pointer">
                Interior Renders
            </button>
            <button @click="setTab('animation')" :class="activeTab === 'animation' ? 'bg-accent-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:border-accent-400 hover:text-slate-900'" class="flex-shrink-0 px-4 sm:px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300 cursor-pointer">
                3D Animation
            </button>
            <button @click="setTab('360')" :class="activeTab === '360' ? 'bg-accent-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:border-accent-400 hover:text-slate-900'" class="flex-shrink-0 px-4 sm:px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300 cursor-pointer">
                360 Views
            </button>
            <button @click="setTab('cad')" :class="activeTab === 'cad' ? 'bg-accent-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:border-accent-400 hover:text-slate-900'" class="flex-shrink-0 px-4 sm:px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300 cursor-pointer">
                Floor Plans
            </button>
        </div>

        {{-- Unified 3-Column Portfolio Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <template x-for="(item, index) in visibleItems" :key="index">
                <div class="group relative rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-md hover:shadow-2xl transition-all duration-500 flex flex-col justify-between cursor-pointer"
                     data-cursor-label="VIEW"
                     @click="$dispatch('open-lightbox-modal', { items: filteredItems, index: index })">
                    
                    <!-- Image Container with Smooth Parallax Zoom -->
                    <div class="scroll-scale-wrap relative w-full aspect-[16/10] overflow-hidden bg-slate-900">
                        <img :src="item.img" :alt="item.title" loading="lazy" decoding="async" class="scroll-scale-img w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out">

                        <!-- Special Badge for Video / 360 -->
                        <template x-if="item.isVideo">
                            <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
                                <div class="w-12 h-12 rounded-full bg-accent-500/90 text-white flex items-center justify-center shadow-lg group-hover:scale-115 transition-transform">
                                    <svg class="w-5 h-5 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        </template>

                        <template x-if="item.is360">
                            <div class="absolute bottom-3 right-3 z-10">
                                <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-black/70 text-white border border-white/20 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-accent-400 animate-spin" style="animation-duration: 6s;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    360°
                                </span>
                            </div>
                        </template>

                        <!-- Hover Zoom Icon -->
                        <div class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="w-8 h-8 rounded-full bg-white/30 backdrop-blur-md border border-white/40 text-white flex items-center justify-center shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 bg-white flex flex-col justify-between flex-grow">
                        <div>
                            <span class="inline-block text-[11px] font-bold uppercase tracking-wider text-accent-600 mb-1.5" x-text="item.tag"></span>
                            <h3 class="text-lg sm:text-xl font-display font-semibold text-slate-900 leading-snug tracking-normal group-hover:text-accent-600 transition-colors" x-text="item.title"></h3>
                        </div>
                        
                        <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs uppercase tracking-wider font-bold text-accent-600 group-hover:text-accent-500 flex items-center gap-1.5">
                                <span>View Project</span>
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Single, Clear "Load More Works" Button --}}
        <div class="mt-14 text-center">
            <template x-if="hasMore">
                <button type="button" @click="displayLimit += 6" class="btn-magnetic inline-flex items-center gap-3 px-8 py-4 rounded-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold uppercase tracking-widest shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 cursor-pointer">
                    <span>Load More Works (+6 Projects)</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </template>
            
            <template x-if="!hasMore">
                <div class="inline-flex items-center gap-2 text-xs text-slate-500 font-medium">
                    <span>All featured works displayed.</span>
                    <a :href="`{{ url('/services') }}/${activeTab === 'all' ? 'exterior-renders' : (activeTab === 'cad' ? 'floor-plans' : (activeTab === 'animation' ? 'walkthrough-animation' : (activeTab === 'interior' ? 'interior-renders' : (activeTab === '360' ? '360-views' : 'exterior-renders'))))}`" class="text-accent-600 font-bold hover:underline">Explore Full Service Archive →</a>
                </div>
            </template>
        </div>

    </div>

</section>

<!-- Testimonials Section — Light Editorial Styling -->
<section class="py-28 bg-slate-50/80 border-b border-slate-200/80 relative overflow-hidden text-slate-900">
    <div class="ambient-drift-1 absolute -top-24 -left-24 w-80 h-80 bg-accent-500/5 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="container mx-auto px-6 xl:px-12 relative z-10" style="max-width:1536px">

        <div class="text-center mb-14 reveal">
            <h2 class="text-4xl md:text-5xl font-display font-light text-slate-900"><span class="font-normal text-transparent bg-clip-text bg-gradient-to-r from-slate-950 via-accent-500 to-accent-400">Trusted</span> by Professionals Worldwide</h2>
        </div>

        <!-- 5-star header -->
        <div class="flex justify-center items-center gap-1.5 mb-14 reveal">
            <div class="flex items-center gap-1 text-accent-500">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <span class="text-slate-600 text-sm font-light ml-2">5.0 · Rated by our global clientele</span>
        </div>

        <!-- Review Cards Container (Grid on desktop, Slider on mobile) -->
        <div x-data="{ 
                 activeSlide: 0, 
                 totalSlides: 4,
                 touchStartX: 0,
                 touchEndX: 0,
                 handleTouchStart(e) {
                     this.touchStartX = e.touches[0].clientX;
                 },
                 handleTouchEnd(e) {
                     this.touchEndX = e.changedTouches[0].clientX;
                     this.handleSwipe();
                 },
                 handleSwipe() {
                     const diff = this.touchStartX - this.touchEndX;
                     if (Math.abs(diff) > 40) {
                         if (diff > 0) {
                             this.next();
                         } else {
                             this.prev();
                         }
                     }
                 },
                 next() {
                     this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                 },
                 prev() {
                     this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
                 }
             }">
            
            <!-- Mobile Slider View (Visible only on mobile) -->
            <div class="md:hidden relative" 
                 @touchstart="handleTouchStart($event)"
                 @touchend="handleTouchEnd($event)"
                 style="touch-action: pan-y;">
                 
                 <!-- Review Card wrapper -->
                 <div class="relative min-h-[380px] sm:min-h-[320px] overflow-hidden">
                     <!-- Anthony Vance -->
                     <div x-show="activeSlide === 0" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-x-8"
                          x-transition:enter-end="opacity-100 translate-x-0"
                          x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                          x-transition:leave-start="opacity-100 translate-x-0"
                          x-transition:leave-end="opacity-0 -translate-x-8"
                          class="bg-white border border-slate-200/90 shadow-md rounded-2xl p-8 flex flex-col hover:shadow-xl transition-all duration-300 h-full">
                         <p class="text-slate-600 font-light leading-relaxed italic flex-1 mb-6 text-sm">"Space IQ is a one-of-a-kind studio. I have been so impressed with the quality of their work and their work ethic. They delivered my plans before schedule which helped me immensely. They were also extremely accurate and very patient and diligent. Will hire them again in a heartbeat!"</p>
                         <div class="w-8 h-px bg-accent-500/40 mb-4"></div>
                         <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Anthony Vance</p>
                         <p class="text-accent-600 text-xs uppercase tracking-wider font-semibold mt-1">Lead Structural Engineer</p>
                     </div>

                     <!-- Ryan Sterling -->
                     <div x-show="activeSlide === 1" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-x-8"
                          x-transition:enter-end="opacity-100 translate-x-0"
                          x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                          x-transition:leave-start="opacity-100 translate-x-0"
                          x-transition:leave-end="opacity-0 -translate-x-8"
                          class="bg-white border border-slate-200/90 shadow-md rounded-2xl p-8 flex flex-col hover:shadow-xl transition-all duration-300 h-full"
                          style="display: none;">
                         <p class="text-slate-600 font-light leading-relaxed italic flex-1 mb-6 text-sm">"The 3D walkthrough animation Space IQ created for our luxury residential development was nothing short of outstanding. Our sales team used it at every presentation and it completely changed how buyers engaged with the project. Closed three units in the first week alone."</p>
                         <div class="w-8 h-px bg-accent-500/40 mb-4"></div>
                         <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Ryan Sterling</p>
                         <p class="text-accent-600 text-xs uppercase tracking-wider font-semibold mt-1">Property Development Director</p>
                     </div>

                     <!-- Justin Thorne -->
                     <div x-show="activeSlide === 2" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-x-8"
                          x-transition:enter-end="opacity-100 translate-x-0"
                          x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                          x-transition:leave-start="opacity-100 translate-x-0"
                          x-transition:leave-end="opacity-0 -translate-x-8"
                          class="bg-white border border-slate-200/90 shadow-md rounded-2xl p-8 flex flex-col hover:shadow-xl transition-all duration-300 h-full"
                          style="display: none;">
                         <p class="text-slate-600 font-light leading-relaxed italic flex-1 mb-6 text-sm">"We needed high-quality exterior renders for a commercial project under a very tight deadline. Space IQ delivered ahead of schedule with incredible attention to detail — lighting, materials, landscaping, everything was spot on. Our client was blown away. We will absolutely work with them again."</p>
                         <div class="w-8 h-px bg-accent-500/40 mb-4"></div>
                         <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Justin Thorne</p>
                         <p class="text-accent-600 text-xs uppercase tracking-wider font-semibold mt-1">Senior Project Manager</p>
                     </div>

                     <!-- Robert Sinclair -->
                     <div x-show="activeSlide === 3" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-x-8"
                          x-transition:enter-end="opacity-100 translate-x-0"
                          x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                          x-transition:leave-start="opacity-100 translate-x-0"
                          x-transition:leave-end="opacity-0 -translate-x-8"
                          class="bg-white border border-slate-200/90 shadow-md rounded-2xl p-8 flex flex-col hover:shadow-xl transition-all duration-300 h-full"
                          style="display: none;">
                         <p class="text-slate-600 font-light leading-relaxed italic flex-1 mb-6 text-sm">"The 360° virtual tours Space IQ produced for our properties transformed our international sales process entirely. Buyers from the UK and UAE were able to walk through apartments remotely and make decisions with full confidence. It is a complete game-changer for off-plan sales."</p>
                         <div class="w-8 h-px bg-accent-500/40 mb-4"></div>
                         <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Robert Sinclair</p>
                         <p class="text-accent-600 text-xs uppercase tracking-wider font-semibold mt-1">Principal Interior Architect</p>
                     </div>
                 </div>

                 <!-- Slider Navigation Controls for Mobile -->
                 <div class="flex justify-between items-center mt-6 px-2">
                     <button @click="prev()" class="w-9 h-9 rounded-full bg-white border border-slate-200 text-slate-800 hover:text-accent-500 hover:scale-105 flex items-center justify-center transition-all shadow-sm cursor-pointer">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                     </button>
                     
                     <!-- Pagination Dots -->
                     <div class="flex gap-2">
                         <template x-for="idx in [0, 1, 2, 3]">
                             <button @click="activeSlide = idx" 
                                     class="w-2 h-2 rounded-full transition-all focus:outline-none"
                                     :class="activeSlide === idx ? 'bg-accent-500 w-5' : 'bg-slate-300'"></button>
                         </template>
                     </div>
                     
                     <button @click="next()" class="w-9 h-9 rounded-full bg-white border border-slate-200 text-slate-800 hover:text-accent-500 hover:scale-105 flex items-center justify-center transition-all shadow-sm cursor-pointer">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                     </button>
                 </div>
            </div>

            <!-- Desktop Grid View (Visible on tablet/desktop) -->
            <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Anthony Vance -->
                <div class="reveal bg-white border border-slate-200/90 shadow-sm hover:shadow-xl rounded-2xl p-8 flex flex-col transition-all duration-300">
                    <p class="text-slate-600 font-light leading-relaxed italic flex-1 mb-6 text-sm">"Space IQ is a one-of-a-kind studio. I have been so impressed with the quality of their work and their work ethic. They delivered my plans before schedule which helped me immensely. They were also extremely accurate and very patient and diligent. Will hire them again in a heartbeat!"</p>
                    <div class="w-8 h-px bg-accent-500/40 mb-4"></div>
                    <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Anthony Vance</p>
                    <p class="text-accent-600 text-xs uppercase tracking-wider font-semibold mt-1">Lead Structural Engineer</p>
                </div>

                <!-- Ryan Sterling -->
                <div class="reveal bg-white border border-slate-200/90 shadow-sm hover:shadow-xl rounded-2xl p-8 flex flex-col transition-all duration-300" style="transition-delay:0.1s">
                    <p class="text-slate-600 font-light leading-relaxed italic flex-1 mb-6 text-sm">"The 3D walkthrough animation Space IQ created for our luxury residential development was nothing short of outstanding. Our sales team used it at every presentation and it completely changed how buyers engaged with the project. Closed three units in the first week alone."</p>
                    <div class="w-8 h-px bg-accent-500/40 mb-4"></div>
                    <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Ryan Sterling</p>
                    <p class="text-accent-600 text-xs uppercase tracking-wider font-semibold mt-1">Property Development Director</p>
                </div>

                <!-- Justin Thorne -->
                <div class="reveal bg-white border border-slate-200/90 shadow-sm hover:shadow-xl rounded-2xl p-8 flex flex-col transition-all duration-300" style="transition-delay:0.2s">
                    <p class="text-slate-600 font-light leading-relaxed italic flex-1 mb-6 text-sm">"We needed high-quality exterior renders for a commercial project under a very tight deadline. Space IQ delivered ahead of schedule with incredible attention to detail — lighting, materials, landscaping, everything was spot on. Our client was blown away. We will absolutely work with them again."</p>
                    <div class="w-8 h-px bg-accent-500/40 mb-4"></div>
                    <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Justin Thorne</p>
                    <p class="text-accent-600 text-xs uppercase tracking-wider font-semibold mt-1">Senior Project Manager</p>
                </div>

                <!-- Robert Sinclair -->
                <div class="reveal bg-white border border-slate-200/90 shadow-sm hover:shadow-xl rounded-2xl p-8 flex flex-col transition-all duration-300" style="transition-delay:0.3s">
                    <p class="text-slate-600 font-light leading-relaxed italic flex-1 mb-6 text-sm">"The 360° virtual tours Space IQ produced for our properties transformed our international sales process entirely. Buyers from the UK and UAE were able to walk through apartments remotely and make decisions with full confidence. It is a complete game-changer for off-plan sales."</p>
                    <div class="w-8 h-px bg-accent-500/40 mb-4"></div>
                    <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Robert Sinclair</p>
                    <p class="text-accent-600 text-xs uppercase tracking-wider font-semibold mt-1">Principal Interior Architect</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About & Value Proposition -->
<section id="process" class="py-28 bg-white border-b border-slate-200 relative text-slate-900 reveal">
    <div class="container mx-auto px-6 xl:px-12 relative z-10" style="max-width:1536px">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-20 items-start">
            <!-- Left: Text -->
            <div class="reveal-left">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-display font-light mb-6 text-slate-900 uppercase tracking-wide leading-tight">More than just <br><span class="font-normal text-transparent bg-clip-text bg-gradient-to-r from-slate-950 via-accent-500 to-accent-400">Drawings &amp; Renders.</span></h2>
                <p class="text-slate-600 text-base md:text-lg mb-6 font-light leading-relaxed">
                    We don't just create drawings or renders — we take ownership of your project and solve problems. From concept to construction-ready drawings and stunning photorealistic visuals, everything is handled by our expert team.
                </p>
                <p class="text-slate-500 text-sm md:text-md mb-8 font-light leading-relaxed">
                    Whether you have a rough sketch, a PDF, or existing plans, we turn them into permit-ready drawings and high-end visuals that are clear, buildable, and presentation-ready.
                </p>
                <div class="inline-block p-4 rounded-2xl border border-accent-400/30 bg-accent-500/5">
                    <p class="text-accent-700 font-medium text-sm tracking-wide">👉 Our goal is simple: Once you partner with us, you shouldn't need to look for anyone else again.</p>
                </div>
            </div>

            <!-- Right: Visual Process Timeline -->
            <div class="reveal-right">
                <p class="text-xs uppercase tracking-widest text-accent-500 font-bold mb-8">Our Process</p>
                <div class="relative">
                    <!-- Vertical Line -->
                    <div class="absolute left-5 top-0 bottom-0 w-px bg-gradient-to-b from-accent-500/60 via-accent-500/20 to-transparent"></div>
                     <div class="space-y-8">
                         <!-- Step 1 -->
                         <div class="flex gap-6 items-start">
                             <div class="timeline-step-circle flex-shrink-0 w-10 h-10 rounded-full bg-white border-2 border-slate-300 text-accent-600 flex items-center justify-center z-10 relative font-bold text-sm shadow-sm transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg></div>
                             <div class="pt-1.5">
                                 <h4 class="text-slate-900 font-bold text-lg mb-1">Share Your Files</h4>
                                 <p class="text-slate-600 text-sm font-light leading-relaxed">Send us your sketches, PDFs, CAD files, or even a rough napkin drawing. We accept all formats.</p>
                             </div>
                         </div>
                         <!-- Step 2 -->
                         <div class="flex gap-6 items-start">
                             <div class="timeline-step-circle flex-shrink-0 w-10 h-10 rounded-full bg-white border-2 border-slate-300 text-accent-600 flex items-center justify-center z-10 relative font-bold text-sm shadow-sm transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                             <div class="pt-1.5">
                                 <h4 class="text-slate-900 font-bold text-lg mb-1">We Plan &amp; Confirm</h4>
                                 <p class="text-slate-600 text-sm font-light leading-relaxed">Our team reviews your brief, asks the right questions, and confirms scope, timeline, and deliverables.</p>
                             </div>
                         </div>
                         <!-- Step 3 -->
                         <div class="flex gap-6 items-start">
                             <div class="timeline-step-circle flex-shrink-0 w-10 h-10 rounded-full bg-white border-2 border-slate-300 text-accent-600 flex items-center justify-center z-10 relative font-bold text-sm shadow-sm transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg></div>
                             <div class="pt-1.5">
                                 <h4 class="text-slate-900 font-bold text-lg mb-1">First Draft Delivery</h4>
                                 <p class="text-slate-600 text-sm font-light leading-relaxed">We deliver an initial draft for your review. You give feedback and we refine until it's perfect.</p>
                             </div>
                         </div>
                         <!-- Step 4 -->
                         <div class="flex gap-6 items-start">
                             <div class="timeline-step-circle flex-shrink-0 w-10 h-10 rounded-full bg-white border-2 border-slate-300 text-accent-600 flex items-center justify-center z-10 relative font-bold text-sm shadow-sm transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                             <div class="pt-1.5">
                                 <h4 class="text-slate-900 font-bold text-lg mb-1">Final Delivery</h4>
                                 <p class="text-slate-600 text-sm font-light leading-relaxed">High-resolution final files delivered in your preferred format — ready for marketing, pitches, and permits.</p>
                             </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section id="contact" class="py-24 relative bg-slate-50/80 overflow-hidden reveal">
    <div class="container mx-auto px-6 max-w-5xl relative z-10">
        <div class="rounded-3xl bg-gradient-to-br from-white via-slate-50 to-teal-50/40 text-slate-900 p-6 sm:p-12 md:p-20 text-center shadow-xl border border-slate-200/90 relative overflow-hidden">
            {{-- Soft Ambient Glow --}}
            <div class="absolute -right-24 -top-24 w-80 h-80 bg-teal-500/10 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute -left-24 -bottom-24 w-80 h-80 bg-slate-300/20 rounded-full blur-[100px] pointer-events-none"></div>

            <div class="relative z-10 max-w-2xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 border border-teal-200/70 text-teal-800 text-xs font-semibold uppercase tracking-wider mb-5">
                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                    <span>Love What You See?</span>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-display font-light mb-6 text-slate-900 uppercase tracking-tight leading-tight">
                    Ready to make your <br><span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-teal-700 via-teal-800 to-slate-900">vision a reality?</span>
                </h2>

                <p class="text-slate-600 text-base md:text-lg font-normal mb-10 max-w-xl mx-auto leading-relaxed">
                    Let's collaborate to bring your architectural drawings and blueprints to life with stunning hyper-realistic renders.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('contact') }}" class="btn-magnetic px-9 py-4 text-xs uppercase tracking-widest font-semibold text-white bg-teal-700 hover:bg-teal-800 rounded-full shadow-lg shadow-teal-700/20 transition-all duration-300 hover:scale-105 inline-flex items-center gap-2">
                        <span>Book a Consultation</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('service.show', 'exterior-renders') }}" class="btn-magnetic px-8 py-4 text-xs uppercase tracking-widest font-semibold text-slate-700 hover:text-slate-900 bg-white hover:bg-slate-50 border border-slate-200/90 rounded-full shadow-xs transition-all duration-300">
                        Explore Portfolio
                    </a>
                </div>

                {{-- Architectural Guarantees --}}
                <div class="mt-12 pt-8 border-t border-slate-200/80 flex flex-wrap items-center justify-center gap-6 text-xs text-slate-500 font-medium">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        24h Proposal Turnaround
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        4K & 8K Ultra-HD Fidelity
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Strict Confidentiality (NDA)
                    </span>
                </div>
            </div>
        </div>
    </div>
<!-- ── Lightbox Modal (Exact Match to Individual Service Pages) ── -->
<template x-teleport="body">
    <div x-show="lightboxOpen" 
         class="fixed inset-0 z-[999999] flex flex-col items-center justify-center bg-brand-950/98 p-4 md:p-8 backdrop-blur-md" 
         x-transition.opacity 
         style="display: none;"
         @keydown.escape.window="closeLightbox()"
         @keydown.left.window="if(!is360) prevImage()"
         @keydown.right.window="if(!is360) nextImage()">
        
        <!-- Top Bar: Counter & Close Button -->
        <div class="w-full flex items-center justify-between z-[110] px-2 sm:px-4 flex-shrink-0">
            <!-- Left spacer or counter -->
            <div>
                <span class="text-xs sm:text-sm text-white/70 font-mono tracking-wider" x-text="(lightboxIndex + 1) + ' / ' + lightboxImages.length"></span>
            </div>

            <!-- Right: Close Button -->
            <button type="button" 
                    @click="closeLightbox()" 
                    class="text-white/80 hover:text-white transition-colors bg-white/10 hover:bg-white/20 rounded-full p-2.5 sm:p-3 border border-white/20 hover:scale-105 transform duration-200 cursor-pointer" 
                    title="Close (Esc)">
                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <!-- 360 Viewer Container -->
        <template x-if="is360">
            <div class="w-full h-full max-w-7xl max-h-[85vh] mx-auto rounded-2xl overflow-hidden border border-white/10 shadow-2xl relative z-[105] bg-brand-950 flex flex-col my-auto" @click.away="closeLightbox()">
                <div id="home-panorama-viewer" class="w-full h-full min-h-[450px]"></div>
            </div>
        </template>

        <!-- Standard Image / Video Container: Fills Whole Screen -->
        <template x-if="!is360">
            <div class="relative w-full h-full flex-1 flex items-center justify-center z-[105] overflow-hidden my-auto select-none" 
                 @touchstart="touchStartX = $event.touches[0].clientX"
                 @touchend="touchEndX = $event.changedTouches[0].clientX; if (touchStartX - touchEndX > 40) nextImage(); if (touchEndX - touchStartX > 40) prevImage();">
                
                <!-- Left Arrow -->
                <button type="button" 
                        x-show="lightboxImages.length > 1" 
                        @click.stop="prevImage()" 
                        class="absolute left-2 sm:left-6 text-white/80 hover:text-white transition-all bg-black/60 hover:bg-black/90 rounded-full p-3 sm:p-4 border border-white/20 hover:scale-110 transform z-[115] cursor-pointer" 
                        title="Previous (Left Arrow)">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <!-- Video Player -->
                <template x-if="lightboxIsVideo">
                    <div class="w-[85vw] max-w-5xl aspect-video rounded-xl overflow-hidden shadow-2xl border border-white/10 bg-black">
                        <iframe :src="lightboxVideoUrl" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </template>

                <!-- Full-Screen Image Viewport -->
                <template x-if="!lightboxIsVideo">
                    <div class="w-full h-full flex items-center justify-center p-1 sm:p-4">
                        <img :src="lightboxUrl" 
                             :alt="lightboxTitle || 'Space IQ Portfolio Project'" 
                             class="w-auto h-auto max-w-[96vw] max-h-[86vh] object-contain rounded-lg shadow-2xl select-none mx-auto block"
                             style="image-rendering: -webkit-optimize-contrast; image-rendering: high-quality;">
                    </div>
                </template>
                
                <!-- Right Arrow -->
                <button type="button" 
                        x-show="lightboxImages.length > 1" 
                        @click.stop="nextImage()" 
                        class="absolute right-2 sm:right-6 text-white/80 hover:text-white transition-all bg-black/60 hover:bg-black/90 rounded-full p-3 sm:p-4 border border-white/20 hover:scale-110 transform z-[115] cursor-pointer" 
                        title="Next (Right Arrow)">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </template>

        <!-- Bottom Bar: Title Caption -->
        <div class="w-full text-center z-[110] flex-shrink-0 pt-1">
            <h3 class="text-white text-xs sm:text-sm md:text-base font-display font-medium tracking-wide bg-black/80 backdrop-blur-md border border-white/20 px-6 py-2 rounded-full shadow-2xl inline-block" 
                x-show="lightboxTitle" 
                x-text="lightboxTitle"></h3>
        </div>
    </div>
</template>

</div>

@endsection

@push('scripts')
<script>
// ── Global Lightbox Helper ──
window.openLightbox = function(items, index) {
    window.dispatchEvent(new CustomEvent('open-lightbox-modal', {
        detail: { items: items, index: index || 0 }
    }));
};

// ── Clean up BIG.dk intro elements after animation ──
(function() {
    setTimeout(() => {
        const curtain = document.getElementById('intro-curtain');
        const brand   = document.getElementById('intro-brand');
        if (curtain) curtain.remove();
        if (brand) brand.remove();
    }, 2500);
})();

(function() {
    const section = document.getElementById('stats-section');
    if (!section) return;
    let started = false;
    const observer = new IntersectionObserver(entries => {
        if (entries[0].isIntersecting && !started) {
            started = true;
            section.querySelectorAll('[data-count]').forEach(el => {
                const target = parseInt(el.dataset.count);
                const suffix = el.dataset.suffix || '';
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;
                const timer = setInterval(() => {
                    current = Math.min(current + step, target);
                    el.textContent = Math.floor(current).toLocaleString() + suffix;
                    if (current >= target) clearInterval(timer);
                }, 16);
            });
        }
    }, { threshold: 0.5 });
    observer.observe(section);
})();

// ── Scroll Activated Timeline Glow ──
(function() {
    const steps = document.querySelectorAll('.timeline-step-circle');
    if (steps.length === 0) return;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { 
        threshold: 0.8,
        rootMargin: '0px 0px -50px 0px'
    });
    
    steps.forEach(step => observer.observe(step));
})();

</script>
@endpush
