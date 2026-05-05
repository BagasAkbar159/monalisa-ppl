@php
    $user = Auth::user();

    $navItemClass = function ($active = false) {
        return $active
            ? 'flex items-center gap-3 rounded-xl bg-[#F28C28] px-4 py-3 text-sm font-semibold text-white shadow-sm shadow-orange-900/20'
            : 'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white';
    };

    $sectionClass = 'px-4 pt-6 pb-2 text-xs font-bold uppercase tracking-wider text-slate-400';
@endphp

<div
    x-show="sidebarOpen"
    x-transition.opacity
    class="fixed inset-0 z-40 bg-slate-950/60 lg:hidden"
    @click="sidebarOpen = false"
></div>

<aside
    class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col bg-[#102C4D] text-white shadow-2xl transition-transform duration-300 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
>
    <div class="flex h-20 items-center gap-3 border-b border-white/10 px-5">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-white/95 p-1 shadow-sm">
            <img
                src="{{ asset('images/monalisa-logo.png') }}"
                alt="Logo MONALISA"
                class="h-full w-full object-contain"
            >
        </div>

        <div class="min-w-0">
            <p class="truncate text-lg font-extrabold tracking-wide text-white">
                MONALISA
            </p>
            <p class="truncate text-xs font-medium text-slate-300">
                Operational System
            </p>
        </div>

        <button
            type="button"
            class="ml-auto rounded-lg p-2 text-slate-300 transition hover:bg-white/10 hover:text-white lg:hidden"
            @click="sidebarOpen = false"
            aria-label="Tutup sidebar"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-5">
        @if ($user?->hasRole('admin'))
            <p class="{{ $sectionClass }}">Utama</p>

            <a href="{{ route('admin.dashboard') }}"
               class="{{ $navItemClass(request()->routeIs('admin.dashboard')) }}">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h8V3H3v10Zm10 8h8V3h-8v18ZM3 21h8v-6H3v6Z" />
                </svg>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.profile') }}"
            class="{{ $navItemClass(request()->routeIs('admin.profile')) }}">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 15 0" />
                </svg>
                <span>Profil Admin</span>
            </a>
            <p class="{{ $sectionClass }}">Operasional</p>

            <div class="space-y-2">
                <a href="{{ route('admin.stock.index') }}"
                   class="{{ $navItemClass(request()->routeIs('admin.stock.*')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Stock</span>
                </a>

                <a href="{{ route('admin.chicken-productions.index') }}"
                   class="{{ $navItemClass(request()->routeIs('admin.chicken-productions.*')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                    <span>Produksi</span>
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="{{ $navItemClass(request()->routeIs('admin.orders.*')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10l2 3v13H5V7l2-3Z" />
                    </svg>
                    <span>Pesanan</span>
                </a>
            </div>

            <p class="{{ $sectionClass }}">Master Data</p>

            <div class="space-y-2">
                <a href="{{ route('admin.customers.index') }}"
                   class="{{ $navItemClass(request()->routeIs('admin.customers.*')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-5-3.87M9 20H4v-2a4 4 0 0 1 5-3.87m0 0a4 4 0 1 0 0-7.75m8 7.75a4 4 0 1 0 0-7.75" />
                    </svg>
                    <span>Customer</span>
                </a>

                <a href="{{ route('admin.drivers.index') }}"
                   class="{{ $navItemClass(request()->routeIs('admin.drivers.*')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18l-2-5H5l-2 5Zm2 0v5m14-5v5M7 18h.01M17 18h.01" />
                    </svg>
                    <span>Driver</span>
                </a>

                <a href="{{ route('admin.chicken-price-catalogs.index') }}"
                   class="{{ $navItemClass(request()->routeIs('admin.chicken-price-catalogs.*')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.5 0-2.5.8-2.5 2s1 2 2.5 2 2.5.8 2.5 2-1 2-2.5 2m0-8V6m0 12v-2m9-4a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Katalog Harga</span>
                </a>
            </div>
        @elseif ($user?->hasRole('customer'))
            <p class="{{ $sectionClass }}">Customer</p>

            <div class="space-y-2">
                <a href="{{ route('customer.dashboard') }}"
                class="{{ $navItemClass(request()->routeIs('customer.dashboard')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h8V3H3v10Zm10 8h8V3h-8v18ZM3 21h8v-6H3v6Z" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('customer.orders.create') }}"
                class="{{ $navItemClass(request()->routeIs('customer.orders.create')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                    <span>Buat Pesanan</span>
                </a>

                <a href="{{ route('customer.orders.index') }}"
                class="{{ $navItemClass(request()->routeIs('customer.orders.index') || request()->routeIs('customer.orders.show')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10l2 3v13H5V7l2-3Z" />
                    </svg>
                    <span>Pesanan Saya</span>
                </a>

                <a href="{{ route('customer.profile') }}"
                class="{{ $navItemClass(request()->routeIs('customer.profile')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                    </svg>
                    <span>Profil Customer</span>
                </a>
            </div>
    @elseif ($user?->hasRole('driver'))
        <p class="{{ $sectionClass }}">Driver</p>

        <div class="space-y-2">
            <a href="{{ route('driver.dashboard') }}"
            class="{{ $navItemClass(request()->routeIs('driver.dashboard')) }}">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18l-2-5H5l-2 5Zm2 0v5m14-5v5M7 18h.01M17 18h.01" />
                </svg>
                <span>Dashboard Driver</span>
            </a>

            <a href="{{ route('driver.profile') }}"
            class="{{ $navItemClass(request()->routeIs('driver.profile')) }}">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                </svg>
                <span>Profil Saya</span>
            </a>
        </div>
        @elseif ($user?->hasRole('direktur'))
            <p class="{{ $sectionClass }}">Direktur</p>

            <div class="space-y-2">
                <a href="{{ route('direktur.dashboard') }}"
                class="{{ $navItemClass(request()->routeIs('direktur.dashboard')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m5 14V9m5 10V7m5 12V3" />
                    </svg>
                    <span>Dashboard Direktur</span>
                </a>

                <a href="{{ route('direktur.profile') }}"
                class="{{ $navItemClass(request()->routeIs('direktur.profile')) }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                    </svg>
                    <span>Profil Direktur</span>
                </a>
            </div>
        @endif
    </nav>

    <div class="border-t border-white/10 p-4">
        <div class="mb-4 rounded-2xl bg-white/10 p-4">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#F28C28] text-sm font-bold text-white">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <p class="truncate text-sm font-bold text-white">
                        {{ $user->name ?? 'User' }}
                    </p>
                    <p class="truncate text-xs text-slate-300">
                        {{ $user?->email }}
                    </p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="flex w-full items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-100 transition hover:bg-red-500 hover:text-white"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3-3H9m10.5 0-3-3m3 3-3 3" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>