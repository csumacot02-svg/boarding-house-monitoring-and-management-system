<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Boarding House Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-950">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-6xl grid md:grid-cols-2 rounded-3xl overflow-hidden shadow-2xl border border-white/10">

            <!-- LEFT SIDE -->
            <div class="hidden md:flex flex-col justify-center bg-gradient-to-br from-blue-700 via-slate-900 to-black p-14 text-white">

                <div class="w-20 h-20 rounded-3xl bg-white/10 flex items-center justify-center text-5xl mb-8">
                    🏠
                </div>

                <h1 class="text-5xl font-extrabold leading-tight">
                    Boarding House
                    Management System
                </h1>

                <p class="mt-6 text-slate-300 text-lg leading-relaxed">
                    A modern rental management platform for landlords,
                    tenants, and staff management.
                </p>

                <div class="mt-10 space-y-5">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                            🛏️
                        </div>
                        <div>
                            <h3 class="font-semibold">Room Monitoring</h3>
                            <p class="text-sm text-slate-300">
                                Track occupied and available rooms
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                            👥
                        </div>
                        <div>
                            <h3 class="font-semibold">Tenant Management</h3>
                            <p class="text-sm text-slate-300">
                                Manage tenant records easily
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                            💳
                        </div>
                        <div>
                            <h3 class="font-semibold">Billing & Payments</h3>
                            <p class="text-sm text-slate-300">
                                Monitor monthly payments and balances
                            </p>
                        </div>
                    </div>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="bg-white px-8 py-10 md:px-14 md:py-14">
                {{ $slot }}
            </div>

        </div>

    </div>

</body>
</html>