<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = \App\Models\Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|string|max:255',
            'slug' => 'required|max:255|unique:services,slug',
            'short_description' => 'nullable',
            'description' => 'required',
            'icon' => 'nullable',
            'is_active' => 'boolean',
            'media_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,webm|max:20480',
            'youtube_url' => 'nullable|url',
        ]);
        
        $service = \App\Models\Service::create($data);

        if ($request->hasFile('media_files')) {
            $this->handleMediaUploads($request, $service);
        }

        if ($request->filled('youtube_url')) {
            $service->media()->create([
                'title' => 'YouTube Video',
                'file_path' => $request->input('youtube_url'),
                'source' => 'url',
                'file_type' => 'video',
                'category' => $request->input('media_category', 'Residential'),
            ]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit(\App\Models\Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, \App\Models\Service $service)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|string|max:255',
            'slug' => 'required|max:255|unique:services,slug,' . $service->id,
            'short_description' => 'nullable',
            'description' => 'required',
            'icon' => 'nullable',
            'is_active' => 'boolean',
            'media_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,webm|max:20480',
            'youtube_url' => 'nullable|url',
        ]);

        $service->update($data);

        if ($request->has('media_sort') && is_array($request->input('media_sort'))) {
            foreach ($request->input('media_sort') as $mediaId => $sortOrder) {
                \App\Models\Media::where('id', $mediaId)
                    ->where('service_id', $service->id)
                    ->update(['sort_order' => (int) $sortOrder]);
            }
        }

        if ($request->hasFile('media_files')) {
            $this->handleMediaUploads($request, $service);
        }

        if ($request->filled('youtube_url')) {
            $service->media()->create([
                'title' => 'YouTube Video',
                'file_path' => $request->input('youtube_url'),
                'source' => 'url',
                'file_type' => 'video',
                'category' => $request->input('media_category', 'Residential'),
            ]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(\App\Models\Service $service)
    {
        // Delete associated files
        foreach ($service->media as $media) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($media->file_path);
        }
        $service->media()->delete();
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    private function handleMediaUploads(Request $request, \App\Models\Service $service)
    {
        foreach ($request->file('media_files') as $file) {
            $path = $file->store('services', 'public');
            
            $mimeType = $file->getMimeType();
            $fileType = str_starts_with($mimeType, 'video') ? 'video' : 'image';

            $service->media()->create([
                'title' => $file->getClientOriginalName(),
                'file_path' => $path,
                'source' => 'upload',
                'file_type' => $fileType,
                'category' => $request->input('media_category', 'Residential'),
            ]);
        }
    }
}
