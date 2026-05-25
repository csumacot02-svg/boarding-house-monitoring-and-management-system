<x-app-layout>
    <x-slot name="header">
        Announcement Management
    </x-slot>

    <!-- Create Announcement -->
    <div class="bg-white shadow rounded-2xl p-6 mb-6">

        <h2 class="text-2xl font-bold mb-6 text-slate-800">
            Post New Announcement
        </h2>

        <form action="{{ route('announcements.store') }}" method="POST">
            @csrf

            <!-- Title -->
            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Announcement Title
                </label>

                <input
                    type="text"
                    name="title"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    placeholder="Enter announcement title"
                    required
                >
            </div>

            <!-- Message -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Announcement Message
                </label>

                <textarea
                    name="message"
                    rows="5"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    placeholder="Write your announcement..."
                    required
                ></textarea>
            </div>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold"
            >
                Post Announcement
            </button>
        </form>
    </div>

    <!-- Announcement List -->
    <div class="space-y-6">

        @forelse($announcements as $announcement)

            <div class="bg-white shadow rounded-2xl p-6">

                <!-- Top -->
                <div class="flex items-center justify-between mb-3">

                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $announcement->title }}
                    </h2>

                    <span class="text-sm text-slate-500">
                        {{ $announcement->created_at->format('M d, Y') }}
                    </span>

                </div>

                <!-- Message -->
                <p class="text-slate-700 leading-relaxed mb-4">
                    {{ $announcement->message }}
                </p>

                <!-- Delete -->
                <form
                    action="{{ route('announcements.destroy', $announcement) }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Delete this announcement?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl"
                    >
                        Delete Announcement
                    </button>
                </form>

            </div>

        @empty

            <div class="bg-white shadow rounded-2xl p-8 text-center text-slate-500">
                No announcements available.
            </div>

        @endforelse

    </div>
</x-app-layout>