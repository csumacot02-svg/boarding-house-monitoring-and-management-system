<x-app-layout>
    <x-slot name="header">
        GCash Settings
    </x-slot>

    <div class="p-6 max-w-5xl mx-auto space-y-8">

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl font-bold shadow-sm">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Hero Card -->
        <div style="background: linear-gradient(135deg, #2563eb, #4f46e5);"
             class="text-white p-8 rounded-[28px] shadow-2xl relative overflow-hidden">

            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-12 -left-10 w-52 h-52 bg-white/10 rounded-full"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur">
                        <i class="fa-solid fa-wallet text-3xl"></i>
                    </div>

                    <div>
                        <h1 class="text-3xl font-black">
                            Admin GCash Payment Details
                        </h1>

                        <p class="text-blue-100 mt-1">
                            Configure the GCash information visible to tenants.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                        <p class="text-blue-100 text-sm mb-1">Payment Method</p>
                        <h2 class="text-xl font-black">GCash</h2>
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                        <p class="text-blue-100 text-sm mb-1">Status</p>
                        <h2 class="text-xl font-black">Active</h2>
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                        <p class="text-blue-100 text-sm mb-1">System</p>
                        <h2 class="text-xl font-black">Online Payments</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form method="POST"
              action="{{ route('admin.gcash.update') }}"
              class="bg-white rounded-[28px] shadow-xl border border-slate-200 overflow-hidden">

            @csrf
            @method('PUT')

            <div class="p-8 border-b bg-slate-50">
                <h2 class="text-2xl font-black text-slate-800 flex items-center gap-3">
                    <i class="fa-solid fa-gear text-blue-600"></i>
                    Payment Configuration
                </h2>

                <p class="text-slate-500 mt-2">
                    Update your official GCash account information for tenant payments.
                </p>
            </div>

            <div class="p-8 space-y-8">

                <!-- GCash Number -->
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3">
                        <i class="fa-solid fa-mobile-screen text-blue-600 mr-2"></i>
                        GCash Number
                    </label>

                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fa-solid fa-phone"></i>
                        </span>

                        <input type="text"
                               name="gcash_number"
                               value="{{ old('gcash_number', $setting->gcash_number) }}"
                               placeholder="09XXXXXXXXX"
                               class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition text-lg font-semibold"
                               required>
                    </div>
                </div>

                <!-- Account Name -->
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3">
                        <i class="fa-solid fa-user text-blue-600 mr-2"></i>
                        GCash Account Name
                    </label>

                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fa-solid fa-id-card"></i>
                        </span>

                        <input type="text"
                               name="gcash_account_name"
                               value="{{ old('gcash_account_name', $setting->gcash_account_name) }}"
                               placeholder="Enter account holder name"
                               class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition text-lg font-semibold"
                               required>
                    </div>
                </div>

                <!-- Instructions -->
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-3">
                        <i class="fa-solid fa-circle-info text-blue-600 mr-2"></i>
                        Payment Instructions
                    </label>

                    <textarea name="payment_instructions"
                              rows="5"
                              placeholder="Example: Send your rent payment through GCash and upload your receipt after payment."
                              class="w-full px-5 py-4 rounded-2xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition">{{ old('payment_instructions', $setting->payment_instructions) }}</textarea>
                </div>

            </div>

            <!-- Footer -->
            <div class="bg-slate-50 border-t px-8 py-6 flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-black shadow-lg transition hover:scale-105">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Save GCash Details
                </button>
            </div>
        </form>

    </div>
</x-app-layout>