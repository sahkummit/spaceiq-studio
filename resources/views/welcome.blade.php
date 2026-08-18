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

<!-- Hero Section — full screen video, no text overlay except stats bar -->
<section class="relative overflow-hidden bg-brand-950" style="height: 100svh; min-height: 600px;">
    <!-- Background Video Wrapper -->
    <div class="absolute inset-0 z-0 bg-brand-950 overflow-hidden" id="hero-video-container">
        <!-- Direct YouTube Autoplay Video (no image fallback) -->
        <iframe class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[100vw] h-[56.25vw] min-h-[100vh] min-w-[177.77vh] pointer-events-none opacity-85 select-none scale-[1.35]"
                src="https://www.youtube.com/embed/aTCQdR368LA?autoplay=1&mute=1&controls=0&loop=1&playlist=aTCQdR368LA&playsinline=1&showinfo=0&rel=0&modestbranding=1&start=26&iv_load_policy=3&disablekb=1&fs=0"
                frameborder="0"
                allow="autoplay; encrypted-media"
                allowfullscreen></iframe>
        <!-- Transparent click shield -->
        <div class="absolute inset-0 bg-transparent z-10 pointer-events-auto"></div>
    </div>

    <!-- Stats Banner — Completely transparent, floating directly over video -->
    <div class="absolute bottom-0 left-0 w-full z-20 py-8 bg-transparent">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="flex items-center justify-center gap-8 md:gap-16 text-center flex-wrap" id="stats-section">
                <div>
                    <p class="text-3xl md:text-4xl font-display font-bold text-white mb-0.5 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" data-count="12000" data-suffix="+">0</p>
                    <p class="text-[9px] uppercase tracking-widest text-white font-semibold drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">Successful Projects</p>
                </div>
                <div class="stats-strip-sep hidden md:block"></div>
                <div>
                    <p class="text-3xl md:text-4xl font-display font-bold text-white mb-0.5 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" data-count="500" data-suffix="+">0</p>
                    <p class="text-[9px] uppercase tracking-widest text-white font-semibold drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">Happy Clients</p>
                </div>
                <div class="stats-strip-sep hidden md:block"></div>
                <div>
                    <p class="text-3xl md:text-4xl font-display font-bold text-white mb-0.5 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" data-count="15" data-suffix="+">0</p>
                    <p class="text-[9px] uppercase tracking-widest text-white font-semibold drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">Countries</p>
                </div>
                <div class="stats-strip-sep hidden md:block"></div>
                <div>
                    <p class="text-3xl md:text-4xl font-display font-bold text-white mb-0.5 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" data-count="10" data-suffix="+">0</p>
                    <p class="text-[9px] uppercase tracking-widest text-white font-semibold drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">Years of Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Value Proposition Section -->
<section class="py-20 border-y border-white/5 bg-brand-900 border-t border-accent-400/10">
    <div class="container mx-auto px-6 xl:px-12" style="max-width:1536px">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left text-white">
            <div class="p-6 reveal">
                <div class="w-12 h-12 rounded-lg bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-5 md:mx-0 mx-auto">
                    <svg class="w-6 h-6 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <p class="text-xl font-display font-medium text-accent-400 mb-3 uppercase tracking-wider">Hyper-Realistic Precision</p>
                <p class="text-gray-300 text-sm leading-relaxed font-light">We don't just create images; we simulate reality. From the way light reflects off a window to the tactile texture of a brick facade, every detail is engineered for authenticity.</p>
            </div>
            <div class="p-6 reveal" style="transition-delay:0.15s">
                <div class="w-12 h-12 rounded-lg bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-5 md:mx-0 mx-auto">
                    <svg class="w-6 h-6 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <p class="text-xl font-display font-medium text-accent-400 mb-3 uppercase tracking-wider">Client-Centric Narrative</p>
                <p class="text-gray-300 text-sm leading-relaxed font-light">We populate your designs with life—modern landscaping, realistic lighting, and curated environments that help potential buyers see themselves in the space.</p>
            </div>
            <div class="p-6 reveal" style="transition-delay:0.3s">
                <div class="w-12 h-12 rounded-lg bg-accent-500/15 border border-accent-400/25 flex items-center justify-center mb-5 md:mx-0 mx-auto">
                    <svg class="w-6 h-6 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </div>
                <p class="text-xl font-display font-medium text-accent-400 mb-3 uppercase tracking-wider">Seamless Integration</p>
                <p class="text-gray-300 text-sm leading-relaxed font-light">High-resolution visualizations designed to plug directly into your marketing decks, websites, and investor pitches flawlessly.</p>
            </div>
        </div>
    </div>
</section>




<!-- Services — Editorial Full-Bleed Layout -->
<section id="services" class="bg-brand-950 relative">
    @php
        $editorialServices = \App\Models\Service::where('is_active', true)
            ->whereNotIn('slug', ['autocad-drafting', 'interior-design-consultation'])
            ->orderBy('sort_order')
            ->get();
    @endphp

    {{-- Section header --}}
    <div class="pt-24 pb-12 container mx-auto px-6 xl:px-12 flex items-end justify-between" style="max-width:1536px">
        <div>
            <p class="text-[10px] uppercase tracking-[0.3em] text-accent-400 font-bold mb-3">Selected Works</p>
            <h2 class="text-5xl md:text-7xl font-display font-light uppercase tracking-[0.1em] text-white leading-none">Our<br><span class="italic font-thin">Services</span></h2>
        </div>
        <div class="hidden md:block text-right">
            <div class="w-16 h-px bg-accent-400/30 mb-2 ml-auto"></div>
            <p class="text-xs text-white/30 uppercase tracking-widest font-light">High-Fidelity<br>Architectural Visualization</p>
        </div>
    </div>

    @forelse($editorialServices as $idx => $service)
        @php
            $isEven = $idx % 2 === 0;
            if ($service->slug === 'walkthrough-animation') {
                $videoMedia = $service->media->sortBy('sort_order')->first();
                $isYt = $videoMedia && (str_contains($videoMedia->file_path, 'youtube.com') || str_contains($videoMedia->file_path, 'youtu.be'));
                if ($isYt && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|watch\?v=|v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoMedia->file_path, $ytm)) {
                    $youtubeThumb = "https://img.youtube.com/vi/{$ytm[1]}/maxresdefault.jpg";
                } else { $youtubeThumb = null; }
                $featuredImage = null;
            } else {
                $videoMedia = null;
                $youtubeThumb = null;
                $mediaObj = $service->media->where('file_type', '!=', 'video')->sortBy('sort_order')->first();
                $featuredImage = $mediaObj ? webp_asset(parse_url(Storage::url($mediaObj->file_path), PHP_URL_PATH)) : null;
                if (!$featuredImage) {
                    $featuredImage = $service->slug === 'interior-renders' ? webp_asset('/img/interior_render.png') : webp_asset('/img/exterior_render.png');
                }
            }
            $numStr = str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
            $imgSrc = $youtubeThumb ?? $featuredImage;
        @endphp

        <a href="{{ route('service.show', $service->slug) }}"
           class="service-editorial-item group block relative"
           style="text-decoration:none;">
            <div class="flex flex-col {{ $isEven ? 'md:flex-row' : 'md:flex-row-reverse' }} min-h-[80vh] md:min-h-[65vh]">

                {{-- Image panel --}}
                <div class="relative overflow-hidden w-full md:w-3/5 bg-black" style="min-height: 280px;">
                    @if($imgSrc)
                        <img src="{{ $imgSrc }}" alt="{{ $service->title }}"
                             class="absolute inset-0 w-full h-full object-cover opacity-80 transition-transform duration-[900ms] ease-out group-hover:scale-[1.04]">
                    @endif
                    <div class="absolute inset-0 pointer-events-none"
                         style="background: linear-gradient(to {{ $isEven ? 'right' : 'left' }}, transparent 50%, rgba(4,16,15,0.75) 100%);"></div>
                </div>

                {{-- Text panel --}}
                <div class="relative w-full md:w-2/5 bg-brand-950 flex flex-col justify-center px-10 md:px-16 py-14 md:py-24 overflow-hidden">
                    <span class="service-number {{ $isEven ? '-right-2' : '-left-2' }} bottom-0">{{ $numStr }}</span>

                    <p class="text-[10px] uppercase tracking-[0.35em] text-accent-400/80 font-bold mb-5 relative z-10">{{ $service->category ?? 'Visualization' }}</p>

                    <h3 class="font-display text-4xl md:text-5xl lg:text-[3.2rem] font-light text-white uppercase leading-[1.05] mb-5 relative z-10" style="letter-spacing:0.07em;">
                        {{ $service->title }}
                    </h3>

                    <div class="w-10 h-px bg-accent-400/50 mb-6 relative z-10"></div>

                    <p class="text-gray-400 font-light text-sm md:text-[0.95rem] leading-relaxed max-w-xs mb-10 relative z-10">
                        {{ Str::limit($service->description ?? 'Precision-crafted architectural visuals that transform your ideas into reality.', 130) }}
                    </p>

                    <div class="flex items-center gap-4 relative z-10">
                        <span class="text-[10px] uppercase tracking-widest text-accent-400 font-bold group-hover:text-white transition-colors duration-300">View Work</span>
                        <div class="w-8 h-8 rounded-full border border-accent-400/40 flex items-center justify-center group-hover:bg-accent-500 group-hover:border-accent-500 transition-all duration-300">
                            <svg class="w-3.5 h-3.5 text-accent-400 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @if(!$loop->last)
                <div class="w-full h-px bg-white/5"></div>
            @endif
        </a>
    @empty
        <div class="text-center py-12 text-gray-500">More selected works coming soon.</div>
    @endforelse
</section>

<!-- Testimonials Section -->
<section class="py-24 bg-brand-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 20% 50%, #1A9E96 0%, transparent 50%), radial-gradient(circle at 80% 50%, #0E7C7B 0%, transparent 50%);"></div>
    <div class="container mx-auto px-6 xl:px-12 relative z-10" style="max-width:1536px">

        <div class="text-center mb-16 reveal">
            <p class="text-xs uppercase tracking-widest text-accent-400 font-bold mb-3">What Clients Say</p>
            <h2 class="text-4xl md:text-5xl font-display font-light"><span class="font-bold">Trusted</span> by Professionals Worldwide</h2>
        </div>

        <!-- 5-star header -->
        <div class="flex justify-center gap-1 mb-12 reveal">
            <svg class="w-5 h-5 text-accent-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg class="w-5 h-5 text-accent-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg class="w-5 h-5 text-accent-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg class="w-5 h-5 text-accent-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg class="w-5 h-5 text-accent-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <span class="text-gray-400 text-sm font-light ml-3 self-center">5.0 · Rated by our clients</span>
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
                 <div class="relative min-h-[340px] overflow-hidden">
                     <!-- Anthony -->
                     <div x-show="activeSlide === 0" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-x-8"
                          x-transition:enter-end="opacity-100 translate-x-0"
                          x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                          x-transition:leave-start="opacity-100 translate-x-0"
                          x-transition:leave-end="opacity-0 -translate-x-8"
                          class="bg-brand-950/60 border border-white/8 rounded-xl p-8 flex flex-col hover:border-accent-400/30 transition-colors duration-300 h-full">
                         <p class="text-gray-300 font-light leading-relaxed italic flex-1 mb-6 text-sm">"Space IQ is a one-of-a-kind studio. I have been so impressed with the quality of their work and their work ethic. They delivered my plans before schedule which helped me immensely. They were also extremely accurate and very patient and diligent. Will hire them again in a heartbeat!"</p>
                         <div class="w-8 h-px bg-accent-400/40 mb-4"></div>
                         <p class="text-white font-bold uppercase tracking-widest text-sm">Anthony</p>
                         <p class="text-accent-400 text-xs uppercase tracking-wider mt-1">Engineer</p>
                     </div>

                     <!-- Ryan -->
                     <div x-show="activeSlide === 1" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-x-8"
                          x-transition:enter-end="opacity-100 translate-x-0"
                          x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                          x-transition:leave-start="opacity-100 translate-x-0"
                          x-transition:leave-end="opacity-0 -translate-x-8"
                          class="bg-brand-950/60 border border-white/8 rounded-xl p-8 flex flex-col hover:border-accent-400/30 transition-colors duration-300 h-full"
                          style="display: none;">
                         <p class="text-gray-300 font-light leading-relaxed italic flex-1 mb-6 text-sm">"The 3D walkthrough animation Space IQ created for our luxury residential development was nothing short of outstanding. Our sales team used it at every presentation and it completely changed how buyers engaged with the project. Closed three units in the first week alone."</p>
                         <div class="w-8 h-px bg-accent-400/40 mb-4"></div>
                         <p class="text-white font-bold uppercase tracking-widest text-sm">Ryan</p>
                         <p class="text-accent-400 text-xs uppercase tracking-wider mt-1">Real Estate Developer</p>
                     </div>

                     <!-- Justin -->
                     <div x-show="activeSlide === 2" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-x-8"
                          x-transition:enter-end="opacity-100 translate-x-0"
                          x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                          x-transition:leave-start="opacity-100 translate-x-0"
                          x-transition:leave-end="opacity-0 -translate-x-8"
                          class="bg-brand-950/60 border border-white/8 rounded-xl p-8 flex flex-col hover:border-accent-400/30 transition-colors duration-300 h-full"
                          style="display: none;">
                         <p class="text-gray-300 font-light leading-relaxed italic flex-1 mb-6 text-sm">"We needed high-quality exterior renders for a commercial project under a very tight deadline. Space IQ delivered ahead of schedule with incredible attention to detail — lighting, materials, landscaping, everything was spot on. Our client was blown away. We will absolutely work with them again."</p>
                         <div class="w-8 h-px bg-accent-400/40 mb-4"></div>
                         <p class="text-white font-bold uppercase tracking-widest text-sm">Justin</p>
                         <p class="text-accent-400 text-xs uppercase tracking-wider mt-1">Project Manager</p>
                     </div>

                     <!-- Robert -->
                     <div x-show="activeSlide === 3" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-x-8"
                          x-transition:enter-end="opacity-100 translate-x-0"
                          x-transition:leave="transition ease-in duration-200 absolute inset-0 transform"
                          x-transition:leave-start="opacity-100 translate-x-0"
                          x-transition:leave-end="opacity-0 -translate-x-8"
                          class="bg-brand-950/60 border border-white/8 rounded-xl p-8 flex flex-col hover:border-accent-400/30 transition-colors duration-300 h-full"
                          style="display: none;">
                         <p class="text-gray-300 font-light leading-relaxed italic flex-1 mb-6 text-sm">"The 360° virtual tours Space IQ produced for our properties transformed our international sales process entirely. Buyers from the UK and UAE were able to walk through apartments remotely and make decisions with full confidence. It is a complete game-changer for off-plan sales."</p>
                         <div class="w-8 h-px bg-accent-400/40 mb-4"></div>
                         <p class="text-white font-bold uppercase tracking-widest text-sm">Robert</p>
                         <p class="text-accent-400 text-xs uppercase tracking-wider mt-1">Interior Designer</p>
                     </div>
                 </div>

                 <!-- Slider Navigation Controls for Mobile -->
                 <div class="flex justify-between items-center mt-6 px-2">
                     <button @click="prev()" class="w-9 h-9 rounded-full bg-brand-950/80 border border-white/10 text-white hover:text-accent-400 hover:scale-105 flex items-center justify-center transition-all cursor-pointer">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                     </button>
                     
                     <!-- Pagination Dots -->
                     <div class="flex gap-2">
                         <template x-for="idx in [0, 1, 2, 3]">
                             <button @click="activeSlide = idx" 
                                     class="w-2 h-2 rounded-full transition-all focus:outline-none"
                                     :class="activeSlide === idx ? 'bg-accent-400 w-5' : 'bg-white/30'"></button>
                         </template>
                     </div>
                     
                     <button @click="next()" class="w-9 h-9 rounded-full bg-brand-950/80 border border-white/10 text-white hover:text-accent-400 hover:scale-105 flex items-center justify-center transition-all cursor-pointer">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                     </button>
                 </div>
            </div>

            <!-- Desktop Grid View (Visible on tablet/desktop) -->
            <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Anthony -->
                <div class="reveal bg-brand-950/60 border border-white/8 rounded-xl p-8 flex flex-col hover:border-accent-400/30 transition-colors duration-300">
                    <p class="text-gray-300 font-light leading-relaxed italic flex-1 mb-6">"Space IQ is a one-of-a-kind studio. I have been so impressed with the quality of their work and their work ethic. They delivered my plans before schedule which helped me immensely. They were also extremely accurate and very patient and diligent. Will hire them again in a heartbeat!"</p>
                    <div class="w-8 h-px bg-accent-400/40 mb-4"></div>
                    <p class="text-white font-bold uppercase tracking-widest text-sm">Anthony</p>
                    <p class="text-accent-400 text-xs uppercase tracking-wider mt-1">Engineer</p>
                </div>

                <!-- Ryan -->
                <div class="reveal bg-brand-950/60 border border-white/8 rounded-xl p-8 flex flex-col hover:border-accent-400/30 transition-colors duration-300" style="transition-delay:0.1s">
                    <p class="text-gray-300 font-light leading-relaxed italic flex-1 mb-6">"The 3D walkthrough animation Space IQ created for our luxury residential development was nothing short of outstanding. Our sales team used it at every presentation and it completely changed how buyers engaged with the project. Closed three units in the first week alone."</p>
                    <div class="w-8 h-px bg-accent-400/40 mb-4"></div>
                    <p class="text-white font-bold uppercase tracking-widest text-sm">Ryan</p>
                    <p class="text-accent-400 text-xs uppercase tracking-wider mt-1">Real Estate Developer</p>
                </div>

                <!-- Justin -->
                <div class="reveal bg-brand-950/60 border border-white/8 rounded-xl p-8 flex flex-col hover:border-accent-400/30 transition-colors duration-300" style="transition-delay:0.2s">
                    <p class="text-gray-300 font-light leading-relaxed italic flex-1 mb-6">"We needed high-quality exterior renders for a commercial project under a very tight deadline. Space IQ delivered ahead of schedule with incredible attention to detail — lighting, materials, landscaping, everything was spot on. Our client was blown away. We will absolutely work with them again."</p>
                    <div class="w-8 h-px bg-accent-400/40 mb-4"></div>
                    <p class="text-white font-bold uppercase tracking-widest text-sm">Justin</p>
                    <p class="text-accent-400 text-xs uppercase tracking-wider mt-1">Project Manager</p>
                </div>

                <!-- Robert -->
                <div class="reveal bg-brand-950/60 border border-white/8 rounded-xl p-8 flex flex-col hover:border-accent-400/30 transition-colors duration-300" style="transition-delay:0.3s">
                    <p class="text-gray-300 font-light leading-relaxed italic flex-1 mb-6">"The 360° virtual tours Space IQ produced for our properties transformed our international sales process entirely. Buyers from the UK and UAE were able to walk through apartments remotely and make decisions with full confidence. It is a complete game-changer for off-plan sales."</p>
                    <div class="w-8 h-px bg-accent-400/40 mb-4"></div>
                    <p class="text-white font-bold uppercase tracking-widest text-sm">Robert</p>
                    <p class="text-accent-400 text-xs uppercase tracking-wider mt-1">Interior Designer</p>
                </div>
            </div>

        </div>
    </div>

<!-- About & Value Proposition -->
<section id="process" class="py-32 bg-brand-950 relative reveal">
    <div class="container mx-auto px-6 xl:px-12" style="max-width:1536px">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
            <!-- Left: Text -->
            <div class="reveal-left">
                <h2 class="text-3xl md:text-5xl font-display font-bold mb-6 text-white uppercase tracking-wide leading-tight">More than just <br><span class="text-accent-400">Drawings &amp; Renders.</span></h2>
                <p class="text-gray-300 text-lg mb-6 font-light leading-relaxed">
                    We don't just create drawings or renders — we take ownership of your project and solve problems. From concept to construction-ready drawings and stunning photorealistic visuals, everything is handled by our expert team.
                </p>
                <p class="text-gray-400 text-md mb-8 font-light leading-relaxed">
                    Whether you have a rough sketch, a PDF, or existing plans, we turn them into permit-ready drawings and high-end visuals that are clear, buildable, and presentation-ready.
                </p>
                <div class="inline-block px-4 py-2 border border-accent-400/30 bg-accent-400/5 rounded-sm">
                    <p class="text-accent-400 font-medium text-sm tracking-wide">👉 Our goal is simple: Once you partner with us, you shouldn't need to look for anyone else again.</p>
                </div>
            </div>

            <!-- Right: Visual Process Timeline -->
            <div class="reveal-right">
                <p class="text-xs uppercase tracking-widest text-accent-400 font-bold mb-8">Our Process</p>
                <div class="relative">
                    <!-- Vertical Line -->
                    <div class="absolute left-5 top-0 bottom-0 w-px bg-gradient-to-b from-accent-400/60 via-accent-400/20 to-transparent"></div>
                     <div class="space-y-8">
                         <!-- Step 1 -->
                         <div class="flex gap-6 items-start">
                             <div class="timeline-step-circle flex-shrink-0 w-10 h-10 rounded-full bg-brand-800 border border-accent-400/20 flex items-center justify-center z-10 relative font-bold text-accent-400/50 text-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg></div>
                             <div class="pt-1.5">
                                 <h4 class="text-white font-bold text-lg mb-1">Share Your Files</h4>
                                 <p class="text-gray-400 text-sm font-light leading-relaxed">Send us your sketches, PDFs, CAD files, or even a rough napkin drawing. We accept all formats.</p>
                             </div>
                         </div>
                         <!-- Step 2 -->
                         <div class="flex gap-6 items-start">
                             <div class="timeline-step-circle flex-shrink-0 w-10 h-10 rounded-full bg-brand-800 border border-accent-400/20 flex items-center justify-center z-10 relative font-bold text-accent-400/50 text-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                             <div class="pt-1.5">
                                 <h4 class="text-white font-bold text-lg mb-1">We Plan &amp; Confirm</h4>
                                 <p class="text-gray-400 text-sm font-light leading-relaxed">Our team reviews your brief, asks the right questions, and confirms scope, timeline, and deliverables.</p>
                             </div>
                         </div>
                         <!-- Step 3 -->
                         <div class="flex gap-6 items-start">
                             <div class="timeline-step-circle flex-shrink-0 w-10 h-10 rounded-full bg-brand-800 border border-accent-400/20 flex items-center justify-center z-10 relative font-bold text-accent-400/50 text-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg></div>
                             <div class="pt-1.5">
                                 <h4 class="text-white font-bold text-lg mb-1">First Draft Delivery</h4>
                                 <p class="text-gray-400 text-sm font-light leading-relaxed">We deliver an initial draft for your review. You give feedback and we refine until it's perfect.</p>
                             </div>
                         </div>
                         <!-- Step 4 -->
                         <div class="flex gap-6 items-start">
                             <div class="timeline-step-circle flex-shrink-0 w-10 h-10 rounded-full bg-brand-800 border border-accent-400/20 flex items-center justify-center z-10 relative font-bold text-accent-400/50 text-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                             <div class="pt-1.5">
                                 <h4 class="text-white font-bold text-lg mb-1">Final Delivery</h4>
                                 <p class="text-gray-400 text-sm font-light leading-relaxed">High-resolution final files delivered in your preferred format — ready for marketing, pitches, and permits.</p>
                             </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section id="contact" class="py-32 relative bg-brand-950 overflow-hidden reveal">
    <div class="absolute inset-0 z-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('img/interior_render.webp') }}');"></div>
    <div class="container mx-auto px-6 max-w-4xl text-center relative z-10 bg-brand-900/80 backdrop-blur-md p-16 md:p-24 rounded-sm border border-white/10 shadow-2xl">
        <p class="text-xs uppercase tracking-widest text-accent-400 font-bold mb-6">Love What You See?</p>
        <h2 class="text-4xl md:text-5xl font-display font-bold mb-8 text-white uppercase tracking-wider">Ready to make your<br>vision a reality?</h2>
        <p class="text-gray-300 text-lg font-light mb-12 max-w-2xl mx-auto">Let's work together to bring your architectural project to life with stunning hyper-realistic renders.</p>
        <a href="{{ route('contact') }}" class="btn-glow inline-block px-12 py-5 bg-accent-500 hover:bg-accent-400 text-brand-950 font-bold uppercase tracking-widest text-sm transition-colors duration-300 shadow-xl">
            Book a Consultation
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
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
