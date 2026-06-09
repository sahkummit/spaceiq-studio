@extends('layouts.admin')

@section('title', 'View Inquiry')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.inquiries.index') }}" class="text-brand-600 hover:underline">&larr; Back to Inquiries</a>
</div>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Inquiry Details</h1>
    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 font-medium shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Delete
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 pb-8 border-b border-gray-200">
            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">From</h4>
                <p class="text-lg font-medium text-gray-900">{{ $inquiry->name }}</p>
                <a href="mailto:{{ $inquiry->email }}" class="text-brand-600 hover:underline">{{ $inquiry->email }}</a>
                @if($inquiry->phone)
                    <p class="text-gray-600 mt-1">{{ $inquiry->phone }}</p>
                @endif
            </div>
            
            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Details</h4>
                <p class="text-gray-900 whitespace-nowrap mb-1">
                    <span class="font-medium">Received:</span> {{ $inquiry->created_at->format('M d, Y h:i A') }}
                </p>
                <p class="text-gray-900 mb-2">
                    <span class="font-medium">Interested in:</span> 
                    @if($inquiry->service)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-100 text-brand-800">
                            {{ $inquiry->service->title }}
                        </span>
                    @else
                        <span class="text-gray-500 italic">General Inquiry</span>
                    @endif
                </p>
                <p class="text-gray-900 whitespace-nowrap">
                    <span class="font-medium">Status:</span> 
                    @if($inquiry->status === 'new')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 uppercase tracking-wider">New</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 uppercase tracking-wider">Read</span>
                    @endif
                </p>
            </div>
        </div>
        
        <div>
            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Message</h4>
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 text-gray-800 leading-relaxed font-serif text-lg">
                {!! nl2br(e($inquiry->message)) !!}
            </div>
        </div>

        @if($inquiry->attachments && count($inquiry->attachments) > 0)
        <div class="mt-8 pt-8 border-t border-gray-200">
            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">
                Attachments
                <span class="ml-2 text-xs font-normal text-gray-400 normal-case tracking-normal">({{ count($inquiry->attachments) }} file{{ count($inquiry->attachments) > 1 ? 's' : '' }})</span>
            </h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($inquiry->attachments as $att)
                @php
                    $ext = strtolower(pathinfo($att['original_name'], PATHINFO_EXTENSION));
                    $icon = match(true) {
                        in_array($ext, ['jpg','jpeg','png']) => '🖼️',
                        $ext === 'pdf'                        => '📄',
                        in_array($ext, ['dwg','dxf'])        => '📐',
                        in_array($ext, ['zip','rar'])        => '🗜️',
                        in_array($ext, ['doc','docx'])       => '📝',
                        in_array($ext, ['xls','xlsx'])       => '📊',
                        default                              => '📎',
                    };
                    $sizeMB = $att['size'] > 1048576
                        ? round($att['size']/1048576, 1).' MB'
                        : round($att['size']/1024, 1).' KB';
                @endphp
                <a href="{{ Storage::url($att['path']) }}" target="_blank"
                   class="flex items-center gap-3 px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg hover:bg-brand-50 hover:border-brand-300 transition-colors group">
                    <span class="text-2xl flex-shrink-0">{{ $icon }}</span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate group-hover:text-brand-700">{{ $att['original_name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $sizeMB }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-brand-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        
        <div class="mt-8 pt-8 border-t border-gray-200 flex justify-end">
            <a href="mailto:{{ $inquiry->email }}?subject=Reply to your inquiry regarding {{ $inquiry->service ? $inquiry->service->title : 'Space IQ Design Studio' }}" class="px-6 py-3 bg-brand-600 text-white rounded-lg hover:bg-brand-500 font-bold shadow-md transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Reply via Email
            </a>
        </div>
    </div>
</div>
@endsection
