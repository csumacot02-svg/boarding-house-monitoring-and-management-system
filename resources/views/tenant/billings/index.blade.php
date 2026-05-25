<x-app-layout>
    <x-slot name="header">
        My Rent Payments
    </x-slot>

    <div class="p-6 space-y-6">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-5 py-3 rounded-2xl font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="md:col-span-2 bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-8 rounded-3xl shadow">
                <h1 class="text-3xl font-black flex items-center gap-3">
                    <i class="fa-solid fa-wallet"></i>
                    Pay Rent via GCash
                </h1>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white/20 p-5 rounded-2xl">
                        <p class="text-blue-100 text-sm">GCash Number</p>
                        <h2 class="text-2xl font-black">
                            {{ $paymentSetting->gcash_number }}
                        </h2>
                    </div>

                    <div class="bg-white/20 p-5 rounded-2xl">
                        <p class="text-blue-100 text-sm">Account Name</p>
                        <h2 class="text-2xl font-black">
                            {{ $paymentSetting->gcash_account_name }}
                        </h2>
                    </div>
                </div>

                <p class="mt-5 text-blue-100">
                    {{ $paymentSetting->payment_instructions }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow border">
                <div class="text-blue-600 text-4xl mb-3">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                </div>
                <h2 class="text-xl font-black">Upload Receipt</h2>
                <p class="text-gray-500 mt-2">
                    After paying your rent, upload a screenshot or photo of your GCash receipt.
                </p>
            </div>

        </div>

        <div class="bg-white rounded-3xl shadow border overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <th class="p-4 text-left">Month</th>
                        <th class="p-4 text-left">Amount</th>
                        <th class="p-4 text-left">Due Date</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Receipt</th>
                        <th class="p-4 text-left">Upload Payment Proof</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($billings as $billing)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 font-bold">
                                <i class="fa-solid fa-calendar text-blue-600"></i>
                                {{ $billing->month }}
                            </td>

                            <td class="p-4 font-bold">
                                ₱{{ number_format($billing->amount, 2) }}
                            </td>

                            <td class="p-4">
                                {{ $billing->due_date }}
                            </td>

                            <td class="p-4">
                                @if($billing->status === 'Paid')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                        Paid
                                    </span>
                                @elseif($billing->status === 'Submitted')
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                        Submitted
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $billing->status }}
                                    </span>
                                @endif
                            </td>

                            <td class="p-4">
                                @if($billing->gcash_receipt_path)
                                    <a href="{{ asset('storage/' . $billing->gcash_receipt_path) }}"
                                       target="_blank"
                                       class="text-blue-600 font-bold underline">
                                        View Receipt
                                    </a>

                                    <p class="text-xs text-gray-500 mt-1">
                                        Ref: {{ $billing->gcash_reference_number ?? 'N/A' }}
                                    </p>
                                @else
                                    <span class="text-gray-400">No receipt</span>
                                @endif
                            </td>

                            <td class="p-4 min-w-[280px]">
                                @if($billing->status !== 'Paid')
                                    <form action="{{ route('tenant.billings.upload-receipt', $billing) }}"
                                          method="POST"
                                          enctype="multipart/form-data"
                                          class="space-y-2">
                                        @csrf

                                        <input type="text"
                                               name="gcash_reference_number"
                                               placeholder="GCash reference number"
                                               class="w-full rounded-xl border-gray-300">

                                        <input type="file"
                                               name="gcash_receipt"
                                               accept="image/*"
                                               class="w-full rounded-xl border-gray-300"
                                               required>

                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-bold">
                                            <i class="fa-solid fa-upload"></i>
                                            Upload Receipt
                                        </button>
                                    </form>
                                @else
                                    <span class="text-green-600 font-bold">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Payment Verified
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                No billing records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>