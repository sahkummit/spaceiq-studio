<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settingsData = $request->except(['_token', '_method']);
        
        foreach ($settingsData as $key => $value) {
            \App\Models\Setting::where('key', $key)->update(['value' => $value]);
        }
        
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
