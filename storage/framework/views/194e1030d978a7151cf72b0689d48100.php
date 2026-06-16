<?php $__env->startSection('title', $service->title . ' - Space IQ'); ?>
<?php $__env->startSection('meta_description', $service->short_description); ?>
<?php $__env->startSection('og_image', $service->og_image ?? asset('img/social-share.png')); ?>

<?php if($service->slug === '360-views'): ?>
<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/pannellum.css')); ?>"/>
    <script src="<?php echo e(asset('js/pannellum.js')); ?>"></script>
    <style>
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
    </style>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>

<?php
    $isExterior = $service->slug === 'exterior-renders';
    $isInterior = $service->slug === 'interior-renders';
    $isFloorPlans = $service->slug === 'floor-plans';
    $hasSubcategories = $isExterior || $isInterior || $isFloorPlans;
    $currentSub = $hasSubcategories ? strtolower($subcategory ?? ($isFloorPlans ? 'b-w' : 'residential')) : null;
    $subLabels = $isExterior
        ? ['residential' => 'Residential', 'commercial' => 'Commercial', 'aerial' => 'Aerial', 'landscape' => 'Landscape']
        : ($isInterior 
            ? ['residential' => 'Residential', 'commercial' => 'Commercial'] 
            : ($isFloorPlans 
                ? ['b-w' => 'B&W', 'color' => 'Color', 'site-plan' => 'Site Plan'] 
                : []));
    $serviceLabel = $isExterior ? 'Exterior Renders' : ($isInterior ? 'Interior Renders' : ($isFloorPlans ? 'Floor Plans' : ''));
    $currentLabel = $hasSubcategories ? ($subLabels[$currentSub] ?? ($isFloorPlans ? 'B&W' : 'Residential')) : $service->title;

    // Early Grouping for Lightbox Index Navigation
    if ($service->media->count() > 0) {
        if ($hasSubcategories) {
            $groupedMedia = $service->media->groupBy('category');
            $groupedMedia = $groupedMedia->filter(function($media, $category) use ($currentSub) {
                $slug = str_replace(' ', '-', strtolower($category));
                if ($slug === 'b&w' || $slug === 'b-w' || $slug === 'bw') {
                    return $currentSub === 'b-w' || $currentSub === 'bw';
                }
                $slug = str_replace('-views', '', $slug);
                return $slug === $currentSub;
            });
        } else {
            $groupedMedia = collect(['All' => $service->media]);
        }

        $lightboxImagesCollect = collect();
        foreach($groupedMedia as $category => $categoryMedia) {
            foreach($categoryMedia->sortBy('sort_order') as $media) {
                if ($media->file_type !== 'video' && $service->slug !== '360-views') {
                    $lightboxImagesCollect->push([
                        'url' => parse_url(Storage::url($media->file_path), PHP_URL_PATH),
                        'title' => $media->title ?? ''
                    ]);
                }
            }
        }
    } else {
        $groupedMedia = collect();
        $lightboxImagesCollect = collect();
    }
?>

<div x-data="{ 
    lightboxOpen: false, 
    lightboxUrl: '', 
    lightboxTitle: '',
    lightboxIndex: 0,
    lightboxImages: <?php echo e(json_encode($lightboxImagesCollect->values()->toArray())); ?>,
    is360: <?php echo e($service->slug === '360-views' ? 'true' : 'false'); ?>,
    pannellumViewer: null,
    prevImage() {
        if (this.lightboxImages.length === 0) return;
        this.lightboxIndex = (this.lightboxIndex - 1 + this.lightboxImages.length) % this.lightboxImages.length;
        this.lightboxUrl = this.lightboxImages[this.lightboxIndex].url;
        this.lightboxTitle = this.lightboxImages[this.lightboxIndex].title;
    },
    nextImage() {
        if (this.lightboxImages.length === 0) return;
        this.lightboxIndex = (this.lightboxIndex + 1) % this.lightboxImages.length;
        this.lightboxUrl = this.lightboxImages[this.lightboxIndex].url;
        this.lightboxTitle = this.lightboxImages[this.lightboxIndex].title;
    },
    initPannellum(url) {
        if (!this.is360) return;
        this.$nextTick(() => {
            if (this.pannellumViewer) {
                try { this.pannellumViewer.destroy(); } catch(e) {}
            }
            this.pannellumViewer = pannellum.viewer('panorama-viewer', {
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
        });
    },
    closeLightbox() {
        this.lightboxOpen = false;
        if (this.pannellumViewer) {
            try { this.pannellumViewer.destroy(); } catch(e) {}
            this.pannellumViewer = null;
        }
    }
}">

<!-- ── HERO ── -->
<section class="relative flex flex-col justify-start overflow-hidden bg-brand-950 pb-0">

    
    <?php $heroMedia = $service->media->sortBy('sort_order')->first(); ?>
    <?php if($heroMedia && $heroMedia->file_type !== 'video'): ?>
    <div class="absolute inset-0 z-0" style="background-image:url('<?php echo e(parse_url(Storage::url($heroMedia->file_path), PHP_URL_PATH)); ?>');background-size:cover;background-position:center;filter:blur(8px) brightness(0.18);transform:scale(1.05);"></div>
    <?php else: ?>
    
    <div class="absolute inset-0 bg-gradient-to-br from-brand-950 via-brand-900 to-[#0b2020]"></div>
    <?php endif; ?>

    
    <div class="absolute inset-0 bg-brand-950/70 z-0"></div>

    
    <div class="absolute inset-0 opacity-[0.035]"
         style="background-image:linear-gradient(rgba(58,173,170,1) 1px,transparent 1px),linear-gradient(90deg,rgba(58,173,170,1) 1px,transparent 1px);background-size:64px 64px;"></div>

    
    <div class="absolute -top-40 -left-40 w-[700px] h-[700px] rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(58,173,170,0.12) 0%,transparent 70%);"></div>
    <div class="absolute -bottom-32 right-[-5%] w-[600px] h-[600px] rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(26,158,150,0.09) 0%,transparent 70%);"></div>
    <div class="absolute top-[30%] right-[20%] w-[300px] h-[300px] rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(58,173,170,0.06) 0%,transparent 70%);"></div>

    
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-[12%] w-px h-full"
             style="background:linear-gradient(to bottom,transparent 0%,rgba(58,173,170,0.18) 40%,transparent 100%);transform:skewX(-18deg);"></div>
        <div class="absolute top-0 left-[38%] w-px h-full"
             style="background:linear-gradient(to bottom,transparent 0%,rgba(58,173,170,0.08) 55%,transparent 100%);transform:skewX(-18deg);"></div>
        <div class="absolute top-0 right-[18%] w-px h-full"
             style="background:linear-gradient(to bottom,transparent 0%,rgba(26,158,150,0.15) 45%,transparent 100%);transform:skewX(-18deg);"></div>
        <div class="absolute top-0 right-[42%] w-px h-full"
             style="background:linear-gradient(to bottom,transparent 0%,rgba(58,173,170,0.06) 35%,transparent 100%);transform:skewX(-18deg);"></div>
    </div>

    
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <?php $__currentLoopData = [['3%','8%',3,0],['17%','62%',2,1.2],['33%','25%',4,0.6],['50%','80%',2,2],['65%','15%',3,0.3],['78%','50%',2,1.8],['88%','35%',4,0.9],['92%','75%',3,1.5],['45%','55%',2,2.4],['25%','90%',3,0.7],['70%','88%',2,1.1],['55%','40%',4,1.9]]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$t,$l,$s,$delay]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="absolute rounded-full bg-accent-400 animate-pulse"
             style="top:<?php echo e($t); ?>;left:<?php echo e($l); ?>;width:<?php echo e($s); ?>px;height:<?php echo e($s); ?>px;opacity:0.18;animation-delay:<?php echo e($delay); ?>s;animation-duration:4s;"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="relative z-10 container mx-auto px-6 pt-20 lg:pt-24">
        <a href="<?php echo e(route('home')); ?>#services"
           class="inline-flex items-center gap-2 text-white/40 hover:text-accent-300 transition-all duration-300 text-xs font-bold tracking-[0.2em] uppercase group">
            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            All Services
        </a>
    </div>

    
    <div class="relative z-10 container mx-auto px-6 mt-8 pb-0">

        
        <div class="flex items-center gap-4 mb-4">
            <div class="h-px w-12 bg-gradient-to-r from-accent-400 to-transparent"></div>
            <span class="text-accent-400 text-[10px] font-black tracking-[0.35em] uppercase">Space IQ Design Studio</span>
            <div class="h-px flex-1 bg-gradient-to-r from-accent-400/20 to-transparent max-w-[120px]"></div>
        </div>

        
        <h1 class="font-black text-white leading-[0.88] tracking-tight mb-5"
            style="font-size:clamp(3.2rem,8.5vw,8rem);text-transform:uppercase;">
            <?php if($hasSubcategories): ?>
                <span class="block text-white/25 font-bold mb-2"
                      style="font-size:clamp(0.75rem,1.8vw,1.2rem);letter-spacing:0.35em;"><?php echo e($serviceLabel); ?></span>
                <span class="block"
                      style="background:linear-gradient(130deg,#ffffff 0%,#7EC8C0 45%,#1A9E96 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    <?php echo e($currentLabel); ?>

                </span>
            <?php else: ?>
                <span class="block"
                      style="background:linear-gradient(130deg,#ffffff 0%,#7EC8C0 45%,#1A9E96 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    <?php echo e($service->title); ?>

                </span>
            <?php endif; ?>
        </h1>

        
        <p class="text-gray-500 text-base md:text-lg font-light leading-relaxed max-w-xl mb-10">
            <?php echo e($service->short_description); ?>

        </p>
    </div>

    
    <?php if($hasSubcategories): ?>
    <div class="relative z-10 border-t border-white/[0.07]">
        <div class="container mx-auto px-6">
            <nav class="flex items-stretch overflow-x-auto" style="scrollbar-width:none;">
                <?php $__currentLoopData = $subLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $active = ($currentSub === $key); ?>
                <a href="<?php echo e(route('service.show', ['slug' => $service->slug, 'subcategory' => $key])); ?>"
                   class="relative flex-shrink-0 px-8 py-5 text-xs font-black tracking-[0.22em] uppercase transition-all duration-300 focus:outline-none whitespace-nowrap
                          <?php echo e($active ? 'text-accent-300' : 'text-white/35 hover:text-white/70'); ?>">
                    <?php echo e($label); ?>

                    <?php if($active): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] rounded-full"
                          style="background:linear-gradient(90deg,transparent 0%,#3AADAA 30%,#3AADAA 70%,transparent 100%);"></span>
                    <span class="absolute inset-0 pointer-events-none"
                          style="background:linear-gradient(to top,rgba(58,173,170,0.06),transparent);"></span>
                    <?php endif; ?>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
        </div>
    </div>
    <?php else: ?>
    <div class="h-8 relative z-10"></div>
    <?php endif; ?>

</section>

<!-- Content Section -->
<section class="py-20 relative">
    <?php if($service->media->count() > 0): ?>
        <div class="w-full px-6 md:px-12 mt-4 mb-24">
            <?php $__currentLoopData = $groupedMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $categoryMedia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <?php
                        $is360 = $service->slug === '360-views';
                        $numCols = 3;
                        $gridColsClass = 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4';
                    ?>
                    <div class="grid <?php echo e($gridColsClass); ?> items-start w-full mb-16 pt-8">
                    <?php
                        $columns = [[], [], []];
                        $index = 0;
                        foreach($categoryMedia->sortBy('sort_order') as $media) {
                            $columns[$index % 3][] = $media;
                            $index++;
                        }
                    ?>
                    
                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colIndex => $columnMedia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $staggerClass = match($colIndex) {
                                1 => 'md:mt-12',
                                2 => 'lg:mt-24',
                                default => ''
                            };
                            $spaceClass = $is360 ? 'space-y-6' : 'space-y-4';
                        ?>
                        <div class="<?php echo e($spaceClass); ?> w-full <?php echo e($staggerClass); ?>">
                            <?php $__currentLoopData = $columnMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->slug === '360-views'): ?>
                                    
                                    <div class="relative rounded-xl overflow-hidden border border-white/10 shadow-2xl bg-brand-950 w-full"
                                         x-data="{
                                            viewer: null,
                                            hintVisible: true,
                                            rotateTimer: null,
                                            init() {
                                                this.$nextTick(() => {
                                                    this.viewer = pannellum.viewer(this.$refs.panoEl, {
                                                        type: 'equirectangular',
                                                        panorama: '<?php echo e(parse_url(Storage::url($media->file_path), PHP_URL_PATH)); ?>',
                                                        autoLoad: true,
                                                        compass: false,
                                                        autoRotate: 0,
                                                        mouseZoom: false,
                                                        keyboardZoom: false,
                                                        showZoomCtrl: false,
                                                        showFullscreenCtrl: false,
                                                        showControls: false,
                                                        friction: 0.15
                                                    });
                                                    /* Start manual rotation immediately */
                                                    this.rotateTimer = setInterval(() => {
                                                        if (this.viewer) {
                                                            this.viewer.setYaw(this.viewer.getYaw() - 0.04);
                                                        }
                                                    }, 30);
                                                    /* Stop rotation on first user interaction */
                                                    const stopRotate = () => {
                                                        if (this.rotateTimer) {
                                                            clearInterval(this.rotateTimer);
                                                            this.rotateTimer = null;
                                                        }
                                                        this.hintVisible = false;
                                                    };
                                                    this.$refs.panoEl.addEventListener('mousedown', stopRotate, { once: true });
                                                    this.$refs.panoEl.addEventListener('touchstart', stopRotate, { once: true });
                                                });
                                            },
                                            goFullscreen() {
                                                if (this.viewer) this.viewer.toggleFullscreen();
                                            }
                                         }"
                                         x-init="init()">

                                        
                                        <div x-ref="panoEl"
                                             class="w-full"
                                             style="height: 480px; touch-action: none;"></div>

                                        
                                        <div class="absolute bottom-3 left-0 right-0 z-20 flex justify-center pointer-events-none transition-opacity duration-500"
                                             :class="hintVisible ? 'opacity-100' : 'opacity-0'">
                                            <span class="text-[10px] text-white/55 tracking-widest font-medium uppercase bg-brand-950/40 backdrop-blur-sm rounded-full px-3 py-1">Click to explore</span>
                                        </div>

                                        
                                        <div class="absolute top-0 left-0 right-0 z-30 flex items-center justify-between px-4 py-2.5 bg-gradient-to-b from-brand-950/70 to-transparent pointer-events-none">
                                            <div class="flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-accent-400 animate-pulse"></div>
                                                <?php if($media->title): ?>
                                                <span class="text-[10px] text-white/70 uppercase tracking-widest font-bold"><?php echo e($media->title); ?></span>
                                                <?php else: ?>
                                                <span class="text-[10px] text-white/50 uppercase tracking-widest font-semibold">360° Virtual Tour</span>
                                                <?php endif; ?>
                                            </div>
                                            <button class="pointer-events-auto w-7 h-7 rounded-md bg-brand-950/60 border border-white/10 hover:border-accent-400/50 flex items-center justify-center text-white/40 hover:text-white transition-all duration-200"
                                                    title="Fullscreen"
                                                    @click="goFullscreen()">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                            </button>
                                        </div>

                                    </div>




                                <?php else: ?>
                                    <?php
                                        $isTallImage = false;
                                        if ($media->file_type !== 'video') {
                                            $filePath = public_path(parse_url(Storage::url($media->file_path), PHP_URL_PATH));
                                            if (file_exists($filePath)) {
                                                $size = @getimagesize($filePath);
                                                if ($size && $size[0] > 0) {
                                                    $ratio = $size[1] / $size[0];
                                                    if ($ratio > 1.8) {
                                                        $isTallImage = true;
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                    <?php
                                         $mediaUrl = parse_url(Storage::url($media->file_path), PHP_URL_PATH);
                                         $mediaIndex = $lightboxImagesCollect->values()->filter(fn($x) => $x['url'] === $mediaUrl)->keys()->first() ?? 0;
                                     ?>
                                     <div class="relative group overflow-hidden rounded-md shadow-xl tilt-card <?php echo e($isTallImage ? 'max-w-[60%] md:max-w-[50%] mx-auto' : 'w-full'); ?>" 
                                          <?php if($media->file_type !== 'video'): ?> 
                                             @click="lightboxOpen = true; lightboxIndex = <?php echo e($mediaIndex); ?>; lightboxUrl = '<?php echo e($mediaUrl); ?>'; lightboxTitle = '<?php echo e($media->title); ?>'; initPannellum('<?php echo e($mediaUrl); ?>')" 
                                          <?php endif; ?>>
                                        <?php if($media->file_type === 'video'): ?>
                                            <?php
                                                $isYoutube = false;
                                                $youtubeId = '';
                                                if (str_contains($media->file_path, 'youtube.com') || str_contains($media->file_path, 'youtu.be')) {
                                                    $isYoutube = true;
                                                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|watch\?v=|v=)|youtu\.be/)([^"&?/ ]{11})%i', $media->file_path, $match)) {
                                                        $youtubeId = $match[1];
                                                    }
                                                }
                                            ?>
                                            <?php if($isYoutube): ?>
                                                <div class="relative w-full aspect-video overflow-hidden rounded-md shadow-xl bg-brand-900/50">
                                                    <iframe src="https://www.youtube.com/embed/<?php echo e($youtubeId); ?>?autoplay=0&controls=1&rel=0" 
                                                            class="absolute inset-0 w-full h-full" 
                                                            frameborder="0" 
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                                            allowfullscreen>
                                                    </iframe>
                                                </div>
                                            <?php else: ?>
                                                <video src="<?php echo e(Storage::url($media->file_path)); ?>" controls class="w-full h-auto block rounded-md shadow-xl"></video>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="cursor-pointer overflow-hidden bg-brand-900/50 relative"
                                                 x-data="{ imgLoaded: false }">
                                                <!-- Skeleton shimmer placeholder -->
                                                <div class="absolute inset-0 skeleton-shimmer z-0 min-h-[200px]" x-show="!imgLoaded"></div>
                                                <?php
                                                     $imgOrigUrl = parse_url(Storage::url($media->file_path), PHP_URL_PATH);
                                                     $imgWebpUrl = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $imgOrigUrl);
                                                     $imgWebpPath = public_path($imgWebpUrl);
                                                     $hasWebp = file_exists($imgWebpPath);
                                                 ?>
                                                 <picture>
                                                     <?php if($hasWebp): ?>
                                                     <source srcset="<?php echo e($imgWebpUrl); ?>" type="image/webp">
                                                     <?php endif; ?>
                                                     <img src="<?php echo e($imgOrigUrl); ?>"
                                                          alt="<?php echo e($media->title); ?>"
                                                          loading="lazy"
                                                          decoding="async"
                                                          @load="imgLoaded = true"
                                                          class="w-full h-auto block transition-transform duration-700 group-hover:scale-110 grayscale-[10%] group-hover:grayscale-0 lazy-img relative z-10"
                                                          :class="imgLoaded ? 'loaded' : ''">
                                                 </picture>
                                                <!-- Hover caption overlay -->
                                                <?php if($media->title): ?>
                                                <div class="absolute bottom-0 left-0 right-0 z-20 translate-y-full group-hover:translate-y-0 transition-transform duration-400 ease-out pointer-events-none"
                                                     style="background:linear-gradient(to top, rgba(8,14,14,0.92) 0%, transparent 100%); padding: 20px 16px 14px;">
                                                    <p class="text-white text-xs font-semibold uppercase tracking-widest"><?php echo e($media->title); ?></p>
                                                </div>
                                                <?php endif; ?>
                                                <!-- Zoom icon -->
                                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-end p-3 pointer-events-none z-20">
                                                    <div class="bg-brand-900/80 backdrop-blur-sm p-2.5 rounded-full">
                                                        <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- Lightbox Modal -->
            <template x-teleport="body">
                <div x-show="lightboxOpen" 
                     class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-brand-950/98 p-4 md:p-8 backdrop-blur-md" 
                     x-transition.opacity 
                     style="display: none;"
                     @keydown.escape.window="closeLightbox()"
                     @keydown.left.window="if(!is360) prevImage()"
                     @keydown.right.window="if(!is360) nextImage()">
                    
                    <!-- Close Button -->
                    <button @click="closeLightbox()" class="absolute top-4 right-4 md:top-8 md:right-8 text-white/70 hover:text-white transition-colors z-[110] bg-black/50 rounded-full p-3 border border-white/10 hover:bg-black/80 hover:scale-110 transform duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    
                    <!-- 360 Viewer Container -->
                    <template x-if="is360">
                        <div class="w-full h-full max-w-6xl max-h-[80vh] md:max-h-[85vh] rounded-md overflow-hidden border border-white/10 shadow-2xl relative z-[105] bg-brand-950" @click.away="closeLightbox()">
                            <div id="panorama-viewer" class="w-full h-full"></div>
                        </div>
                    </template>
                    
                    <!-- Standard Image Container with Nav Buttons -->
                    <template x-if="!is360">
                        <div class="relative max-w-full max-h-[85vh] flex items-center justify-center z-[105]" @click.away="closeLightbox()">
                            <!-- Left Arrow -->
                            <button type="button" x-show="lightboxImages.length > 1" @click.stop="prevImage()" class="absolute left-4 md:-left-20 text-white/70 hover:text-white transition-all bg-black/50 hover:bg-black/80 rounded-full p-3 border border-white/10 hover:scale-110 transform z-[115] cursor-pointer">
                                <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            
                            <img :src="lightboxUrl" class="max-w-full max-h-[80vh] rounded-sm shadow-2xl object-contain">
                            
                            <!-- Right Arrow -->
                            <button type="button" x-show="lightboxImages.length > 1" @click.stop="nextImage()" class="absolute right-4 md:-right-20 text-white/70 hover:text-white transition-all bg-black/50 hover:bg-black/80 rounded-full p-3 border border-white/10 hover:scale-110 transform z-[115] cursor-pointer">
                                <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </template>

                    <!-- Title Caption -->
                    <div class="mt-4 text-center z-[110]" x-show="lightboxTitle">
                        <h3 class="text-white text-xs font-semibold tracking-widest uppercase bg-brand-900/60 border border-white/5 px-4 py-2 rounded shadow-sm inline-block" x-text="lightboxTitle"></h3>
                    </div>
                </div>
            </template>
        </div>
    <?php else: ?>
        <!-- Empty Placeholder -->
        <div class="container mx-auto px-6 max-w-xl text-center py-20">
            <div class="glass-card rounded-xl border border-white/8 bg-brand-900/50 p-8 md:p-12 shadow-2xl relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-36 h-36 bg-accent-500/10 rounded-full blur-2xl"></div>
                <div class="w-16 h-16 rounded-full bg-accent-500/10 border border-accent-400/20 flex items-center justify-center mx-auto mb-6 relative">
                    <svg class="w-8 h-8 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 21m0 0l-.813-5.096L9 21zm0 0l6.6-6.6a2.25 2.25 0 00-3.182-3.182L9 14.25v1.65H7.35l-2.435 2.435M9 21h.008V21.008H9V21z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-display font-bold text-white mb-3 uppercase tracking-wide">Bespoke Design Samples</h3>
                <p class="text-gray-300 max-w-md mx-auto font-light text-sm leading-relaxed mb-8">
                    We construct layouts and renderings tailored to your exact specifications. If you have an upcoming project, contact us to receive custom, offline design samples.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="<?php echo e(route('contact')); ?>" class="btn-glow px-6 py-3.5 bg-accent-500 hover:bg-accent-400 text-white rounded-sm font-semibold uppercase tracking-wider text-xs transition-colors">
                        Request Samples
                    </a>
                    <a href="https://wa.me/918121376325?text=Hi%20Space%20IQ%20Design%20Studio%2C%20I%27d%20like%20to%20request%20some%20offline%20design%20samples%20for%20my%20project." target="_blank" rel="noopener noreferrer" class="px-6 py-3.5 border border-white/10 hover:border-white/30 text-white rounded-sm font-semibold uppercase tracking-wider text-xs transition-colors bg-white/2 backdrop-blur-sm flex items-center justify-center gap-2">
                        Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
</div>

<!-- Service Page Bottom CTA -->
<section class="py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #080e0e 0%, #0c1818 50%, #080e0e 100%);">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 30% 50%, #1A9E96 0%, transparent 50%);"></div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <p class="text-xs uppercase tracking-widest text-accent-400 font-bold mb-4">Ready to get started?</p>
        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">Love what you see?<br><span class="text-gradient">Let's work together.</span></h2>
        <p class="text-gray-400 font-light mb-10 max-w-xl mx-auto">Share your project details and our team will get back to you within 24 hours.</p>
        <a href="<?php echo e(route('contact')); ?>" class="inline-flex items-center gap-3 px-10 py-4 bg-accent-500 hover:bg-accent-400 text-white font-bold uppercase tracking-widest text-sm transition-all duration-300 shadow-xl hover:-translate-y-1">
            Start Your Project
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Sahil\.gemini\antigravity\scratch\spaceiq_studio\resources\views/service.blade.php ENDPATH**/ ?>