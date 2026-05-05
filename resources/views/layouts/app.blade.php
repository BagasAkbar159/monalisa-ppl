<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MONALISA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-800">
    <div
        x-data="{ sidebarOpen: false }"
        class="min-h-screen"
    >
        @include('layouts.navigation')

        <div class="lg:pl-72">
            <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur">
                <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white p-2 text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900 lg:hidden"
                            @click="sidebarOpen = true"
                            aria-label="Buka sidebar"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div>
                            @isset($header)
                                <div class="text-lg font-bold text-slate-900">
                                    {{ $header }}
                                </div>
                            @else
                                <h1 class="text-lg font-bold text-slate-900">
                                    MONALISA
                                </h1>
                            @endisset

                            <p class="hidden text-xs text-slate-500 sm:block">
                                Sistem operasional distribusi ayam
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-semibold text-slate-900">
                                {{ Auth::user()->name ?? 'User' }}
                            </p>
                            <p class="text-xs text-slate-500">
                                {{ Auth::user()?->getRoleNames()->first() ? ucfirst(Auth::user()->getRoleNames()->first()) : 'Pengguna' }}
                            </p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#163A63] text-sm font-bold text-white shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="px-4 py-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <p class="font-semibold">Ada data yang perlu diperbaiki:</p>
                        <ul class="mt-2 list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @hasSection('content')
                    @yield('content')
                @else
                    @isset($slot)
                        {{ $slot }}
                    @endisset
                @endif
            </main>
        </div>
    </div>
</body>
</html>