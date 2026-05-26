<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boarding House Management System</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="data:,">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            font-weight: 600;
            color: #cbd5e1;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            background: #1e293b;
            color: white;
            transform: translateX(4px);
        }

        .nav-icon {
            width: 22px;
            text-align: center;
            color: #60a5fa;
        }
    </style>
</head>

<body class="font-sans bg-slate-100">
<div class="min-h-screen flex">

    <aside class="w-72 bg-slate-950 text-white hidden md:flex flex-col shadow-2xl">
        <div class="p-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center shadow">
                    <i class="fa-solid fa-house-user text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black">Boarding House</h1>
                    <p class="text-sm text-slate-400">Management System</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fa-solid fa-chart-line nav-icon"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.payment.dashboard') }}" class="nav-link">
                    <i class="fa-solid fa-coins nav-icon"></i>
                    Payment Dashboard
                </a>

                <a href="{{ route('admin.gcash.edit') }}" class="nav-link">
                    <i class="fa-solid fa-wallet nav-icon"></i>
                    GCash Settings
                </a>

                <a href="{{ route('admin.gcash.payments') }}" class="nav-link">
                    <i class="fa-solid fa-receipt nav-icon"></i>
                    GCash Receipts
                </a>

                <a href="{{ route('rooms.index') }}" class="nav-link">
                    <i class="fa-solid fa-door-open nav-icon"></i>
                    Rooms
                </a>

                <a href="{{ route('billings.index') }}" class="nav-link">
                    <i class="fa-solid fa-file-invoice-dollar nav-icon"></i>
                    Billing Monitoring
                </a>

                <a href="{{ route('maintenance.index') }}" class="nav-link">
                    <i class="fa-solid fa-screwdriver-wrench nav-icon"></i>
                    Maintenance
                </a>

                <a href="{{ route('announcements.index') }}" class="nav-link">
                    <i class="fa-solid fa-bullhorn nav-icon"></i>
                    Announcements
                </a>
            @else
                <a href="{{ route('tenant.dashboard') }}" class="nav-link">
                    <i class="fa-solid fa-chart-pie nav-icon"></i>
                    Dashboard
                </a>

                <a href="{{ route('billings.index') }}" class="nav-link">
                    <i class="fa-solid fa-money-bill-wave nav-icon"></i>
                    My Billings
                </a>

                <a href="{{ route('maintenance.index') }}" class="nav-link">
                    <i class="fa-solid fa-screwdriver-wrench nav-icon"></i>
                    Maintenance Requests
                </a>

                <a href="{{ route('announcements.index') }}" class="nav-link">
                    <i class="fa-solid fa-bullhorn nav-icon"></i>
                    Announcements
                </a>
            @endif
        </nav>

        <div class="p-4 border-t border-slate-800">
            <div class="bg-slate-900 rounded-2xl p-4 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 px-4 py-3 rounded-xl text-sm font-bold transition">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1">
        <header class="bg-white border-b px-6 py-5 flex justify-between items-center sticky top-0 z-10">
            <div>
                <h2 class="font-black text-2xl text-slate-800">
                    {{ $header ?? 'Dashboard' }}
                </h2>
                <p class="text-sm text-slate-500">
                    Welcome back, {{ Auth::user()->name }}
                </p>
            </div>

            <div class="hidden md:flex items-center gap-3 bg-slate-100 px-4 py-2 rounded-2xl">
                <i class="fa-solid fa-circle-user text-blue-600 text-xl"></i>
                <span class="font-semibold text-slate-700">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </header>

        <section class="p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-2xl font-semibold">
                    <i class="fa-solid fa-circle-check mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-5 py-4 rounded-2xl font-semibold">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            {{ $slot }}
        </section>
    </main>

</div>
</body>
</html>