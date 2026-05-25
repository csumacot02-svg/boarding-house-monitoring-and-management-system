<x-app-layout>
    <x-slot name="header">
        Payment Monitoring Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-500">Total Billings</p>
            <h2 class="text-4xl font-bold">{{ $totalBillings }}</h2>
            <p class="mt-2 text-sm">₱{{ number_format($totalAmount, 2) }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-500">Paid</p>
            <h2 class="text-4xl font-bold text-green-600">{{ $paid }}</h2>
            <p class="mt-2 text-sm">₱{{ number_format($paidAmount, 2) }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-500">Unpaid</p>
            <h2 class="text-4xl font-bold text-red-600">{{ $unpaid }}</h2>
            <p class="mt-2 text-sm">₱{{ number_format($unpaidAmount, 2) }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-500">Partial</p>
            <h2 class="text-4xl font-bold text-yellow-500">{{ $partial }}</h2>
            <p class="mt-2 text-sm">₱{{ number_format($partialAmount, 2) }}</p>
        </div>

    </div>

    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold">Recent Billing Records</h2>
        </div>

        <table class="w-full">
            <thead class="bg-slate-900 text-white">
                <tr>
                    <th class="p-4 text-left">Tenant</th>
                    <th class="p-4 text-left">Month</th>
                    <th class="p-4 text-left">Amount</th>
                    <th class="p-4 text-left">Due Date</th>
                    <th class="p-4 text-left">Status</th>
                </tr>
            </thead>

        <tbody>
            @forelse($recentBillings as $billing)

                <tr class="border-b">

                    <!-- Tenant -->
                    <td class="p-4">
                        {{ $billing->tenant->name ?? 'Unknown' }}
                    </td>

                    <!-- Month -->
                    <td class="p-4">
                        {{ $billing->month }}
                    </td>

                    <!-- Amount -->
                    <td class="p-4">
                        ₱{{ number_format($billing->amount, 2) }}
                    </td>

                    <!-- Due Date -->
                    <td class="p-4">
                        {{ $billing->due_date }}
                    </td>

                    <!-- Current Status -->
                    <td class="p-4">

                        @if($billing->status === 'Paid')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Paid
                            </span>

                        @elseif($billing->status === 'Partial')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                Partial
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Unpaid
                            </span>

                        @endif

                    </td>

                    <!-- Update Payment -->
                    <td class="p-4">

                        <form
                            action="{{ route('billings.update', $billing) }}"
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
                                    value="Unpaid"
                                    {{ $billing->status == 'Unpaid' ? 'selected' : '' }}
                                >
                                    Unpaid
                                </option>

                                <option
                                    value="Partial"
                                    {{ $billing->status == 'Partial' ? 'selected' : '' }}
                                >
                                    Partial
                                </option>

                                <option
                                    value="Paid"
                                    {{ $billing->status == 'Paid' ? 'selected' : '' }}
                                >
                                    Paid
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
                        No billing records found.
                    </td>
                </tr>

            @endforelse
        </tbody>
        </table>
    </div>
</x-app-layout>