<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function destroy(\App\Models\Media $media)
    {
        if ($media->source === 'upload') {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($media->file_path);
        }
        $media->delete();

        return back()->with('success', 'Media deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ordered_ids' => 'required|array',
            'ordered_ids.*' => 'integer|exists:media,id',
        ]);

        $order = 1;
        foreach ($request->ordered_ids as $id) {
            \App\Models\Media::where('id', $id)->update(['sort_order' => $order]);
            $order++;
        }

        return response()->json(['status' => 'success']);
    }
}
