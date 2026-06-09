<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = \App\Models\Inquiry::with('service')->latest()->get();
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function storePublic(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'nullable|max:30',
            'service_id'  => 'nullable|exists:services,id',
            'message'     => 'required',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|max:20480|mimes:jpg,jpeg,png,pdf,dwg,dxf,zip,rar,doc,docx,xls,xlsx',
        ]);

        // Handle file uploads
        $uploadedPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('inquiry-attachments', 'public');
                $uploadedPaths[] = [
                    'path'          => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'size'          => $file->getSize(),
                    'mime'          => $file->getMimeType(),
                ];
            }
        }

        \App\Models\Inquiry::create([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'phone'       => $data['phone'] ?? null,
            'service_id'  => $data['service_id'] ?? null,
            'message'     => $data['message'],
            'attachments' => !empty($uploadedPaths) ? $uploadedPaths : null,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your inquiry has been sent successfully. We will get back to you soon!'
            ]);
        }

        return redirect()->route('contact')->with('success', 'Your inquiry has been sent successfully. We will get back to you soon!');
    }

    public function show(\App\Models\Inquiry $inquiry)
    {
        if ($inquiry->status === 'new') {
            $inquiry->update(['status' => 'read']);
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function destroy(\App\Models\Inquiry $inquiry)
    {
        // Delete stored files if any
        if ($inquiry->attachments) {
            foreach ($inquiry->attachments as $att) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($att['path']);
            }
        }
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
