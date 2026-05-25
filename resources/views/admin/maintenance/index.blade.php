<x-app-layout>
    <x-slot name="header">
        Maintenance Management
    </x-slot>

    <div class="bg-white shadow rounded-2xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-900 text-white">
                <tr>
                    <th class="p-4 text-left">Tenant</th>
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4 text-left">Description</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Date Submitted</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($requests as $request)

                    <tr class="border-b">

                        <!-- Tenant -->
                        <td class="p-4">
                            {{ $request->tenant->name ?? 'Unknown Tenant' }}
                        </td>

                        <!-- Title -->
                        <td class="p-4">
                            {{ $request->title }}
                        </td>

                        <!-- Description -->
                        <td class="p-4">
                            {{ $request->description }}
                        </td>

                        <!-- Status -->
                        <td class="p-4">

                            @if($request->status === 'Resolved')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Resolved
                                </span>

                            @elseif($request->status === 'In Progress')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    In Progress
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Pending
                                </span>

                            @endif

                        </td>

                        <!-- Date -->
                        <td class="p-4">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>

                        <!-- Action -->
                        <td class="p-4">

                            <form
                                action="{{ route('maintenance.update', $request) }}"
                                method="POST"
                                class="space-y-2"
                            >
                                @csrf
                                @method('PUT')

                                <select
                                    name="status"
                                    class="border border-slate-300 rounded-lg px-3 py-2 w-full"
                                >
                                    <option
                                        value="Pending"
                                        {{ $request->status == 'Pending' ? 'selected' : '' }}
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="In Progress"
                                        {{ $request->status == 'In Progress' ? 'selected' : '' }}
                                    >
                                        In Progress
                                    </option>

                                    <option
                                        value="Resolved"
                                        {{ $request->status == 'Resolved' ? 'selected' : '' }}
                                    >
                                        Resolved
                                    </option>
                                </select>

                                <button
                                    type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg w-full"
                                >
                                    Update
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="p-6 text-center text-slate-500">
                            No maintenance requests found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</x-app-layout>