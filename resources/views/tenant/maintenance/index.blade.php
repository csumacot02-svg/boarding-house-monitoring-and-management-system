<x-app-layout>
    <x-slot name="header">
        Maintenance Requests
    </x-slot>

    <!-- Request Form -->
    <div class="bg-white shadow rounded-xl p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Submit Maintenance Request</h2>

        <form action="{{ route('maintenance.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Request Title
                </label>

                <input
                    type="text"
                    name="title"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Example: Broken Light"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Describe the issue..."
                    required
                ></textarea>
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                Submit Request
            </button>
        </form>
    </div>

    <!-- Requests Table -->
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-900 text-white">
                <tr>
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4 text-left">Description</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Date Submitted</th>
                </tr>
            </thead>

            <tbody>
                @forelse($requests as $request)
                    <tr class="border-b">
                        <td class="p-4">
                            {{ $request->title }}
                        </td>

                        <td class="p-4">
                            {{ $request->description }}
                        </td>

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

                        <td class="p-4">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-slate-500">
                            No maintenance requests found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>