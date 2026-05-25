<?php

// app/Http/Controllers/MaintenanceRequestController.php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $requests = MaintenanceRequest::with('tenant')->latest()->get();
            return view('admin.maintenance.index', compact('requests'));
        }

        $requests = MaintenanceRequest::where('tenant_id', Auth::id())->latest()->get();
        return view('tenant.maintenance.index', compact('requests'));
    }

    public function create()
    {
        return view('tenant.maintenance.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        MaintenanceRequest::create([
            'tenant_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending'
        ]);

        return redirect()->route('maintenance.index')->with('success', 'Maintenance request submitted.');
    }

    public function edit(MaintenanceRequest $maintenance)
    {
        return view('admin.maintenance.edit', [
            'request' => $maintenance
        ]);
    }

    public function update(Request $request, MaintenanceRequest $maintenance)
    {
        $maintenance->update([
            'status' => $request->status
        ]);

        return redirect()->route('maintenance.index')->with('success', 'Request status updated.');
    }

    public function destroy(MaintenanceRequest $maintenance)
    {
        $maintenance->delete();

        return back()->with('success', 'Request deleted.');
    }
}