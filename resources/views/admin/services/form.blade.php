@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Add Service')

@section('content')
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="mb-6">
    <a href="{{ route('admin.services.index') }}" class="text-brand-600 hover:underline">&larr; Back to Services</a>
</div>

<h1 class="text-3xl font-bold text-gray-900 mb-6">{{ isset($service) ? 'Edit Service' : 'Add Service' }}</h1>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($service)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-brand-500 focus:border-brand-500">
                    <option value="3D Visualisation" {{ (old('category', $service->category ?? '') == '3D Visualisation') ? 'selected' : '' }}>3D Visualisation</option>
                    <option value="2D Drafting" {{ (old('category', $service->category ?? '') == '2D Drafting') ? 'selected' : '' }}>2D Drafting</option>
                    <option value="Design" {{ (old('category', $service->category ?? '') == 'Design') ? 'selected' : '' }}>Design</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-brand-500 focus:border-brand-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $service->slug ?? '') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-brand-500 focus:border-brand-500">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Short Description</label>
            <input type="text" name="short_description" value="{{ old('short_description', $service->short_description ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-brand-500 focus:border-brand-500">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Full Description</label>
            <!-- Quill Editor Container -->
            <div id="quill-editor" class="bg-white" style="height: 300px;">{!! old('description', $service->description ?? '') !!}</div>
            <!-- Hidden textarea for form submission -->
            <textarea name="description" id="hidden-description" class="hidden"></textarea>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Icon (SVG or FontAwesome class)</label>
            <input type="text" name="icon" value="{{ old('icon', $service->icon ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-brand-500 focus:border-brand-500">
        </div>

        <div class="flex items-center mb-6">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 text-brand-600 focus:ring-brand-500 border-gray-300 rounded">
            <label class="ml-2 block text-sm text-gray-900">Active (Visible to public)</label>
        </div>

        <hr class="my-8 border-gray-200">
        
        <h3 class="text-xl font-bold text-gray-900 mb-4">Media Gallery</h3>
        
        @if(isset($service) && $service->media->count() > 0)
        @php
            $isAdminExterior = $service->slug === 'exterior-renders';
            $isAdminInterior = $service->slug === 'interior-renders';
            $isAdminFloorPlans = $service->slug === 'floor-plans';
            $adminHasTabs = $isAdminExterior || $isAdminInterior || $isAdminFloorPlans;
            $adminGroupedMedia = $adminHasTabs
                ? $service->media->groupBy('category')
                : collect(['All' => $service->media]);
            $adminDefaultTab = $adminHasTabs ? ($isAdminFloorPlans ? 'B&W' : 'Residential') : 'All';
        @endphp
        
        <div x-data="{ activeAdminTab: '{{ $adminDefaultTab }}' }" class="mb-12">
            @if($isAdminExterior)
            <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200 pb-4">
                <button type="button" @click="activeAdminTab = 'Residential'" :class="activeAdminTab === 'Residential' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">Residential</button>
                <button type="button" @click="activeAdminTab = 'Commercial'" :class="activeAdminTab === 'Commercial' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">Commercial</button>
                <button type="button" @click="activeAdminTab = 'Aerial Views'" :class="activeAdminTab === 'Aerial Views' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">Aerial</button>
                <button type="button" @click="activeAdminTab = 'Landscape'" :class="activeAdminTab === 'Landscape' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">Landscape</button>
            </div>
            @elseif($isAdminInterior)
            <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200 pb-4">
                <button type="button" @click="activeAdminTab = 'Residential'" :class="activeAdminTab === 'Residential' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">Residential</button>
                <button type="button" @click="activeAdminTab = 'Commercial'" :class="activeAdminTab === 'Commercial' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">Commercial</button>
            </div>
            @elseif($isAdminFloorPlans)
            <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200 pb-4">
                <button type="button" @click="activeAdminTab = 'B&W'" :class="activeAdminTab === 'B&W' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">B&W</button>
                <button type="button" @click="activeAdminTab = 'Color'" :class="activeAdminTab === 'Color' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">Color</button>
                <button type="button" @click="activeAdminTab = 'Site Plan'" :class="activeAdminTab === 'Site Plan' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-md font-medium text-sm transition-colors focus:outline-none">Site Plan</button>
            </div>
            @endif

            @foreach($adminGroupedMedia as $category => $categoryMedia)
            <div x-show="activeAdminTab === '{{ $category }}'" x-cloak>
                <p class="text-sm text-gray-500 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg> 
                    Drag and drop images to automatically change their order on the main website.
                </p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 sortable-gallery">
                    @foreach($categoryMedia->sortBy('sort_order') as $media)
                    <div class="relative group rounded-lg overflow-hidden border border-gray-200 bg-white shadow-sm flex flex-col cursor-move sortable-item" data-id="{{ $media->id }}">
                        <div class="relative flex-1">
                            @if($media->file_type === 'video')
                                <video src="{{ Storage::url($media->file_path) }}" class="w-full h-32 object-cover"></video>
                            @else
                                <img src="{{ Storage::url($media->file_path) }}" alt="{{ $media->alt_text }}" class="w-full h-32 object-cover pointer-events-none">
                            @endif
                            <div class="absolute top-2 left-2 bg-brand-900/80 text-white text-xs font-bold px-2 py-1 rounded shadow-sm backdrop-blur-sm z-10 pointer-events-none">
                                {{ $media->category ?? 'Uncategorized' }}
                            </div>
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                <a href="{{ route('admin.media.destroy', $media) }}" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-sm font-medium" onclick="event.preventDefault(); document.getElementById('delete-media-{{ $media->id }}').submit();">Delete</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div x-data="mediaUploader()" class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Upload New Media (Images/Videos)</label>
            
            <div class="mb-4 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <label class="block text-sm font-medium text-gray-700">Assign to Subcategory</label>
                <select name="media_category" class="mt-1 block w-full md:w-1/2 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-brand-500 focus:border-brand-500 bg-white">
                    @if(isset($service) && $service->slug === 'interior-renders')
                        <option value="Residential">Residential</option>
                        <option value="Commercial">Commercial</option>
                    @elseif(isset($service) && $service->slug === 'floor-plans')
                        <option value="B&W">B&W</option>
                        <option value="Color">Color</option>
                        <option value="Site Plan">Site Plan</option>
                    @elseif(isset($service) && $service->slug === 'exterior-renders')
                        <option value="Residential">Residential</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Aerial Views">Aerial Views</option>
                        <option value="Landscape">Landscape</option>
                    @else
                        <option value="Residential">Residential</option>
                        <option value="Commercial">Commercial</option>
                    @endif
                </select>
                <p class="text-xs text-gray-500 mt-2">All files uploaded in this batch will be placed in this category tab on the front end.</p>
            </div>

            <div class="mb-4 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <label class="block text-sm font-medium text-gray-700">Add YouTube Video URL (Optional)</label>
                <input type="url" name="youtube_url" placeholder="https://www.youtube.com/watch?v=..." class="mt-1 block w-full md:w-1/2 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-brand-500 focus:border-brand-500 bg-white">
                <p class="text-xs text-gray-500 mt-2">Paste a YouTube link here to embed it. Make sure to choose the correct category above first.</p>
            </div>

            <!-- Drag and Drop Area -->
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-brand-300 border-dashed rounded-lg bg-brand-50 hover:bg-brand-100 transition-colors cursor-pointer relative" 
                 @click="$refs.fileInput.click()"
                 @dragover.prevent="$el.classList.add('bg-brand-200')"
                 @dragleave.prevent="$el.classList.remove('bg-brand-200')"
                 @drop.prevent="handleDrop($event, $el)">
                
                <div class="space-y-2 text-center text-brand-700">
                    <svg class="mx-auto h-12 w-12 text-brand-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-lg font-medium justify-center">
                        <span class="text-brand-600 bg-transparent relative z-10 pointer-events-none">Click to select files</span>
                        <input id="media_files" name="media_files[]" type="file" multiple accept="image/*,video/*" class="sr-only" x-ref="fileInput" @change="handleFiles($event.target.files)">
                    </div>
                    <p class="text-sm">or drag and drop here</p>
                    <p class="text-xs text-brand-500/70 pt-2">PNG, JPG, MP4 up to 20MB</p>
                </div>
            </div>

            <!-- Previews -->
            <template x-if="previews.length > 0">
                <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Ready to Upload</h4>
                        <span class="bg-brand-100 text-brand-800 text-xs px-2 py-1 rounded-full font-bold" x-text="previews.length + ' files selected'"></span>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <template x-for="(file, index) in previews" :key="index">
                            <div class="relative group rounded-lg overflow-hidden border border-gray-200 aspect-video bg-white flex items-center justify-center shadow-sm hover:shadow-md transition-shadow">
                                <!-- Image Preview -->
                                <template x-if="file.isImage">
                                    <img :src="file.url" class="object-cover w-full h-full">
                                </template>
                                
                                <!-- Video Preview -->
                                <template x-if="!file.isImage">
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gray-100 text-gray-500 p-2 text-center">
                                        <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        <span class="text-xs font-medium truncate w-full px-2" x-text="file.name"></span>
                                    </div>
                                </template>

                                <!-- Remove Button -->
                                <button type="button" @click.stop="removeFile(index)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 shadow-md hover:bg-red-600 focus:outline-none transition-transform hover:scale-110 z-10" title="Remove file">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                                
                                <!-- Overlay styling -->
                                <div class="absolute inset-0 border-2 border-transparent group-hover:border-red-500/50 pointer-events-none transition-colors rounded-lg"></div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-200">
            <button type="submit" class="px-8 py-3 bg-brand-600 text-white rounded-lg hover:bg-brand-500 font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Save & Upload All
            </button>
        </div>
    </form>

    @if(isset($service))
        @foreach($service->media as $media)
            <form id="delete-media-{{ $media->id }}" action="{{ route('admin.media.destroy', $media) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    @endif
</div>

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
// Initialize Quill editor
var quill = new Quill('#quill-editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link', 'blockquote', 'code-block'],
            ['clean']
        ]
    }
});

// Sync Quill content initially (for editing existing services)
document.querySelector('#hidden-description').value = quill.root.innerHTML;

// Sync Quill content to hidden textarea exactly upon every change
quill.on('text-change', function() {
    document.querySelector('#hidden-description').value = quill.root.innerHTML;
});

document.addEventListener('alpine:init', () => {
    Alpine.data('mediaUploader', () => ({
        previews: [],
        
        handleDrop(event, element) {
            element.classList.remove('bg-brand-200');
            if (event.dataTransfer.files.length > 0) {
                this.$refs.fileInput.files = event.dataTransfer.files;
                this.handleFiles(event.dataTransfer.files);
            }
        },
        
        handleFiles(fileList) {
            this.previews = [];
            const files = Array.from(fileList);
            
            files.forEach((file, index) => {
                const isImage = file.type.startsWith('image/');
                const url = isImage ? URL.createObjectURL(file) : null;
                
                this.previews.push({
                    file: file,
                    name: file.name,
                    isImage: isImage,
                    url: url
                });
            });
        },
        
        removeFile(index) {
            // Revoke object URL to prevent memory leaks
            if (this.previews[index].url) {
                URL.revokeObjectURL(this.previews[index].url);
            }
            
            // Remove from preview array
            this.previews.splice(index, 1);
            
            // Re-sync with actual file input using DataTransfer
            const dataTransfer = new DataTransfer();
            this.previews.forEach(p => {
                dataTransfer.items.add(p.file);
            });
            this.$refs.fileInput.files = dataTransfer.files;
        }
    }));
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const galleries = document.querySelectorAll('.sortable-gallery');
        galleries.forEach(gallery => {
            new Sortable(gallery, {
                animation: 150,
                ghostClass: 'opacity-50',
                onEnd: function (evt) {
                    const itemEl = evt.item;
                    const container = itemEl.parentElement;
                    const items = container.querySelectorAll('.sortable-item');
                    const orderedIds = Array.from(items).map(item => item.getAttribute('data-id'));
                    
                    fetch('{{ route('admin.media.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ordered_ids: orderedIds })
                    }).then(response => {
                        if (!response.ok) {
                            alert('Error updating order. Please refresh and try again.');
                        } else {
                            console.log('Order updated');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
