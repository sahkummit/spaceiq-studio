@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-3xl text-gray-900 font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
    <!-- Stat Card: Total Services -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 bg-brand-100 rounded-full text-brand-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500text-sm font-medium">Total Services</p>
                <p class="text-2xl text-gray-900 font-bold">{{ $serviceCount }}</p>
            </div>
        </div>
    </div>

    <!-- Stat Card: New Inquiries -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">New Inquiries</p>
                <p class="text-2xl text-gray-900 font-bold">{{ $newInquiryCount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Recent Inquiries</h2>
    </div>
    <div class="p-6">
        @if($recentInquiries->isEmpty())
            <p class="text-gray-500">No new inquiries at the moment.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentInquiries as $inquiry)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inquiry->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $inquiry->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
