<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $serviceCount = \App\Models\Service::count();
        $newInquiryCount = \App\Models\Inquiry::where('status', 'new')->count();
        $recentInquiries = \App\Models\Inquiry::latest()->take(5)->get();

        return view('admin.dashboard', compact('serviceCount', 'newInquiryCount', 'recentInquiries'));
    }
}
