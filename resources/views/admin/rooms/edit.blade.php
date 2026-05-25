<x-app-layout>
    <x-slot name="header">
        Edit Room
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-2xl p-8">

        <h2 class="text-2xl font-bold mb-6 text-slate-800">
            Update Room Information
        </h2>

        <form action="{{ route('rooms.update', $room) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Room Number -->
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-2">
                    Room Number
                </label>

                <input
                    type="text"
                    name="room_number"
                    value="{{ $room->room_number }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <!-- Capacity -->
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-2">
                    Capacity
                </label>

                <input
                    type="number"
                    name="capacity"
                    value="{{ $room->capacity }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <!-- Occupied -->
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-2">
                    Occupied Slots
                </label>

                <input
                    type="number"
                    name="occupied"
                    value="{{ $room->occupied }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <!-- Monthly Rent -->
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-2">
                    Monthly Rent
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="monthly_rent"
                    value="{{ $room->monthly_rent }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required
                >
                    <option value="Available" {{ $room->status == 'Available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="Full" {{ $room->status == 'Full' ? 'selected' : '' }}>
                        Full
                    </option>

                    <option value="Maintenance" {{ $room->status == 'Maintenance' ? 'selected' : '' }}>
                        Maintenance
                    </option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold"
                >
                    Update Room
                </button>

                <a
                    href="{{ route('rooms.index') }}"
                    class="bg-slate-200 hover:bg-slate-300 text-slate-800 px-6 py-3 rounded-xl font-semibold"
                >
                    Cancel
                </a>

            </div>
        </form>
    </div>
</x-app-layout>