@extends('layouts.app')

@section('title', 'Contact Us - Space IQ')
@section('meta_description', 'Get in touch with Space IQ to start your digital project.')

@section('content')
<!-- Header Section -->
<section class="relative pt-32 pb-16 lg:pt-48 lg:pb-24 overflow-hidden border-b border-white/5 bg-brand-950">
    <!-- Blurred background image for visual richness -->
    <div class="absolute inset-0 z-0" style="background-image:url('{{ asset('img/exterior_render.png') }}');background-size:cover;background-position:center;filter:blur(6px) brightness(0.15);transform:scale(1.05);"></div>
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
