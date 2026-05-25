<x-app-layout>
    <x-slot name="header">
        Announcements
    </x-slot>

    <div class="space-y-6">

        @forelse($announcements as $announcement)

            <div class="bg-white shadow rounded-2xl p-6">

                <!-- Title -->
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $announcement->title }}
                    </h2>

                    <span class="text-sm text-slate-500">
                        {{ $announcement->created_at->format('M d, Y') }}
                    </span>
                </div>

                <!-- Message -->
                <p class="text-slate-700 leading-relaxed">
                    {{ $announcement->message }}
                </p>

            </div>

        @empty

            <div class="bg-white shadow rounded-2xl p-8 text-center text-slate-500">
                No announcements available.
            </div>

        @endforelse

    </div>
</x-app-layout>