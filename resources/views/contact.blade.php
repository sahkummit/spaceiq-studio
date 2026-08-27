@extends('layouts.app')

@section('title', 'Contact Us - Space IQ Design Studio')
@section('meta_description', 'Get in touch with Space IQ Design Studio to discuss your 3D architectural rendering, animation, or CAD drafting project.')

@section('content')
<!-- Header Section -->
<section class="relative pt-36 pb-20 lg:pt-44 lg:pb-24 overflow-hidden border-b border-slate-200/80 bg-slate-50/80">
    <div class="absolute inset-0 opacity-40 pointer-events-none" style="background-image: radial-gradient(circle at 20% 50%, rgba(26,158,150,0.08) 0%, transparent 60%), radial-gradient(circle at 80% 50%, rgba(14,124,123,0.08) 0%, transparent 60%);"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center max-w-4xl">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-light tracking-tight text-slate-900 mb-6 uppercase leading-tight reveal">
            Let's Start a <span class="font-normal text-transparent bg-clip-text bg-gradient-to-r from-slate-950 via-accent-500 to-accent-400">Conversation</span>
        </h1>
        
        <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-light max-w-2xl mx-auto reveal">
            Whether you have napkin sketches, CAD blueprints, or architectural permit sets — share your project brief for a tailored quote and timeline.
        </p>
    </div>
</section>

<!-- Main Contact Section -->
<section class="py-20 lg:py-28 relative bg-[#f8fafc]">
    <div class="container mx-auto px-6 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- Contact Info Sidebar (Span 4) -->
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white rounded-3xl p-8 md:p-10 border border-slate-200 shadow-xl reveal">
                    @php $settings = \App\Models\Setting::pluck('value', 'key'); @endphp
                    
                    <div class="space-y-7">
                        <!-- Email -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-xl bg-accent-500/10 border border-accent-500/20 flex items-center justify-center flex-shrink-0 text-accent-500 group-hover:scale-110 group-hover:bg-accent-500 group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-[11px] font-bold text-accent-500 uppercase tracking-widest mb-1">Email Inquiries</h4>
                                <p class="text-slate-800 font-medium text-base break-all sm:break-normal">
                                    <a href="mailto:{{ $settings['contact_email'] ?? 'spaceiqstudio@gmail.com' }}" class="hover:text-accent-500 transition-colors">
                                        {{ $settings['contact_email'] ?? 'spaceiqstudio@gmail.com' }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-xl bg-accent-500/10 border border-accent-500/20 flex items-center justify-center flex-shrink-0 text-accent-500 group-hover:scale-110 group-hover:bg-accent-500 group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-[11px] font-bold text-accent-500 uppercase tracking-widest mb-1">Phone / WhatsApp</h4>
                                <p class="text-slate-800 font-medium text-base">
                                    <a href="tel:{{ str_replace(' ', '', $settings['contact_phone'] ?? '+918121376325') }}" class="hover:text-accent-500 transition-colors">
                                        {{ $settings['contact_phone'] ?? '+91 81213 76325' }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-xl bg-accent-500/10 border border-accent-500/20 flex items-center justify-center flex-shrink-0 text-accent-500 group-hover:scale-110 group-hover:bg-accent-500 group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-[11px] font-bold text-accent-500 uppercase tracking-widest mb-1">Studio Location</h4>
                                <p class="text-slate-800 font-medium text-base leading-relaxed">
                                    {!! nl2br(e($settings['office_address'] ?? 'Mohali, Punjab (India)')) !!}
                                </p>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-xl bg-accent-500/10 border border-accent-500/20 flex items-center justify-center flex-shrink-0 text-accent-500 group-hover:scale-110 group-hover:bg-accent-500 group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                            </div>
                            <div>
                                <h4 class="text-[11px] font-bold text-accent-500 uppercase tracking-widest mb-1">Instagram</h4>
                                <p class="text-slate-800 font-medium text-base">
                                    <a href="https://instagram.com/space_iq_" target="_blank" rel="noopener noreferrer" class="hover:text-accent-500 transition-colors">
                                        @space_iq_
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Supported File Formats Box -->
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <div class="p-4 bg-slate-50 border border-slate-200/80 rounded-2xl">
                            <p class="text-[10px] font-bold text-slate-800 uppercase tracking-wider mb-1">Supported File Formats</p>
                            <p class="text-slate-600 text-xs font-light leading-relaxed">
                                DWG, DXF, PDF, JPG, PNG, SKP, RVT, ZIP, DOC<br>
                                Up to 5 files · Max 20MB per file
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form (Span 8) -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-3xl p-6 sm:p-8 md:p-12 border border-slate-200 shadow-xl relative overflow-hidden reveal">
                    <div class="mb-8">
                        <h2 class="text-2xl sm:text-3xl font-display font-light uppercase tracking-tight text-slate-900 mb-2">
                            Project Inquiry <span class="font-normal text-accent-500">&amp; Brief</span>
                        </h2>
                        <p class="text-sm text-slate-500 font-light">Fill out the specifications below. All briefs are reviewed under full confidentiality.</p>
                    </div>

                    <!-- Loading Overlay -->
                    <div x-show="submitting"
                         class="absolute inset-0 bg-white/95 backdrop-blur-md z-[80] flex flex-col items-center justify-center text-center p-6"
                         x-transition.opacity
                         style="display: none;">
                        <div class="w-14 h-14 border-4 border-accent-500 border-t-transparent rounded-full animate-spin mb-4"></div>
                        <p class="text-slate-900 font-bold uppercase tracking-widest text-sm">Uploading project details...</p>
                        <p class="text-slate-500 text-xs mt-1">Please do not close this window</p>
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
                                      if (!allowed.includes(ext)) { this.errors.push(f.name + ': file format not supported.'); return; }
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
                                                  this.errors = ['Validation failed. Please check the required fields.'];
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
                            <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-5 py-4 rounded-2xl mb-6 font-medium text-sm flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl mb-6 text-sm">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Alpine AJAX validation errors -->
                        <div x-show="errors.length > 0" 
                             class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl mb-6 text-sm"
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
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Your Full Name <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-accent-500 focus:ring-4 focus:ring-accent-500/10 transition-all font-light"
                                       placeholder="e.g. Alexander Wright">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Email Address <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-accent-500 focus:ring-4 focus:ring-accent-500/10 transition-all font-light"
                                       placeholder="alexander@architecture.com">
                            </div>
                        </div>

                        <!-- Phone + Service Required -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Phone / WhatsApp Number
                                </label>
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-accent-500 focus:ring-4 focus:ring-accent-500/10 transition-all font-light"
                                       placeholder="+1 (555) 000-0000">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Discipline / Service Needed
                                </label>
                                <div class="relative">
                                    <select name="service_id" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3.5 text-slate-900 focus:bg-white focus:outline-none focus:border-accent-500 focus:ring-4 focus:ring-accent-500/10 transition-all appearance-none font-light cursor-pointer">
                                        <option value="">Select an architectural discipline...</option>
                                        @php $groupedContactServices = \App\Models\Service::where('is_active', true)->orderBy('sort_order')->get()->groupBy('category'); @endphp
                                        @foreach($groupedContactServices as $category => $services)
                                            <optgroup label="{{ $category ?: 'Services' }}" class="text-slate-900 font-bold">
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Project Message / Brief -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                Project Brief &amp; Scope <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="message" rows="4" required
                                      class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-accent-500 focus:ring-4 focus:ring-accent-500/10 transition-all font-light leading-relaxed"
                                      placeholder="Describe your architectural project, property type, square footage, required number of views/angles, target delivery date, and any special lighting moods...">{{ old('message') }}</textarea>
                        </div>

                        <!-- ── File Upload Section ── -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                Attach Drawings &amp; Blueprints
                                <span class="text-slate-400 font-normal normal-case tracking-normal ml-1">(Optional — CAD, DWG, PDF, 3D Models, Sketch)</span>
                            </label>

                            <!-- Hidden real input -->
                            <input type="file" id="attachmentsInput" name="attachments[]" multiple
                                   accept=".jpg,.jpeg,.png,.pdf,.dwg,.dxf,.zip,.rar,.doc,.docx,.xls,.xlsx"
                                   class="hidden"
                                   @change="addFiles($event.target.files)">

                            <!-- Drop Zone -->
                            <div class="relative border-2 border-dashed rounded-2xl transition-all duration-300 cursor-pointer select-none bg-slate-50/70"
                                 :class="dragging ? 'border-accent-500 bg-accent-500/10' : 'border-slate-300 hover:border-accent-500 hover:bg-white'"
                                 @dragover.prevent="dragging = true"
                                 @dragleave.prevent="dragging = false"
                                 @drop.prevent="handleDrop($event)"
                                 @click="document.getElementById('attachmentsInput').click()">

                                <div class="flex flex-col items-center justify-center py-10 px-6 text-center pointer-events-none">
                                    <div class="w-14 h-14 rounded-2xl bg-accent-500/10 border border-accent-500/20 flex items-center justify-center mb-3 text-accent-500 transition-all duration-300"
                                         :class="dragging ? 'scale-110 bg-accent-500/20 text-accent-600' : ''">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                    </div>
                                    <p class="text-slate-900 font-semibold text-sm mb-1">
                                        <span x-show="!dragging">Drag &amp; drop files here, or <span class="text-accent-500 underline underline-offset-2 font-bold">browse from device</span></span>
                                        <span x-show="dragging" class="text-accent-500 font-bold">Release to attach files</span>
                                    </p>
                                    <p class="text-slate-500 text-xs">DWG · DXF · PDF · JPG · PNG · ZIP · SKP &nbsp;·&nbsp; Up to 5 files &nbsp;·&nbsp; Max 20MB each</p>
                                </div>
                            </div>

                            <!-- Selected File List -->
                            <template x-if="files.length > 0">
                                <div class="mt-4 space-y-2">
                                    <p class="text-xs text-slate-600 uppercase tracking-wider font-bold"
                                       x-text="files.length + ' file' + (files.length > 1 ? 's' : '') + ' attached'"></p>

                                    <template x-for="(file, idx) in files" :key="idx">
                                        <div class="flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 group hover:border-slate-300 transition-all"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 -translate-y-1"
                                             x-transition:enter-end="opacity-100 translate-y-0">
                                            <span class="text-xl flex-shrink-0" x-text="getIcon(file.name)"></span>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-slate-900 text-sm font-semibold truncate" x-text="file.name"></p>
                                                <p class="text-slate-500 text-xs" x-text="formatSize(file.size)"></p>
                                            </div>
                                            <button type="button"
                                                    @click.stop="removeFile(idx)"
                                                    class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-200/70 hover:bg-rose-500 hover:text-white text-slate-600 flex items-center justify-center transition-all duration-200 cursor-pointer">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </div>
                                    </template>

                                    <!-- Add More Button -->
                                    <template x-if="files.length < maxFiles">
                                        <button type="button"
                                                @click="document.getElementById('attachmentsInput').click()"
                                                class="w-full py-2.5 border border-dashed border-slate-300 hover:border-accent-500 text-slate-600 hover:text-accent-500 text-xs uppercase tracking-wider font-semibold rounded-xl transition-all duration-200 cursor-pointer">
                                            + Add more files &nbsp;<span class="opacity-60">(<span x-text="maxFiles - files.length"></span> remaining)</span>
                                        </button>
                                    </template>
                                </div>
                            </template>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit"
                                    class="w-full py-4.5 btn-gold btn-magnetic rounded-xl font-bold text-slate-900 uppercase tracking-widest text-xs shadow-2xl transition-all duration-300 hover:scale-[1.01] cursor-pointer">
                                Submit Project Inquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- Success Modal Overlay -->
    <template x-teleport="body">
        <div x-show="submitted"
             class="fixed inset-0 z-[120] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md"
             x-transition.opacity
             style="display: none;"
             @keydown.escape.window="submitted = false">
            
            <div class="relative max-w-md w-full bg-white border border-slate-200 rounded-3xl p-8 md:p-10 shadow-2xl text-center"
                 @click.away="submitted = false"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-95 opacity-0"
                 x-transition:enter-end="scale-100 opacity-100">
                
                <!-- Checkmark Icon -->
                <div class="w-20 h-20 bg-emerald-500/10 border-2 border-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    <span class="absolute inset-0 rounded-full border border-emerald-500 animate-ping opacity-30"></span>
                </div>
                
                <h3 class="text-2xl md:text-3xl font-display font-bold text-slate-900 mb-3 uppercase tracking-wide">Inquiry Received</h3>
                <p class="text-slate-600 font-light leading-relaxed mb-8 text-sm md:text-base">
                    Thank you! We have received your project details and attachments. A principal visualizer from Space IQ will review your brief and contact you within 24 hours.
                </p>
                
                <button @click="submitted = false" 
                        class="w-full py-4 btn-gold rounded-xl font-bold uppercase tracking-widest text-xs shadow-lg cursor-pointer">
                    Back to Studio
                </button>
            </div>
        </div>
    </template>
</section>
@endsection
