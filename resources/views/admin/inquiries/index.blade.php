@extends('layouts.admin')

@section('title', 'Manage Inquiries')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Inquiries</h1>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($inquiries as $inquiry)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $inquiry->created_at->format('M d, Y H:i') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $inquiry->name }}</div>
                    <div class="text-sm text-gray-500">{{ $inquiry->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $inquiry->service ? $inquiry->service->title : 'General Inquiry' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($inquiry->status === 'new')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">New</span>
                    @elseif($inquiry->status === 'read')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Read</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Replied</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-brand-600 hover:text-brand-900 font-bold bg-brand-50 hover:bg-brand-100 px-4 py-2 rounded-md transition-colors border border-brand-200 shadow-sm">View Message</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No inquiries found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
