<x-app-layout>
    <x-slot name="header">
        GCash Payment Receipts
    </x-slot>

    <div class="p-6 space-y-6">

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:14px 20px; border-radius:16px; font-weight:700;">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <div style="background: linear-gradient(135deg, #2563eb, #4f46e5); color:white; padding:32px; border-radius:24px; box-shadow:0 10px 25px rgba(0,0,0,.15);">
            <h1 style="font-size:30px; font-weight:900; display:flex; align-items:center; gap:12px;">
                <i class="fa-solid fa-receipt"></i>
                GCash Payment Verification
            </h1>

            <p style="color:#dbeafe; margin-top:8px;">
                Review tenant payment receipts and verify payments.
            </p>
        </div>

        <div style="background:white; border-radius:24px; overflow:hidden; box-shadow:0 10px 25px rgba(0,0,0,.08); border:1px solid #e5e7eb;">

            <table style="width:100%; border-collapse:collapse;">
                <thead style="background:#0f172a; color:white;">
                    <tr>
                        <th style="padding:16px; text-align:left;">Tenant</th>
                        <th style="padding:16px; text-align:left;">Month</th>
                        <th style="padding:16px; text-align:left;">Amount</th>
                        <th style="padding:16px; text-align:left;">Reference</th>
                        <th style="padding:16px; text-align:left;">Receipt</th>
                        <th style="padding:16px; text-align:left;">Status</th>
                        <th style="padding:16px; text-align:left;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($billings as $billing)
                        <tr style="border-bottom:1px solid #e5e7eb;">
                            <td style="padding:16px; font-weight:700;">
                                {{ $billing->tenant->name ?? 'Unknown Tenant' }}
                            </td>

                            <td style="padding:16px;">
                                {{ $billing->month }}
                            </td>

                            <td style="padding:16px; font-weight:700;">
                                ₱{{ number_format($billing->amount, 2) }}
                            </td>

                            <td style="padding:16px;">
                                {{ $billing->gcash_reference_number ?? 'N/A' }}
                            </td>

                            <td style="padding:16px;">
                                <a href="{{ asset('storage/' . $billing->gcash_receipt_path) }}"
                                   target="_blank"
                                   style="background:#dbeafe; color:#1d4ed8; padding:10px 14px; border-radius:12px; text-decoration:none; font-weight:700;">
                                    <i class="fa-solid fa-image"></i>
                                    View Receipt
                                </a>
                            </td>

                            <td style="padding:16px;">
                                @if($billing->status === 'Paid')
                                    <span style="background:#dcfce7; color:#166534; padding:8px 12px; border-radius:999px; font-size:12px; font-weight:700;">
                                        Paid
                                    </span>
                                @else
                                    <span style="background:#fef9c3; color:#854d0e; padding:8px 12px; border-radius:999px; font-size:12px; font-weight:700;">
                                        {{ $billing->status }}
                                    </span>
                                @endif
                            </td>

                            <td style="padding:16px;">
                                @if($billing->status !== 'Paid')
                                    <form action="{{ route('admin.gcash.verify', $billing) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                                style="background:#16a34a; color:white; padding:10px 16px; border:none; border-radius:12px; font-weight:700; cursor:pointer;">
                                            <i class="fa-solid fa-check"></i>
                                            Verify
                                        </button>
                                    </form>
                                @else
                                    <span style="color:#16a34a; font-weight:700;">
                                        Verified
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding:40px; text-align:center; color:#64748b;">
                                No uploaded GCash receipts yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>