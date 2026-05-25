<?php

// app/Http/Controllers/TenantController.php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\MaintenanceRequest;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function dashboard()
    {
        return view('tenant.dashboard', [
            'billings' => Billing::where('tenant_id', Auth::id())->latest()->get(),
            'requests' => MaintenanceRequest::where('tenant_id', Auth::id())->latest()->get(),
            'announcements' => Announcement::latest()->take(5)->get(),
        ]);
    }
}