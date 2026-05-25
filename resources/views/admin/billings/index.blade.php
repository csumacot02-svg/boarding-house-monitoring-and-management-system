<x-app-layout>
    <x-slot name="header">
        Billing Management
    </x-slot>

    <!-- Create Billing Form -->
    <div class="bg-white shadow rounded-2xl p-6 mb-6">
        <h2 class="text-2xl font-bold mb-6 text-slate-800">
            Create Billing Record
        </h2>

        <form action="{{ route('billings.store') }}" method="POST">
            @csrf

            <!-- Tenant -->
            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Select Tenant
                </label>

                <select
                    name="tenant_id"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    required
                >
                    <option value="">Choose Tenant</option>

                    @foreach(\App\Models\User::where('role', 'tenant')->get() as $tenant)
                        <option value="{{ $tenant->id }}">
                            {{ $tenant->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Amount -->
            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Amount
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="amount"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    placeholder="Enter amount"
                    required
                >
            </div>

            <!-- Due Date -->
            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Due Date
                </label>

                <input
                    type="date"
                    name="due_date"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    required
                >
            </div>

            <!-- Month -->
            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Billing Month
                </label>

                <input
                    type="text"
                    name="month"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    placeholder="Example: May 2026"
                    required
                >
            </div>

            <!-- Status -->
            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    required
                >
                    <option value="Unpaid">Unpaid</option>
                    <option value="Partial">Partial</option>
                    <option value="Paid">Paid</option>
                </select>
            </div>

            <!-- Remarks -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Remarks
                </label>

                <textarea
                    name="remarks"
                    rows="3"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    placeholder="Optional remarks..."
                ></textarea>
            </div>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold"
            >
                Create Billing
            </button>
        </form>
    </div>
</x-app-layout>