@extends('layouts.admin')

@section('title', 'Manage Settings')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200" x-data="{ tab: 'general' }">
    <div class="border-b border-gray-200">
        <nav class="flex -mb-px px-6" aria-label="Tabs">
            <template x-for="(groupKey, index) in {{ json_encode($settings->keys()) }}" :key="index">
                <button
                    @click="tab = groupKey"
                    :class="tab === groupKey ? 'border-brand-500 text-brand-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm capitalize"
                    x-text="groupKey">
                </button>
            </template>
        </nav>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <div>
                @foreach($settings as $group => $groupedSettings)
                <div x-show="tab === '{{ $group }}'" :class="{ 'hidden': tab !== '{{ $group }}' }">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4 capitalize">{{ $group }} Settings</h3>
                    
                    <div class="space-y-6 max-w-3xl">
                        @foreach($groupedSettings as $setting)
                        <div>
                            <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700 capitalize">
                                {{ str_replace('_', ' ', $setting->key) }}
                            </label>
                            <div class="mt-1">
                                @if($setting->type == 'textarea')
                                    <textarea id="{{ $setting->key }}" name="{{ $setting->key }}" rows="3" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">{{ $setting->value }}</textarea>
                                @else
                                    <input type="text" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ $setting->value }}" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8 pt-5 border-t border-gray-200">
                <div class="flex justify-end">
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                        Save all settings
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
