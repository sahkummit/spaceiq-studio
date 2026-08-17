#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

echo "================================================"
echo "Starting SpaceIQ Studio Optimization & Usability Patch"
echo "================================================"

# Create backups first
echo "Creating backups of original views..."
mkdir -p backups
cp resources/views/contact.blade.php backups/contact.blade.php.bak 2>/dev/null || true
cp resources/views/service.blade.php backups/service.blade.php.bak 2>/dev/null || true
cp resources/views/welcome.blade.php backups/welcome.blade.php.bak 2>/dev/null || true

# 1. Update contact.blade.php
echo "Applying optimized contact.blade.php (WebP Image Support)..."
cat << 'EOF' > resources/views/contact.blade.php
@extends('layouts.app')

@section('title', 'Contact Us - Space IQ')
@section('meta_description', 'Get in touch with Space IQ to start your digital project.')

@section('content')
<!-- Header Section -->
<section class="relative pt-32 pb-16 lg:pt-48 lg:pb-24 overflow-hidden border-b border-white/5 bg-brand-950">
    <!-- Blurred background image for visual richness -->
    <div class="absolute inset-0 z-0" style="background-image:url('{{ webp_asset('img/exterior_render.png') }}');background-size:cover;background-position:center;filter:blur(6px) brightness(0.15);transform:scale(1.05);"></div>
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-brand-950/60 via-brand-900/70 to-brand-950"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-display font-bold tracking-tight mb-6 text-white uppercase">
            Let's Start a <span class="text-gradient">Conversation</span>
        </h1>
        <p class="text-xl text-gray-400 leading-relaxed font-light max-w-2xl mx-auto">
            Ready to bring your project to life? Fill out the form below and our team will get back to you within 24 hours.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-24 relative bg-brand-950">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- Contact Info Sidebar -->
            <div class="lg:w-1/3">
                <div class="glass-card rounded-xl p-8 border border-white/10 bg-brand-900/50">
                    <h3 class="text-2xl font-display font-bold text-white mb-8 uppercase">Reach Out Directly</h3>
                    
                    @php $settings = \App\Models\Setting::pluck('value', 'key'); @endphp
                    
                    <div class="space-y-8">
                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <div class="p-2.5 bg-brand-800/50 rounded-sm border border-white/5 mt-1">
                                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-accent-400 uppercase tracking-widest mb-1">Email</h4>
                                <p class="text-gray-300 font-light text-lg">
                                    <a href="mailto:{{ $settings['contact_email'] ?? 'spaceiqstudio@gmail.com' }}" class="hover:text-white transition-colors">
                                        {{ $settings['contact_email'] ?? 'spaceiqstudio@gmail.com' }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- Phone -->
                        <div class="flex items-start gap-4">
                            <div class="p-2.5 bg-brand-800/50 rounded-sm border border-white/5 mt-1">
                                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-accent-400 uppercase tracking-widest mb-1">Phone</h4>
                                <p class="text-gray-300 font-light text-lg">
                                    <a href="tel:{{ str_replace(' ', '', $settings['contact_phone'] ?? '+918121376325') }}" class="hover:text-white transition-colors">
                                        {{ $settings['contact_phone'] ?? '+91 81213 76325' }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="flex items-start gap-4">
                            <div class="p-2.5 bg-brand-800/50 rounded-sm border border-white/5 mt-1">
                                <svg class="w-5 h-5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-accent-400 uppercase tracking-widest mb-1">Studio Location</h4>
                                <p class="text-gray-300 font-light leading-relaxed text-lg">
                                    {!! nl2br(e($settings['office_address'] ?? 'Mohali, Punjab (India)')) !!}
                                </p>
                            </div>
                        </div>
                        <!-- Instagram -->
                        <div class="flex items-start gap-4">
                            <div class="p-2.5 bg-brand-800/50 rounded-sm border border-white/5 mt-1">
                                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-accent-400 uppercase tracking-widest mb-1">Instagram</h4>
                                <p class="text-gray-300 font-light text-lg">
                                    <a href="https://instagram.com/space_iq_" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">
                                        @space_iq_
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- Accepted file types -->
                        <div class="p-4 bg-accent-400/5 border border-accent-400/20 rounded-sm">
                            <p class="text-xs font-bold text-accent-400 uppercase tracking-widest mb-2">Accepted File Types</p>
                            <p class="text-gray-400 text-xs font-light leading-relaxed">
                                JPG, PNG, PDF, DWG, DXF, ZIP, DOC, XLS<br>
                                Up to 5 files &nbsp;·&nbsp; Max 20MB each
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:w-2/3">
                <div class="glass-card rounded-xl p-8 md:p-12 relative overflow-hidden border border-white/5 bg-black/20">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-accent-400/10 to-transparent rounded-bl-full pointer-events-none"></div>

                    <!-- Loading Overlay -->
                    <div x-show="submitting"
                         class="absolute inset-0 bg-brand-950/90 backdrop-blur-md z-[80] flex flex-col items-center justify-center text-center p-6"
                         x-transition.opacity
                         style="display: none;">
                        <div class="w-16 h-16 border-4 border-accent-400 border-t-transparent rounded-full animate-spin mb-4"></div>
                        <p class="text-white font-medium uppercase tracking-widest text-sm">Uploading project details...</p>
                        <p class="text-gray-400 text-xs mt-1">Please do not close this window</p>
                    </div>
                    
                    <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data"
                          class="space-y-6 relative z-10" id="inquiryForm"
                          x-data="{
                              files: [],
                              dragging: false,
                              maxFiles: 5,
                              errors: [],
                              submitting: false,
                              submitted: false,
                              formatSize(b) {
                                  if (b < 1024) return b + ' B';
                                  if (b < 1048576) return (b/1024).toFixed(1) + ' KB';
                                  return (b/1048576).toFixed(1) + ' MB';
                              },
                              getIcon(n) {
                                  const e = n.split('.').pop().toLowerCase();
                                  if (['jpg','jpeg','png'].includes(e)) return '🖼️';
                                  if (e==='pdf') return '📄';
                                  if (['dwg','dxf'].includes(e)) return '📐';
                                  if (['zip','rar'].includes(e)) return '🗜️';
                                  if (['doc','docx'].includes(e)) return '📝';
                                  if (['xls','xlsx'].includes(e)) return '📊';
                                  return '📎';
                              },
                              addFiles(list) {
                                  this.errors = [];
                                  const allowed = ['jpg','jpeg','png','pdf','dwg','dxf','zip','rar','doc','docx','xls','xlsx'];
                                  Array.from(list).forEach(f => {
                                      const ext = f.name.split('.').pop().toLowerCase();
                                      if (!allowed.includes(ext)) { this.errors.push(f.name + ': file type not allowed.'); return; }
                                      if (f.size > 20*1024*1024) { this.errors.push(f.name + ': exceeds 20MB limit.'); return; }
                                      if (this.files.length >= this.maxFiles) { this.errors.push('Maximum 5 files allowed.'); return; }
                                      if (!this.files.find(x => x.name===f.name && x.size===f.size)) this.files.push(f);
                                  });
                                  this.syncInput();
                              },
                              removeFile(i) { this.files.splice(i,1); this.syncInput(); },
                              syncInput() {
                                  const dt = new DataTransfer();
                                  this.files.forEach(f => dt.items.add(f));
                                  document.getElementById('attachmentsInput').files = dt.files;
                              },
                              handleDrop(e) { this.dragging=false; this.addFiles(e.dataTransfer.files); },
                              submitForm() {
                                  this.submitting = true;
                                  this.errors = [];
                                  
                                  const form = document.getElementById('inquiryForm');
                                  const formData = new FormData(form);
                                  
                                  fetch(form.action, {
                                      method: 'POST',
                                      body: formData,
                                      headers: {
                                          'X-Requested-With': 'XMLHttpRequest'
                                      }
                                  })
                                  .then(response => {
                                      if (response.ok || response.redirected) {
                                          return response.json().then(data => {
                                              this.submitting = false;
                                              this.submitted = true;
                                              this.files = [];
                                              form.reset();
                                          });
                                      } else {
                                          return response.json().then(data => {
                                              this.submitting = false;
                                              if (data.errors) {
                                                  this.errors = Object.values(data.errors).flat();
                                              } else {
                                                  this.errors = ['Validation failed. Please verify your entries.'];
                                              }
                                          });
                                      }
                                  })
                                  .catch(err => {
                                      this.submitting = false;
                                      this.errors = ['A network error occurred. Please try again.'];
                                  });
                              }
                          }"
                          @submit.prevent="submitForm()">
                        @csrf

                        @if(session('success'))
                            <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-6 font-light">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl mb-6 text-sm font-light">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Alpine AJAX validation errors -->
                        <div x-show="errors.length > 0" 
                             class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl mb-6 text-sm font-light"
                             style="display: none;">
                            <ul class="list-disc list-inside space-y-1">
                                <template x-for="(err, i) in errors" :key="i">
                                    <li x-text="err"></li>
                                </template>
                            </ul>
                        </div>

                        <!-- Name + Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-wide">Your Name <span class="text-accent-400">*</span></label>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-sm px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent-400 transition-colors font-light"
                                       placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-wide">Email Address <span class="text-accent-400">*</span></label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-sm px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent-400 transition-colors font-light"
                                       placeholder="john@example.com">
                            </div>
                        </div>

                        <!-- Phone + Service -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-wide">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-sm px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent-400 transition-colors font-light"
                                       placeholder="+91 98765 43210">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-wide">Service Needed</label>
                                <select name="service_id" class="w-full bg-brand-900 border border-white/10 rounded-sm px-4 py-3 text-white focus:outline-none focus:border-accent-400 transition-colors appearance-none font-light">
                                    <option value="">Select a service...</option>
                                    @php $groupedContactServices = \App\Models\Service::where('is_active', true)->orderBy('sort_order')->get()->groupBy('category'); @endphp
                                    @foreach($groupedContactServices as $category => $services)
                                        <optgroup label="{{ $category }}">
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-wide">Project Details <span class="text-accent-400">*</span></label>
                            <textarea name="message" rows="4" required
                                      class="w-full bg-white/5 border border-white/10 rounded-sm px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent-400 transition-colors font-light"
                                      placeholder="Tell us about your project goals, timelines, and requirements...">{{ old('message') }}</textarea>
                        </div>

                        <!-- ── File Upload ── -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-3 uppercase tracking-wide">
                                Attach Files
                                <span class="text-gray-500 normal-case tracking-normal font-light ml-1">(optional — drawings, sketches, references, PDFs)</span>
                            </label>

                            <!-- Hidden real input -->
                            <input type="file" id="attachmentsInput" name="attachments[]" multiple
                                   accept=".jpg,.jpeg,.png,.pdf,.dwg,.dxf,.zip,.rar,.doc,.docx,.xls,.xlsx"
                                   class="hidden"
                                   @change="addFiles($event.target.files)">

                            <!-- Drop Zone -->
                            <div class="relative border-2 border-dashed rounded-sm transition-all duration-300 cursor-pointer select-none"
                                 :class="dragging ? 'border-accent-400 bg-accent-400/10' : 'border-white/15 hover:border-accent-400/50 hover:bg-white/3'"
                                 @dragover.prevent="dragging = true"
                                 @dragleave.prevent="dragging = false"
                                 @drop.prevent="handleDrop($event)"
                                 @click="document.getElementById('attachmentsInput').click()">

                                <div class="flex flex-col items-center justify-center py-10 px-6 text-center pointer-events-none">
                                    <div class="w-14 h-14 rounded-full bg-accent-400/10 border border-accent-400/30 flex items-center justify-center mb-4 transition-all duration-300"
                                         :class="dragging ? 'scale-110 bg-accent-400/20' : ''">
                                        <svg class="w-6 h-6 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                    </div>
                                    <p class="text-white font-medium mb-1">
                                        <span x-show="!dragging">Drag &amp; drop files here, or <span class="text-accent-400 underline underline-offset-2">browse</span></span>
                                        <span x-show="dragging" class="text-accent-400 font-semibold">Release to upload</span>
                                    </p>
                                    <p class="text-gray-500 text-xs mt-1">JPG · PNG · PDF · DWG · DXF · ZIP · DOC · XLS &nbsp;·&nbsp; Up to 5 files &nbsp;·&nbsp; Max 20MB each</p>
                                </div>
                            </div>

                            <!-- Validation errors -->
                            <template x-if="errors.length > 0">
                                <div class="mt-3 space-y-1.5">
                                    <template x-for="(err, i) in errors" :key="i">
                                        <p class="text-red-400 text-xs flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <span x-text="err"></span>
                                        </p>
                                    </template>
                                </div>
                            </template>

                            <!-- Selected File List -->
                            <template x-if="files.length > 0">
                                <div class="mt-4 space-y-2">
                                    <p class="text-xs text-gray-500 uppercase tracking-widest font-medium"
                                       x-text="files.length + ' file' + (files.length > 1 ? 's' : '') + ' selected'"></p>

                                    <template x-for="(file, idx) in files" :key="idx">
                                        <div class="flex items-center gap-3 bg-brand-900/60 border border-white/8 rounded-sm px-4 py-3 group hover:border-white/20 transition-all"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 -translate-y-1"
                                             x-transition:enter-end="opacity-100 translate-y-0">
                                            <span class="text-xl flex-shrink-0" x-text="getIcon(file.name)"></span>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-white text-sm font-medium truncate" x-text="file.name"></p>
                                                <p class="text-gray-500 text-xs" x-text="formatSize(file.size)"></p>
                                            </div>
                                            <button type="button"
                                                    @click.stop="removeFile(idx)"
                                                    class="flex-shrink-0 w-7 h-7 rounded-full bg-white/5 hover:bg-red-500/20 border border-white/10 hover:border-red-500/40 text-gray-500 hover:text-red-400 flex items-center justify-center transition-all duration-200 cursor-pointer">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </div>
                                    </template>

                                    <!-- Add More -->
                                    <template x-if="files.length < maxFiles">
                                        <button type="button"
                                                @click="document.getElementById('attachmentsInput').click()"
                                                class="w-full py-2.5 border border-dashed border-white/10 hover:border-accent-400/40 text-gray-500 hover:text-accent-400 text-xs uppercase tracking-widest rounded-sm transition-all duration-200 cursor-pointer">
                                            + Add more &nbsp;<span class="opacity-60">(<span x-text="maxFiles - files.length"></span> remaining)</span>
                                        </button>
                                    </template>
                                </div>
                            </template>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                                class="w-full py-4 bg-accent-500 hover:bg-accent-400 rounded-sm font-bold text-white uppercase tracking-widest transition-colors duration-300 shadow-xl border-none">
                            Send Request
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Styled Dark Google Map Section -->
        <div class="mt-20 reveal">
            <div class="w-full h-[380px] rounded-sm overflow-hidden border border-white/10 shadow-2xl relative bg-[#0c1818]">
                <div class="absolute inset-0 border border-accent-400/20 pointer-events-none z-10 rounded-sm"></div>
                <iframe class="w-full h-full border-none filter invert-[0.9] hue-rotate-[180deg] brightness-[0.95] contrast-[0.9] grayscale" 
                        src="https://maps.google.com/maps?q=Mohali,%20Punjab,%20India&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                        allowfullscreen 
                        loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    <!-- Success Modal Overlay -->
    <template x-teleport="body">
        <div x-show="submitted"
             class="fixed inset-0 z-[120] flex items-center justify-center p-4 bg-brand-950/92 backdrop-blur-xl"
             x-transition.opacity
             style="display: none;"
             @keydown.escape.window="submitted = false">
            
            <div class="relative max-w-md w-full bg-brand-900 border border-white/10 rounded-sm p-8 md:p-10 shadow-2xl text-center"
                 @click.away="submitted = false"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-95 opacity-0"
                 x-transition:enter-end="scale-100 opacity-100">
                
                <!-- Checkmark Icon -->
                <div class="w-20 h-20 bg-accent-500/10 border-2 border-accent-400 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <svg class="w-10 h-10 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    <span class="absolute inset-0 rounded-full border border-accent-400 animate-ping opacity-30"></span>
                </div>
                
                <h3 class="text-2xl md:text-3xl font-display font-bold text-white mb-4 uppercase tracking-wider">Inquiry Sent</h3>
                <p class="text-gray-300 font-light leading-relaxed mb-8 text-sm md:text-base">
                    We have received your project files and requirements. The Space IQ team will review your scope and contact you via email or phone within 24 hours.
                </p>
                
                <button @click="submitted = false" 
                        class="w-full py-4 bg-accent-500 hover:bg-accent-400 text-white font-bold uppercase tracking-widest text-xs transition-colors duration-300 shadow-lg cursor-pointer border-none">
                    Back to Studio
                </button>
            </div>
        </div>
    </template>
</section>
@endsection
EOF

# 2. Update service.blade.php
echo "Applying optimized service.blade.php (WebP Image & 360 View support)..."
cat << 'EOF' > resources/views/service.blade.php
@extends('layouts.app')

@php
    $firstImage = $service->media->where('file_type', '!=', 'video')->sortBy('sort_order')->first();
    $firstImagePath = $firstImage ? parse_url(Storage::url($firstImage->file_path), PHP_URL_PATH) : null;
@endphp

@section('title', $service->title . ' - Space IQ')
@section('meta_description', $service->short_description)
@section('og_image', $service->og_image ?? ($firstImagePath ? asset(ltrim($firstImagePath, '/')) : asset('img/social-share.png')))

@if($service->slug === '360-views')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/pannellum.css') }}"/>
    <script src="{{ asset('js/pannellum.js') }}"></script>
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
@endsection
@endif

@section('content')

@php
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
                        'url' => webp_asset(parse_url(Storage::url($media->file_path), PHP_URL_PATH)),
                        'title' => $media->title ?? ''
                    ]);
                }
            }
        }
    } else {
        $groupedMedia = collect();
        $lightboxImagesCollect = collect();
    }
@endphp

<div x-data="{ 
    lightboxOpen: false, 
    lightboxUrl: '', 
    lightboxTitle: '',
    lightboxIndex: 0,
    lightboxImages: {{ json_encode($lightboxImagesCollect->values()->toArray()) }},
    is360: {{ $service->slug === '360-views' ? 'true' : 'false' }},
    pannellumViewer: null,
    touchStartX: 0,
    touchEndX: 0,
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

    {{-- First portfolio image as blurred hero background --}}
    @php $heroMedia = $service->media->sortBy('sort_order')->first(); @endphp
    @if($heroMedia && $heroMedia->file_type !== 'video')
    <div class="absolute inset-0 z-0" style="background-image:url('{{ webp_asset(parse_url(Storage::url($heroMedia->file_path), PHP_URL_PATH)) }}');background-size:cover;background-position:center;filter:blur(8px) brightness(0.18);transform:scale(1.05);"></div>
    @else
    {{-- Background gradient fallback --}}
    <div class="absolute inset-0 bg-gradient-to-br from-brand-950 via-brand-900 to-[#0b2020]"></div>
    @endif

    {{-- Always-on dark overlay to ensure text readability --}}
    <div class="absolute inset-0 bg-brand-950/70 z-0"></div>

    {{-- Subtle grid --}}
    <div class="absolute inset-0 opacity-[0.035]"
         style="background-image:linear-gradient(rgba(58,173,170,1) 1px,transparent 1px),linear-gradient(90deg,rgba(58,173,170,1) 1px,transparent 1px);background-size:64px 64px;"></div>

    {{-- Glow orbs --}}
    <div class="absolute -top-40 -left-40 w-[700px] h-[700px] rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(58,173,170,0.12) 0%,transparent 70%);"></div>
    <div class="absolute -bottom-32 right-[-5%] w-[600px] h-[600px] rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(26,158,150,0.09) 0%,transparent 70%);"></div>
    <div class="absolute top-[30%] right-[20%] w-[300px] h-[300px] rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(58,173,170,0.06) 0%,transparent 70%);"></div>

    {{-- Diagonal accent lines --}}
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

    {{-- Floating particles --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        @foreach([['3%','8%',3,0],['17%','62%',2,1.2],['33%','25%',4,0.6],['50%','80%',2,2],['65%','15%',3,0.3],['78%','50%',2,1.8],['88%','35%',4,0.9],['92%','75%',3,1.5],['45%','55%',2,2.4],['25%','90%',3,0.7],['70%','88%',2,1.1],['55%','40%',4,1.9]] as [$t,$l,$s,$delay])
        <div class="absolute rounded-full bg-accent-400 animate-pulse"
             style="top:{{$t}};left:{{$l}};width:{{$s}}px;height:{{$s}}px;opacity:0.18;animation-delay:{{$delay}}s;animation-duration:4s;"></div>
        @endforeach
    </div>

    {{-- Back link --}}
    <div class="relative z-10 container mx-auto px-6 pt-20 lg:pt-24">
        <a href="{{ route('home') }}#services"
           class="inline-flex items-center gap-2 text-white/40 hover:text-accent-300 transition-all duration-300 text-xs font-bold tracking-[0.2em] uppercase group">
            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            All Services
        </a>
    </div>

    {{-- Hero copy --}}
    <div class="relative z-10 container mx-auto px-6 mt-8 pb-0">

        {{-- Eyebrow --}}
        <div class="flex items-center gap-4 mb-4">
            <div class="h-px w-12 bg-gradient-to-r from-accent-400 to-transparent"></div>
            <span class="text-accent-400 text-[10px] font-black tracking-[0.35em] uppercase">Space IQ Design Studio</span>
            <div class="h-px flex-1 bg-gradient-to-r from-accent-400/20 to-transparent max-w-[120px]"></div>
        </div>

        {{-- Title --}}
        <h1 class="font-black text-white leading-[0.88] tracking-tight mb-5"
            style="font-size:clamp(3.2rem,8.5vw,8rem);text-transform:uppercase;">
            @if($hasSubcategories)
                <span class="block text-white/25 font-bold mb-2"
                      style="font-size:clamp(0.75rem,1.8vw,1.2rem);letter-spacing:0.35em;">{{ $serviceLabel }}</span>
                <span class="block"
                      style="background:linear-gradient(130deg,#ffffff 0%,#7EC8C0 45%,#1A9E96 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    {{ $currentLabel }}
                </span>
            @else
                <span class="block"
                      style="background:linear-gradient(130deg,#ffffff 0%,#7EC8C0 45%,#1A9E96 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    {{ $service->title }}
                </span>
            @endif
        </h1>

        {{-- Description --}}
        <p class="text-gray-500 text-base md:text-lg font-light leading-relaxed max-w-xl mb-10">
            {{ $service->short_description }}
        </p>
    </div>

    {{-- Category tab bar --}}
    @if($hasSubcategories)
    <div class="relative z-10 border-t border-white/[0.07]">
        <div class="container mx-auto px-6">
            <nav class="flex items-stretch overflow-x-auto" style="scrollbar-width:none;">
                @foreach($subLabels as $key => $label)
                @php $active = ($currentSub === $key); @endphp
                <a href="{{ route('service.show', ['slug' => $service->slug, 'subcategory' => $key]) }}"
                   class="relative flex-shrink-0 px-8 py-5 text-xs font-black tracking-[0.22em] uppercase transition-all duration-300 focus:outline-none whitespace-nowrap
                          {{ $active ? 'text-accent-300' : 'text-white/35 hover:text-white/70' }}">
                    {{ $label }}
                    @if($active)
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] rounded-full"
                          style="background:linear-gradient(90deg,transparent 0%,#3AADAA 30%,#3AADAA 70%,transparent 100%);"></span>
                    <span class="absolute inset-0 pointer-events-none"
                          style="background:linear-gradient(to top,rgba(58,173,170,0.06),transparent);"></span>
                    @endif
                </a>
                @endforeach
            </nav>
        </div>
    </div>
    @else
    <div class="h-8 relative z-10"></div>
    @endif

</section>

<!-- Content Section -->
<section class="py-20 relative">
    @if($service->media->count() > 0)
        <div class="w-full px-6 md:px-12 mt-4 mb-24">
            @foreach($groupedMedia as $category => $categoryMedia)
                <div>
                    @php
                        $is360 = $service->slug === '360-views';
                        $numCols = 3;
                        $gridColsClass = 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4';
                    @endphp
                    <div class="grid {{ $gridColsClass }} items-start w-full mb-16 pt-8">
                    @php
                        $columns = [[], [], []];
                        $index = 0;
                        foreach($categoryMedia->sortBy('sort_order') as $media) {
                            $columns[$index % 3][] = $media;
                            $index++;
                        }
                    @endphp
                    
                    @foreach($columns as $colIndex => $columnMedia)
                        @php
                            $staggerClass = match($colIndex) {
                                1 => 'md:mt-12',
                                2 => 'lg:mt-24',
                                default => ''
                            };
                            $spaceClass = $is360 ? 'space-y-6' : 'space-y-4';
                        @endphp
                        <div class="{{ $spaceClass }} w-full {{ $staggerClass }}">
                            @foreach($columnMedia as $media)
                                @if($service->slug === '360-views')
                                    {{-- 360° Viewer: Pannellum autoRotate stops on interaction --}}
                                    <div class="relative rounded-xl overflow-hidden border border-white/10 shadow-2xl bg-brand-950 w-full"
                                         x-data="{
                                             viewer: null,
                                             hintVisible: true,
                                             init() {
                                                 this.$nextTick(() => {
                                                     this.viewer = pannellum.viewer(this.$refs.panoEl, {
                                                         type: 'equirectangular',
                                                         panorama: '{{ webp_asset(parse_url(Storage::url($media->file_path), PHP_URL_PATH)) }}',
                                                         autoLoad: true,
                                                         compass: false,
                                                         autoRotate: -2,
                                                         autoRotateInactivityDelay: -1,
                                                         mouseZoom: false,
                                                         keyboardZoom: false,
                                                         showZoomCtrl: false,
                                                         showFullscreenCtrl: false,
                                                         showControls: false,
                                                         friction: 0.15
                                                     });
                                                     /* Stop rotation on first user interaction */
                                                     const stopRotate = () => {
                                                         if (this.viewer) {
                                                             this.viewer.stopAutoRotate();
                                                         }
                                                         this.hintVisible = false;
                                                     };
                                                     this.$refs.panoEl.addEventListener('mousedown', stopRotate, { once: true });
                                                     this.$refs.panoEl.addEventListener('touchstart', stopRotate, { once: true });
                                                     this.$refs.panoEl.addEventListener('pointerdown', stopRotate, { once: true });
                                                 });
                                             },
                                             goFullscreen() {
                                                 if (this.viewer) this.viewer.toggleFullscreen();
                                             }
                                         }"
                                         x-init="init()">

                                        {{-- Pannellum container: touch-action:none prevents mobile page scroll conflict --}}
                                        <div x-ref="panoEl"
                                             class="w-full"
                                             style="height: clamp(300px, 50vh, 480px); touch-action: none;"></div>

                                        {{-- Small hint text bottom-center, fades on first drag --}}
                                        <div class="absolute bottom-3 left-0 right-0 z-20 flex justify-center pointer-events-none transition-opacity duration-500"
                                             :class="hintVisible ? 'opacity-100' : 'opacity-0'">
                                            <span class="text-[10px] text-white/55 tracking-widest font-medium uppercase bg-brand-950/40 backdrop-blur-sm rounded-full px-3 py-1">Click to explore</span>
                                        </div>

                                        {{-- Top bar: title + fullscreen button --}}
                                        <div class="absolute top-0 left-0 right-0 z-30 flex items-center justify-between px-4 py-2.5 bg-gradient-to-b from-brand-950/70 to-transparent pointer-events-none">
                                            <div class="flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-accent-400 animate-pulse"></div>
                                                @if($media->title)
                                                <span class="text-[10px] text-white/70 uppercase tracking-widest font-bold">{{ $media->title }}</span>
                                                @else
                                                <span class="text-[10px] text-white/50 uppercase tracking-widest font-semibold">360° Virtual Tour</span>
                                                @endif
                                            </div>
                                            <button class="pointer-events-auto w-7 h-7 rounded-md bg-brand-950/60 border border-white/10 hover:border-accent-400/50 flex items-center justify-center text-white/40 hover:text-white transition-all duration-200"
                                                    title="Fullscreen"
                                                    @click="goFullscreen()">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l-5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                            </button>
                                        </div>

                                    </div>

                                @else
                                    @php
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
                                    @endphp
                                    @php
                                         $mediaUrl = webp_asset(parse_url(Storage::url($media->file_path), PHP_URL_PATH));
                                         $mediaIndex = $lightboxImagesCollect->values()->filter(fn($x) => $x['url'] === $mediaUrl)->keys()->first() ?? 0;
                                     @endphp
                                     <div class="relative group overflow-hidden rounded-md shadow-xl tilt-card {{ $isTallImage ? 'max-w-[60%] md:max-w-[50%] mx-auto' : 'w-full' }}" 
                                          @if($media->file_type !== 'video') 
                                             @click="lightboxOpen = true; lightboxIndex = {{ $mediaIndex }}; lightboxUrl = '{{ $mediaUrl }}'; lightboxTitle = '{{ $media->title }}'; initPannellum('{{ $mediaUrl }}')" 
                                          @endif>
                                        @if($media->file_type === 'video')
                                            @php
                                                $isYoutube = false;
                                                $youtubeId = '';
                                                if (str_contains($media->file_path, 'youtube.com') || str_contains($media->file_path, 'youtu.be')) {
                                                    $isYoutube = true;
                                                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|watch\?v=|v=)|youtu\.be/)([^"&?/ ]{11})%i', $media->file_path, $match)) {
                                                        $youtubeId = $match[1];
                                                    }
                                                }
                                            @endphp
                                            @if($isYoutube)
                                                <div class="relative w-full aspect-video overflow-hidden rounded-md shadow-xl bg-brand-900/50">
                                                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=0&controls=1&rel=0" 
                                                            class="absolute inset-0 w-full h-full" 
                                                            frameborder="0" 
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                                            allowfullscreen>
                                                    </iframe>
                                                </div>
                                            @else
                                                <video src="{{ Storage::url($media->file_path) }}" controls class="w-full h-auto block rounded-md shadow-xl"></video>
                                            @endif
                                        @else
                                            <div class="cursor-pointer overflow-hidden bg-brand-900/50 relative"
                                                 x-data="{ imgLoaded: false }">
                                                <!-- Skeleton shimmer placeholder -->
                                                <div class="absolute inset-0 skeleton-shimmer z-0 min-h-[200px]" x-show="!imgLoaded"></div>
                                                @php
                                                     $imgOrigUrl = parse_url(Storage::url($media->file_path), PHP_URL_PATH);
                                                     $imgWebpUrl = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $imgOrigUrl);
                                                     $imgWebpPath = public_path($imgWebpUrl);
                                                     $hasWebp = file_exists($imgWebpPath);
                                                @endphp
                                                <picture>
                                                     @if($hasWebp)
                                                     <source srcset="{{ $imgWebpUrl }}" type="image/webp">
                                                     @endif
                                                     <img src="{{ $imgOrigUrl }}"
                                                          alt="{{ $media->alt_text ?? $media->title ?? $service->title . ' - ' . ($media->category ?? 'Portfolio Project') }}"
                                                          loading="lazy"
                                                          decoding="async"
                                                          @load="imgLoaded = true"
                                                          class="w-full h-auto block transition-transform duration-700 group-hover:scale-110 grayscale-[10%] group-hover:grayscale-0 lazy-img relative z-10"
                                                          :class="imgLoaded ? 'loaded' : ''">
                                                </picture>
                                                <!-- Hover caption overlay -->
                                                @if($media->title)
                                                <div class="absolute bottom-0 left-0 right-0 z-20 translate-y-full group-hover:translate-y-0 transition-transform duration-400 ease-out pointer-events-none"
                                                     style="background:linear-gradient(to top, rgba(8,14,14,0.92) 0%, transparent 100%); padding: 20px 16px 14px;">
                                                    <p class="text-white text-xs font-semibold uppercase tracking-widest">{{ $media->title }}</p>
                                                </div>
                                                @endif
                                                <!-- Zoom icon -->
                                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-end p-3 pointer-events-none z-20">
                                                    <div class="bg-brand-900/80 backdrop-blur-sm p-2.5 rounded-full">
                                                        <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    </div>
                </div>
            @endforeach

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
                        <div class="relative max-w-full max-h-[85vh] flex items-center justify-center z-[105]" 
                             @click.away="closeLightbox()"
                             @touchstart="touchStartX = $event.touches[0].clientX"
                             @touchend="touchEndX = $event.changedTouches[0].clientX; if (touchStartX - touchEndX > 40) nextImage(); if (touchEndX - touchStartX > 40) prevImage();"
                             style="touch-action: pan-y;">
                            <!-- Left Arrow -->
                            <button type="button" x-show="lightboxImages.length > 1" @click.stop="prevImage()" class="absolute left-4 md:-left-20 text-white/70 hover:text-white transition-all bg-black/50 hover:bg-black/80 rounded-full p-3 border border-white/10 hover:scale-110 transform z-[115] cursor-pointer">
                                <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            
                            <img :src="lightboxUrl" :alt="lightboxTitle || 'Space IQ Portfolio Project'" class="max-w-full max-h-[80vh] rounded-sm shadow-2xl object-contain">
                            
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
    @else
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
                    <a href="{{ route('contact') }}" class="btn-glow px-6 py-3.5 bg-accent-500 hover:bg-accent-400 text-white rounded-sm font-semibold uppercase tracking-wider text-xs transition-colors">
                        Request Samples
                    </a>
                    <a href="https://wa.me/918121376325?text=Hi%20Space%20IQ%20Design%20Studio%2C%20I%27d%20like%20to%20request%20some%20offline%20design%20samples%20for%20my%20project." target="_blank" rel="noopener noreferrer" class="px-6 py-3.5 border border-white/10 hover:border-white/30 text-white rounded-sm font-semibold uppercase tracking-wider text-xs transition-colors bg-white/2 backdrop-blur-sm flex items-center justify-center gap-2">
                        Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    @endif
</section>
</div>

<!-- Service Page Bottom CTA -->
<section class="py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #080e0e 0%, #0c1818 50%, #080e0e 100%);">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 30% 50%, #1A9E96 0%, transparent 50%);"></div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <p class="text-xs uppercase tracking-widest text-accent-400 font-bold mb-4">Ready to get started?</p>
        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">Love what you see?<br><span class="text-gradient">Let's work together.</span></h2>
        <p class="text-gray-400 font-light mb-10 max-w-xl mx-auto">Share your project details and our team will get back to you within 24 hours.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-accent-500 hover:bg-accent-400 text-white font-bold uppercase tracking-widest text-sm transition-all duration-300 shadow-xl hover:-translate-y-1">
            Start Your Project
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>
</section>

@endsection
EOF

# 3. Update welcome.blade.php
echo "Applying optimized welcome.blade.php (Fixed Navigation Arrows & WebP Image Support)..."
cat << 'EOF' > resources/views/welcome.blade.php
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
    </style>
@endsection

@section('content')

<!-- Hero Section -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden min-h-screen flex items-center">
    <!-- Background Video Wrapper (Solid Dark Backdrop) -->
    <div class="absolute inset-0 z-0 bg-brand-950 overflow-hidden">
        <!-- Background Video (YouTube Walkthrough Showreel - Interior Animation) -->
        <iframe class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[100vw] h-[56.25vw] min-h-[100vh] min-w-[177.77vh] pointer-events-none opacity-75 select-none scale-[1.35]" 
                src="https://www.youtube.com/embed/aTCQdR368LA?autoplay=1&mute=1&controls=0&loop=1&playlist=aTCQdR368LA&playsinline=1&showinfo=0&rel=0&modestbranding=1&start=26&iv_load_policy=3&disablekb=1&fs=0" 
                frameborder="0" 
                allow="autoplay; encrypted-media" 
                allowfullscreen>
        </iframe>
    </div>
    <!-- Dark overlay for text readability -->
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-brand-950/60 via-brand-950/30 to-brand-950/85"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold tracking-tight mb-4 font-display text-white">
            Space IQ <span class="text-gradient">Design Studio</span>
        </h1>
        
        <p class="text-lg md:text-2xl text-white font-medium tracking-widest uppercase mb-10 font-display">
            Where Vision Meets Reality
        </p>
        
        <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-10 leading-relaxed font-light">
            We bridge the gap between architectural vision and reality with hyper-realistic 4K renders that captivate clients and accelerate project approvals.
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('contact') }}" class="btn-glow px-10 py-5 bg-brand-600 hover:bg-brand-500 rounded-sm font-semibold text-white transition-all flex items-center justify-center gap-2 uppercase tracking-wide text-sm">
                Book a Consultation
            </a>
            <a href="#services" class="px-10 py-5 border border-white/20 hover:border-white/50 rounded-sm font-semibold text-white transition-all text-center uppercase tracking-wide text-sm bg-black/20 backdrop-blur-sm">
                View Project Gallery
            </a>
        </div>
    </div>

    <!-- Stats Banner inside Hero -->
    <div class="absolute bottom-0 left-0 w-full py-8 z-20">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center" id="stats-section">
                <div>
                    <p class="text-3xl font-display font-bold text-white mb-1" data-count="12000" data-suffix="+">0</p>
                    <p class="text-[10px] uppercase tracking-widest text-accent-400 font-bold">Successful Projects</p>
                </div>
                <div>
                    <p class="text-3xl font-display font-bold text-white mb-1" data-count="500" data-suffix="+">0</p>
                    <p class="text-[10px] uppercase tracking-widest text-accent-400 font-bold">Happy Clients</p>
                </div>
                <div>
                    <p class="text-3xl font-display font-bold text-white mb-1" data-count="15" data-suffix="+">0</p>
                    <p class="text-[10px] uppercase tracking-widest text-accent-400 font-bold">Countries</p>
                </div>
                <div>
                    <p class="text-3xl font-display font-bold text-white mb-1" data-count="10" data-suffix="+">0</p>
                    <p class="text-[10px] uppercase tracking-widest text-accent-400 font-bold">Years of Experience</p>
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

<!-- Services Grid -->
<section id="services" class="py-24 relative bg-brand-950">
    <div class="container mx-auto px-6 xl:px-12" style="max-width:1536px">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-display mb-4 font-light"><span class="font-bold">Our</span> Masterpieces</h2>
        </div>
        
        <div class="grid grid-cols-1 gap-20">
            @php
                $groupedServicesHome = \App\Models\Service::where('is_active', true)
                    ->whereNotIn('slug', ['autocad-drafting', 'interior-design-consultation'])
                    ->orderBy('sort_order')
                    ->get()
                    ->groupBy('category');
            @endphp
            
            @forelse($groupedServicesHome as $category => $services)
                <div class="mb-4">
                    <h3 class="text-2xl text-accent-400 uppercase tracking-widest font-bold mb-10 border-b border-white/10 pb-4 inline-block">{{ $category }}</h3>
                    <div class="grid grid-cols-1 gap-12">
                        @foreach($services as $index => $service)
                            @php
                                $imageUrls = collect();
                                if ($service->slug !== 'walkthrough-animation' && $service->slug !== '360-views') {
                                    $selected = [];
                                    $seenGenres = [];
                                    
                                    foreach ($service->media->where('file_type', '!=', 'video')->sortBy('sort_order') as $media) {
                                        $path = public_path(parse_url(Storage::url($media->file_path), PHP_URL_PATH));
                                        
                                        // Ensure width > height (landscape) to fit the frame perfectly
                                        $isLandscape = true;
                                        if (file_exists($path)) {
                                            $size = @getimagesize($path);
                                            if ($size && ($size[1] > $size[0])) {
                                                $isLandscape = false;
                                            }
                                        }
                                        
                                        if (!$isLandscape) {
                                            continue;
                                        }
                                        
                                        $genre = 'other';
                                        $title = strtolower($media->title);
                                        $cat = strtolower($media->category ?? '');
                                        
                                        if (str_contains($title, 'bedroom')) {
                                            $genre = 'bedroom';
                                        } elseif (str_contains($title, 'living')) {
                                            $genre = 'living';
                                        } elseif (str_contains($title, 'bath')) {
                                            $genre = 'bathroom';
                                        } elseif (str_contains($title, 'dining') || str_contains($title, 'kitchen') || str_contains($title, 'cafe') || str_contains($title, 'bar')) {
                                            $genre = 'dining_kitchen_bar';
                                        } elseif (str_contains($title, 'office') || str_contains($title, 'conference') || str_contains($title, 'reception') || str_contains($title, 'study') || str_contains($title, 'library')) {
                                            $genre = 'workspace';
                                        } elseif (str_contains($title, 'gym')) {
                                            $genre = 'gym';
                                        } elseif (str_contains($title, 'mansion') || str_contains($title, 'house') || str_contains($title, 'home') || str_contains($title, 'townhouse') || str_contains($title, 'residence') || str_contains($title, 'suburban')) {
                                            $genre = 'residential_elevation';
                                        } elseif (str_contains($title, 'commercial') || str_contains($title, 'building') || str_contains($title, 'retail') || str_contains($title, 'theatre') || str_contains($title, 'office complex')) {
                                            $genre = 'commercial_elevation';
                                        } elseif (str_contains($title, 'landscape') || str_contains($title, 'pool') || str_contains($title, 'garden') || str_contains($title, 'backyard') || str_contains($title, 'lawn')) {
                                            $genre = 'landscape_design';
                                        } elseif (str_contains($title, 'black & white') || str_contains($title, 'b&w') || $cat === 'b&w' || $cat === 'b-w' || $cat === 'bw') {
                                            $genre = 'floorplan_bw';
                                        } elseif (str_contains($title, 'colour') || str_contains($title, 'color') || $cat === 'color') {
                                            $genre = 'floorplan_color';
                                        } elseif (str_contains($title, 'site plan') || $cat === 'site plan' || $cat === 'site-plan') {
                                            $genre = 'floorplan_site';
                                        } elseif ($cat === 'residential') {
                                            $genre = 'floorplan_residential';
                                        }
                                        
                                        if ($genre === 'other' || !in_array($genre, $seenGenres)) {
                                            if ($genre !== 'other') {
                                                $seenGenres[] = $genre;
                                            }
                                            $imageUrls->push([
                                                'url' => webp_asset(parse_url(Storage::url($media->file_path), PHP_URL_PATH)),
                                                'title' => $media->title ?? $service->title . ' - Project ' . ($imageUrls->count() + 1)
                                            ]);
                                            if ($imageUrls->count() >= 5) {
                                                break;
                                            }
                                        }
                                    }
                                    
                                    if ($imageUrls->count() < 5) {
                                        foreach ($service->media->where('file_type', '!=', 'video')->sortBy('sort_order') as $media) {
                                            $url = parse_url(Storage::url($media->file_path), PHP_URL_PATH);
                                            if (!$imageUrls->pluck('url')->contains(webp_asset($url))) {
                                                $path = public_path(url);
                                                $isLandscape = true;
                                                if (file_exists($path)) {
                                                    $size = @getimagesize($path);
                                                    if ($size && ($size[1] > $size[0])) {
                                                        $isLandscape = false;
                                                    }
                                                }
                                                if ($isLandscape) {
                                                    $imageUrls->push([
                                                        'url' => webp_asset($url),
                                                        'title' => $media->title ?? $service->title . ' - Project ' . ($imageUrls->count() + 1)
                                                    ]);
                                                    if ($imageUrls->count() >= 5) {
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    
                                    if ($imageUrls->isEmpty()) {
                                        $imageUrls->push([
                                            'url' => $index % 2 == 0 ? webp_asset('/img/exterior_render.png') : webp_asset('/img/interior_render.png'),
                                            'title' => $service->title . ' - Project Placeholder'
                                        ]);
                                    }
                                }
                            @endphp
                        <div class="relative group/card w-full"
                             @if($service->slug !== 'walkthrough-animation' && $service->slug !== '360-views')
                             x-data="{ 
                                 currentIndex: 0, 
                                 images: {{ json_encode($imageUrls->values()->toArray()) }},
                                 total: {{ $imageUrls->count() }},
                                 touchStartX: 0,
                                 touchEndX: 0,
                                 next() {
                                     this.currentIndex = (this.currentIndex + 1) % this.total;
                                 },
                                 prev() {
                                     this.currentIndex = (this.currentIndex - 1 + this.total) % this.total;
                                 },
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
                                 init() {
                                     if (this.total > 1) {
                                         setInterval(() => this.next(), 10000);
                                     }
                                 }
                             }"
                             @touchstart="handleTouchStart($event)"
                             @touchend="handleTouchEnd($event)"
                             style="touch-action: pan-y;"
                             @endif
                        >
                            <!-- Tilting Card Container -->
                            <div class="flex flex-col {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center group bg-brand-900/30 border border-white/5 hover:border-accent-400/20 rounded-xl overflow-hidden transition-colors duration-500 tilt-card">
                                <div class="w-full md:w-1/2 p-8 md:p-10 xl:p-12 z-10 relative">
                                    <h4 class="text-3xl font-display font-bold text-white mb-4 uppercase">{{ $service->title }}</h4>
                                    <p class="text-gray-400 mb-8 font-light text-lg leading-relaxed">{{ $service->short_description ?? Str::limit(strip_tags($service->description), 100) }}</p>
                                    <a href="{{ route('service.show', $service->slug) }}" class="text-accent-400 hover:text-white font-medium flex items-center gap-2 group-hover:gap-4 transition-all w-max uppercase tracking-wider text-sm border-b border-accent-400 hover:border-white pb-1">
                                        View Gallery <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                                @if($service->slug === 'walkthrough-animation')
                                    @php
                                        $videoMedia = $service->media->sortBy('sort_order')->first();
                                        $isYoutube = false;
                                        $youtubeId = '';
                                        if ($videoMedia) {
                                            if (str_contains($videoMedia->file_path, 'youtube.com') || str_contains($videoMedia->file_path, 'youtu.be')) {
                                                $isYoutube = true;
                                                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|watch\?v=|v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoMedia->file_path, $match)) {
                                                    $youtubeId = $match[1];
                                                }
                                            }
                                        }
                                    @endphp
                                    <div class="w-full md:w-1/2 relative overflow-hidden h-[300px] sm:h-[350px] md:h-[400px] bg-brand-950">
                                        @if($videoMedia)
                                            @if($isYoutube)
                                                <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&controls=1&rel=0" 
                                                        class="w-full h-full" 
                                                        frameborder="0" 
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                                        allowfullscreen>
                                                </iframe>
                                            @else
                                                <video src="{{ Storage::url($videoMedia->file_path) }}" autoplay muted loop playsinline controls class="w-full h-full object-cover"></video>
                                            @endif
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                                                Video Showcase Coming Soon
                                            </div>
                                        @endif
                                    </div>
                                @elseif($service->slug === '360-views')
                                    @php
                                        $panoramaMedia = $service->media->where('id', 105)->first() ?? $service->media->first();
                                        $panoPath = $panoramaMedia ? webp_asset(parse_url(Storage::url($panoramaMedia->file_path), PHP_URL_PATH)) : null;
                                    @endphp
                                    <div class="w-full md:w-1/2 relative overflow-hidden h-[300px] sm:h-[350px] md:h-[400px] bg-brand-950">
                                        @if($panoPath)
                                            <div id="home-panorama-{{ $panoramaMedia->id }}" 
                                                 class="w-full h-full"
                                                 x-data="{ viewer: null }"
                                                 x-init="$nextTick(() => {
                                                     viewer = pannellum.viewer('home-panorama-{{ $panoramaMedia->id }}', {
                                                         type: 'equirectangular',
                                                         panorama: '{{ $panoPath }}',
                                                         autoLoad: true,
                                                         compass: false,
                                                         autoRotate: -2,
                                                         autoRotateInactivityDelay: -1,
                                                         mouseZoom: false,
                                                         showZoomCtrl: false,
                                                         showFullscreenCtrl: true
                                                     });
                                                     const stopRotate = () => {
                                                         if (viewer) viewer.stopAutoRotate();
                                                     };
                                                     $el.addEventListener('mousedown', stopRotate, { once: true });
                                                     $el.addEventListener('touchstart', stopRotate, { once: true });
                                                     $el.addEventListener('pointerdown', stopRotate, { once: true });
                                                 })">
                                            </div>
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                                                360 View Showcase Coming Soon
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="w-full md:w-1/2 relative overflow-hidden h-[300px] sm:h-[350px] md:h-[400px] bg-brand-950">
                                        <div class="w-full h-full relative">
                                            <template x-for="(item, idx) in images" :key="idx">
                                                <div x-show="currentIndex === idx" 
                                                     x-transition:enter="transition ease-out duration-700"
                                                     x-transition:enter-start="opacity-0 scale-105"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     x-transition:leave="transition ease-in duration-500"
                                                     x-transition:leave-start="opacity-100"
                                                     x-transition:leave-end="opacity-0"
                                                     class="absolute inset-0 w-full h-full flex items-center justify-center bg-brand-950 overflow-hidden"
                                                     x-data="{ bgLoaded: false, fgLoaded: false }">
                                                     <!-- Skeleton shimmer shown until both images load -->
                                                     <div class="absolute inset-0 skeleton-shimmer z-0" x-show="!fgLoaded"></div>
                                                     <!-- Blurred Ambient Background Image -->
                                                     <img :src="item.url"
                                                          loading="lazy"
                                                          decoding="async"
                                                          @load="bgLoaded = true"
                                                          class="absolute inset-0 w-full h-full object-cover blur-xl opacity-30 scale-110 pointer-events-none lazy-img animate-kenburns"
                                                          :class="bgLoaded ? 'loaded' : ''">
                                                     <!-- Main Foreground Image (Fully Visible) -->
                                                     <img :src="item.url"
                                                          loading="lazy"
                                                          decoding="async"
                                                          @load="fgLoaded = true"
                                                          class="relative z-10 max-w-full max-h-full object-contain grayscale-[15%] hover:grayscale-0 transition-all duration-700 lazy-img animate-kenburns"
                                                          :class="fgLoaded ? 'loaded' : ''"
                                                          :alt="item.title || 'Space IQ Portfolio Project'">
                                                </div>
                                            </template>
                                            <div class="absolute inset-0 bg-black/10 pointer-events-none z-10"></div>
                                        </div>

                                        <template x-if="total > 1">
                                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-1.5 z-20 bg-brand-950/40 backdrop-blur-sm px-2.5 py-1 rounded-full border border-white/5">
                                                <template x-for="(item, idx) in images" :key="idx">
                                                    <button @click="currentIndex = idx" 
                                                             class="w-1.5 h-1.5 rounded-full transition-all focus:outline-none cursor-pointer"
                                                             :class="currentIndex === idx ? 'bg-accent-400 w-3' : 'bg-white/40 hover:bg-white/70'"></button>
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                @endif
                            </div>

                            <!-- Fixed Navigation Arrows (Outside tilt-card) -->
                            @if($service->slug !== 'walkthrough-animation' && $service->slug !== '360-views')
                            <template x-if="total > 1">
                                <div class="absolute bottom-0 md:top-0 md:bottom-0 {{ $index % 2 == 0 ? 'right-0' : 'left-0 md:right-auto' }} w-full md:w-1/2 h-[300px] sm:h-[350px] md:h-auto flex items-center justify-between px-4 z-30 pointer-events-none opacity-0 group-hover/card:opacity-100 transition-opacity duration-300">
                                    <button @click="prev()" class="p-2 rounded-full bg-brand-950/80 border border-white/10 text-white hover:text-accent-400 hover:scale-110 transition-all focus:outline-none pointer-events-auto cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                                    </button>
                                    <button @click="next()" class="p-2 rounded-full bg-brand-950/80 border border-white/10 text-white hover:text-accent-400 hover:scale-110 transition-all focus:outline-none pointer-events-auto cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                    </button>
                                </div>
                            </template>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500">More services coming soon!</p>
                </div>
            @endforelse
        </div>
    </div>
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
// ── Animated Stat Counters ──
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
EOF

# 4. Show Apache setup message
echo "Optimizations successfully applied!"
echo "------------------------------------------------"
echo "To update your local Apache VirtualHost configuration:"
echo "1. On Windows XAMPP, open:"
echo "   C:\xampp\apache\conf\extra\httpd-vhosts.conf"
echo "2. Reorder your <VirtualHost *:80> tags to place the SpaceIQ Laravel public folder first."
echo "3. Add 'ServerAlias localhost 127.0.0.1' under the ServerName spaceiq.local directive."
echo "4. Restart Apache."
echo "------------------------------------------------"

# 5. Clear Caches
echo "Clearing Laravel compilation caches..."
php artisan view:clear
php artisan route:clear
php artisan config:clear

echo "================================================"
echo "Done! The application is fully optimized."
echo "================================================"
