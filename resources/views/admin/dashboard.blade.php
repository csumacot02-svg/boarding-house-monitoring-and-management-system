<x-app-layout>
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="card">
            <p class="card-title">Total Tenants</p>
            <p class="card-number">{{ $tenants }}</p>
        </div>

        <div class="card">
            <p class="card-title">Total Rooms</p>
            <p class="card-number">{{ $rooms }}</p>
        </div>

        <div class="card">
            <p class="card-title">Unpaid Bills</p>
            <p class="card-number text-red-600">{{ $unpaid }}</p>
        </div>

        <div class="card">
            <p class="card-title">Pending Maintenance</p>
            <p class="card-number text-orange-500">{{ $maintenance }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="card">
            <h3 class="text-xl font-bold mb-4">System Shortcuts</h3>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('rooms.index') }}" class="btn-primary text-center">Manage Rooms</a>
                <a href="{{ route('billings.index') }}" class="btn-success text-center">Billings</a>
                <a href="{{ route('maintenance.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-center">Maintenance</a>
                <a href="{{ route('announcements.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl text-center">Announcements</a>
            </div>
        </div>

        <div class="card">
            <h3 class="text-xl font-bold mb-4">Recent Announcements</h3>

            @forelse($announcements as $announcement)
                <div class="border-b py-3">
                    <h4 class="font-semibold">{{ $announcement->title }}</h4>
                    <p class="text-sm text-slate-500">{{ Str::limit($announcement->message, 80) }}</p>
                </div>
            @empty
                <p class="text-slate-500">No announcements posted yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>