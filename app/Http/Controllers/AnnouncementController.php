<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $announcements = Announcement::with('tenant')->latest()->get();
            $tenants = User::where('role', 'tenant')->orderBy('name')->get();

            return view('admin.announcements.index', compact('announcements', 'tenants'));
        }

        $announcements = Announcement::visibleToTenant(Auth::id())->latest()->get();

        return view('tenant.announcements.index', compact('announcements'));
    }

    public function store(Request $request)
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $data = $request->validate([
            'tenant_id' => ['nullable', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        if (!empty($data['tenant_id'])) {
            $tenant = User::where('role', 'tenant')->findOrFail($data['tenant_id']);
            $data['tenant_id'] = $tenant->id;
        }

        Announcement::create($data);

        return back()->with('success', 'Message sent successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $announcement->delete();

        return back()->with('success', 'Announcement deleted.');
    }
}