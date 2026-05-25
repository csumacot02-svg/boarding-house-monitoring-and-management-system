<x-app-layout>
    <x-slot name="header">
        Room Management
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-slate-800">Rooms List</h3>
        <a href="{{ route('rooms.create') }}" class="btn-primary">+ Add Room</a>
    </div>

    <table class="table-style">
        <thead>
            <tr>
                <th>Room No.</th>
                <th>Capacity</th>
                <th>Occupied</th>
                <th>Monthly Rent</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($rooms as $room)
                <tr>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>{{ $room->occupied }}</td>
                    <td>₱{{ number_format($room->monthly_rent, 2) }}</td>
                    <td>
                        @if($room->status === 'Available')
                            <span class="badge-green">Available</span>
                        @else
                            <span class="badge-red">{{ $room->status }}</span>
                        @endif
                    </td>
                    <td class="space-x-2">
                        <a href="{{ route('rooms.edit', $room) }}" class="text-blue-600 font-semibold">Edit</a>

                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this room?')" class="text-red-600 font-semibold">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-slate-500">No rooms found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-app-layout>