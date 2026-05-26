<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Billing;
use App\Models\MaintenanceRequest;
use App\Models\Announcement;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'tenants' => User::where('role', 'tenant')->count(),
            'tenantList' => User::where('role', 'tenant')->orderBy('name')->get(),
            'rooms' => Room::count(),
            'unpaid' => Billing::where('status', 'Unpaid')->count(),
            'maintenance' => MaintenanceRequest::where('status', 'Pending')->count(),
            'announcements' => Announcement::with('tenant')->latest()->take(5)->get(),
        ]);
    }
}