<x-app-layout>
    <x-slot name="header">
        Tenant Dashboard
    </x-slot>

    <div class="card mb-6">
        <h3 class="text-2xl font-bold text-slate-800">Hello, {{ Auth::user()->name }}!</h3>
        <p class="text-slate-500 mt-1">
            View your billing records, announcements, and maintenance request updates.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('billings.index') }}" class="card hover:shadow-lg transition">
            <p class="card-title">Billing Records</p>
            <p class="card-number">{{ $billings->count() }}</p>
        </a>

        <a href="{{ route('maintenance.index') }}" class="card hover:shadow-lg transition">
            <p class="card-title">Maintenance Requests</p>
            <p class="card-number">{{ $requests->count() }}</p>
        </a>

        <a href="{{ route('announcements.index') }}" class="card hover:shadow-lg transition">
            <p class="card-title">Announcements</p>
            <p class="card-number">{{ $announcements->count() }}</p>
        </a>
    </div>
</x-app-layout>