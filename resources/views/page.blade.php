@extends('layouts.app')

@section('title', $page->title . ' - Space IQ Design Studio')
@section('meta_description', $page->meta_description ?? 'View our ' . strtolower($page->title) . '.')

@section('content')

<!-- Header Section -->
<section class="relative pt-32 pb-16 lg:pt-48 lg:pb-24 overflow-hidden border-b border-white/5 bg-brand-950">
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-brand-900 to-brand-950 opacity-80"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-display font-bold tracking-tight mb-6 text-white uppercase">
            {{ $page->title }}
        </h1>
        
        <p class="text-xl text-gray-400 leading-relaxed font-light max-w-2xl mx-auto">
            {{ $page->meta_description ?? 'Updated recently' }}
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-20 relative bg-brand-950 min-h-[50vh]">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="glass-card rounded-xl p-8 md:p-16 border border-white/10 bg-brand-900/50">
            <div class="rich-text">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>

@endsection
