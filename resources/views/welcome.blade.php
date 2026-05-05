<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MONALISA - Sistem Operasional Distribusi Ayam</title>

    <meta name="description" content="MONALISA adalah sistem operasional digital untuk mengelola stock ayam, pesanan customer, harga aktif, driver, dan alur distribusi.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
        }

        .hero-pattern {
            background:
                radial-gradient(circle at top left, rgba(242, 140, 40, 0.18), transparent 34rem),
                radial-gradient(circle at 80% 20%, rgba(59, 130, 196, 0.18), transparent 30rem),
                linear-gradient(135deg, #f8fafc 0%, #eef4fb 45%, #fff7ed 100%);
        }

        .hero-image-glow {
            background:
                radial-gradient(circle, rgba(242, 140, 40, 0.22), transparent 60%),
                radial-gradient(circle, rgba(22, 58, 99, 0.20), transparent 70%);
        }

        .big-title-bg {
            position: absolute;
            top: 16%;
            left: 50%;
            transform: translateX(-50%);
            font-size: clamp(5rem, 16vw, 13rem);
            font-weight: 900;
            letter-spacing: -0.08em;
            color: rgba(22, 58, 99, 0.045);
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased selection:bg-orange-500 selection:text-white">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/85 backdrop-blur-xl">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6">
            <a href="{{ url('/') }}" class="group flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-2xl bg-white p-1 shadow-sm ring-1 ring-slate-200">
                    <img
                        src="{{ asset('images/monalisa-logo.png') }}"
                        alt="Logo MONALISA"
                        class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

                <div>
                    <p class="text-xl font-black tracking-tight text-[#163A63]">
                        MONALISA
                    </p>
                    <p class="-mt-1 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">
                        Poultry System
                    </p>
                </div>
            </a>

            <nav class="hidden items-center gap-8 md:flex">
                <a href="#fitur" class="text-sm font-semibold text-slate-600 transition hover:text-[#163A63]">
                    Fitur
                </a>
                <a href="#alur" class="text-sm font-semibold text-slate-600 transition hover:text-[#163A63]">
                    Alur
                </a>
                <a href="#tentang" class="text-sm font-semibold text-slate-600 transition hover:text-[#163A63]">
                    Tentang
                </a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a
                        href="{{ route('dashboard') }}"
                        class="rounded-full bg-[#163A63] px-5 py-2.5 text-xs font-bold uppercase tracking-widest text-white shadow-lg shadow-blue-900/20 transition hover:-translate-y-0.5 hover:bg-[#102C4D]"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="hidden rounded-full px-4 py-2.5 text-xs font-bold uppercase tracking-widest text-[#163A63] transition hover:bg-slate-100 sm:inline-flex"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-full bg-[#F28C28] px-5 py-2.5 text-xs font-bold uppercase tracking-widest text-white shadow-lg shadow-orange-900/20 transition hover:-translate-y-0.5 hover:bg-[#D97706]"
                    >
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        <section class="hero-pattern relative overflow-hidden">
            <div class="big-title-bg">MONALISA</div>

            <div class="mx-auto grid min-h-[calc(100vh-5rem)] max-w-7xl grid-cols-1 items-center gap-12 px-6 py-20 lg:grid-cols-2 lg:py-24">
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 rounded-full border border-[#163A63]/10 bg-white/70 px-4 py-2 shadow-sm backdrop-blur">
                        <span class="material-symbols-outlined text-base text-[#F28C28]">verified</span>
                        <span class="text-[10px] font-black uppercase tracking-[0.22em] text-[#163A63]">
                            Trusted Distribution Partner
                        </span>
                    </div>

                    <h1 class="mt-8 max-w-3xl text-5xl font-black leading-[1.05] tracking-tight text-slate-950 md:text-7xl">
                        Sistem Operasional
                        <span class="block text-[#163A63]">Distribusi Ayam</span>
                        <span class="block text-[#F28C28]">yang Lebih Tertata.</span>
                    </h1>

                    <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                        MONALISA membantu mengelola stock ayam, produksi, pesanan customer, harga aktif, driver,
                        dan proses distribusi dalam satu sistem internal yang rapi dan terukur.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        @auth
                            <a
                                href="{{ route('dashboard') }}"
                                class="inline-flex items-center justify-center rounded-full bg-[#163A63] px-8 py-4 text-xs font-black uppercase tracking-widest text-white shadow-xl shadow-blue-900/20 transition hover:-translate-y-0.5 hover:bg-[#102C4D]"
                            >
                                Masuk Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center justify-center rounded-full bg-[#F28C28] px-8 py-4 text-xs font-black uppercase tracking-widest text-white shadow-xl shadow-orange-900/20 transition hover:-translate-y-0.5 hover:bg-[#D97706]"
                            >
                                Mulai Sekarang
                            </a>

                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-8 py-4 text-xs font-black uppercase tracking-widest text-[#163A63] shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-50"
                            >
                                Login
                            </a>
                        @endauth
                    </div>

                    <div class="mt-10 grid max-w-xl grid-cols-3 gap-3">
                        <div class="rounded-2xl border border-white/80 bg-white/70 p-4 shadow-sm backdrop-blur">
                            <p class="text-2xl font-black text-[#163A63]">Stock</p>
                            <p class="mt-1 text-xs font-semibold text-slate-500">Masuk & keluar</p>
                        </div>
                        <div class="rounded-2xl border border-white/80 bg-white/70 p-4 shadow-sm backdrop-blur">
                            <p class="text-2xl font-black text-[#F28C28]">Order</p>
                            <p class="mt-1 text-xs font-semibold text-slate-500">Customer</p>
                        </div>
                        <div class="rounded-2xl border border-white/80 bg-white/70 p-4 shadow-sm backdrop-blur">
                            <p class="text-2xl font-black text-[#163A63]">Driver</p>
                            <p class="mt-1 text-xs font-semibold text-slate-500">Operasional</p>
                        </div>
                    </div>
                </div>

                <div class="relative z-10">
                    <div class="hero-image-glow absolute -inset-6 rounded-[3rem] blur-2xl"></div>

                    <div class="relative overflow-hidden rounded-[2.5rem] border-8 border-white bg-white shadow-2xl">
                        <img
                            src="{{ asset('img/bg.png') }}"
                            alt="Ayam broiler MONALISA"
                            class="h-[520px] w-full object-cover"
                        >

                        <div class="absolute bottom-5 left-5 right-5 rounded-3xl bg-white/90 p-5 shadow-xl backdrop-blur">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-black text-slate-900">
                                        Monitoring Operasional
                                    </p>
                                    <p class="mt-1 text-sm text-slate-500">
                                        Produksi, stock, order, dan distribusi dalam satu alur.
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-[#163A63] p-3 text-white">
                                    <span class="material-symbols-outlined">monitoring</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -right-4 -top-4 hidden rounded-3xl bg-[#102C4D] p-5 text-white shadow-xl md:block">
                        <p class="text-xs font-bold uppercase tracking-widest text-orange-200">Status</p>
                        <p class="mt-1 text-2xl font-black">Operational</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="fitur" class="bg-white px-6 py-24">
            <div class="mx-auto max-w-7xl">
                <div class="max-w-2xl">
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-[#F28C28]">
                        Fitur Utama
                    </p>
                    <h2 class="mt-3 text-4xl font-black tracking-tight text-slate-950">
                        Dibangun untuk kebutuhan operasional, bukan sekadar tampilan manis.
                    </h2>
                    <p class="mt-4 text-base leading-7 text-slate-600">
                        MONALISA menghubungkan proses produksi, stock, pesanan, dan data master agar aktivitas distribusi ayam lebih mudah dipantau.
                    </p>
                </div>

                <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div class="group rounded-[2rem] border border-slate-200 bg-slate-50 p-8 transition hover:-translate-y-1 hover:border-orange-200 hover:bg-white hover:shadow-2xl">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-[#F28C28] transition group-hover:rotate-6 group-hover:bg-[#F28C28] group-hover:text-white">
                            <span class="material-symbols-outlined text-3xl">inventory_2</span>
                        </div>
                        <h3 class="mt-7 text-2xl font-black text-slate-950">Stock Terkontrol</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-500">
                            Stock dihitung dari produksi masuk dan transaksi keluar, jadi admin bisa melihat ketersediaan secara lebih jelas.
                        </p>
                    </div>

                    <div class="group rounded-[2rem] border border-slate-200 bg-slate-50 p-8 transition hover:-translate-y-1 hover:border-blue-200 hover:bg-white hover:shadow-2xl">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-[#163A63] transition group-hover:-rotate-6 group-hover:bg-[#163A63] group-hover:text-white">
                            <span class="material-symbols-outlined text-3xl">receipt_long</span>
                        </div>
                        <h3 class="mt-7 text-2xl font-black text-slate-950">Pesanan Terpantau</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-500">
                            Customer dapat membuat pesanan, sementara admin memantau status masuk, diproses, dikirim, selesai, atau dibatalkan.
                        </p>
                    </div>

                    <div class="group rounded-[2rem] border border-slate-200 bg-slate-50 p-8 transition hover:-translate-y-1 hover:border-emerald-200 hover:bg-white hover:shadow-2xl">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700 transition group-hover:rotate-6 group-hover:bg-emerald-600 group-hover:text-white">
                            <span class="material-symbols-outlined text-3xl">local_shipping</span>
                        </div>
                        <h3 class="mt-7 text-2xl font-black text-slate-950">Data Driver</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-500">
                            Data driver dan kendaraan tersimpan sebagai dasar pengembangan modul pengiriman berikutnya.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="alur" class="bg-slate-950 px-6 py-24 text-white">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.22em] text-orange-300">
                            Alur Sistem
                        </p>
                        <h2 class="mt-3 text-4xl font-black tracking-tight">
                            Dari produksi sampai pesanan, semuanya punya jalur yang jelas.
                        </h2>
                        <p class="mt-5 text-base leading-8 text-slate-300">
                            Sistem ini tidak menyimpan stock manual begitu saja. Stock dihitung dari sumber data operasional,
                            sehingga perubahan produksi dan pesanan langsung tercermin pada monitoring.
                        </p>
                    </div>

                    <div class="grid gap-4">
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#F28C28] text-sm font-black text-white">
                                    1
                                </div>
                                <div>
                                    <h3 class="font-black">Produksi Ayam</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-300">
                                        Admin mencatat jumlah ayam hasil produksi. Berat dihitung otomatis menggunakan standar sistem.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#F28C28] text-sm font-black text-white">
                                    2
                                </div>
                                <div>
                                    <h3 class="font-black">Monitoring Stock</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-300">
                                        Stock tersedia dihitung dari produksi masuk dikurangi pesanan yang sudah masuk status operasional.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#F28C28] text-sm font-black text-white">
                                    3
                                </div>
                                <div>
                                    <h3 class="font-black">Pesanan Customer</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-300">
                                        Customer membuat pesanan berdasarkan harga aktif. Order lama tetap menyimpan harga saat transaksi dibuat.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#F28C28] text-sm font-black text-white">
                                    4
                                </div>
                                <div>
                                    <h3 class="font-black">Distribusi Lanjutan</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-300">
                                        Modul driver, pengiriman, invoice, pembayaran, QC, dan audit log bisa dikembangkan setelah alur inti stabil.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang" class="bg-white px-6 py-24">
            <div class="mx-auto max-w-7xl">
                <div class="overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-[#163A63] to-[#102C4D] p-8 text-white shadow-2xl md:p-12">
                    <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.22em] text-orange-200">
                                MONALISA
                            </p>
                            <h2 class="mt-3 text-4xl font-black tracking-tight">
                                Sistem internal yang dibuat untuk kerja operasional harian.
                            </h2>
                            <p class="mt-5 text-base leading-8 text-slate-200">
                                Fokus MONALISA adalah membuat proses pengelolaan ayam, customer, driver, harga,
                                dan pesanan menjadi lebih transparan serta mudah dikendalikan.
                            </p>
                        </div>

                        <div class="rounded-3xl bg-white/10 p-6 ring-1 ring-white/10">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-2xl bg-white/10 p-5">
                                    <p class="text-3xl font-black text-orange-200">Role</p>
                                    <p class="mt-2 text-sm text-slate-200">Admin, customer, driver, direktur</p>
                                </div>
                                <div class="rounded-2xl bg-white/10 p-5">
                                    <p class="text-3xl font-black text-orange-200">Stock</p>
                                    <p class="mt-2 text-sm text-slate-200">Produksi masuk dan transaksi keluar</p>
                                </div>
                                <div class="rounded-2xl bg-white/10 p-5">
                                    <p class="text-3xl font-black text-orange-200">Harga</p>
                                    <p class="mt-2 text-sm text-slate-200">Katalog harga aktif per kilogram</p>
                                </div>
                                <div class="rounded-2xl bg-white/10 p-5">
                                    <p class="text-3xl font-black text-orange-200">Order</p>
                                    <p class="mt-2 text-sm text-slate-200">Pesanan customer dengan estimasi total</p>
                                </div>
                            </div>

                            <div class="mt-6">
                                @auth
                                    <a
                                        href="{{ route('dashboard') }}"
                                        class="inline-flex w-full items-center justify-center rounded-full bg-[#F28C28] px-8 py-4 text-xs font-black uppercase tracking-widest text-white transition hover:bg-[#D97706]"
                                    >
                                        Buka Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('register') }}"
                                        class="inline-flex w-full items-center justify-center rounded-full bg-[#F28C28] px-8 py-4 text-xs font-black uppercase tracking-widest text-white transition hover:bg-[#D97706]"
                                    >
                                        Daftar Sekarang
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-slate-50 px-6 py-16">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm md:flex-row">
                <div>
                    <h2 class="text-2xl font-black text-slate-950">
                        Siap mengelola operasional dengan lebih rapi?
                    </h2>
                    <p class="mt-2 text-sm text-slate-500">
                        Masuk sebagai admin atau daftar sebagai customer untuk mulai menggunakan sistem.
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-full bg-[#163A63] px-7 py-3 text-xs font-black uppercase tracking-widest text-white transition hover:bg-[#102C4D]">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-slate-300 bg-white px-7 py-3 text-xs font-black uppercase tracking-widest text-[#163A63] transition hover:bg-slate-50">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="rounded-full bg-[#F28C28] px-7 py-3 text-xs font-black uppercase tracking-widest text-white transition hover:bg-[#D97706]">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-950 px-6 py-12 text-slate-400">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 text-center md:flex-row md:text-left">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-2xl bg-white p-1">
                    <img
                        src="{{ asset('images/monalisa-logo.png') }}"
                        alt="Logo MONALISA"
                        class="h-full w-full object-contain"
                    >
                </div>
                <div>
                    <p class="font-black tracking-tight text-white">MONALISA</p>
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">Poultry Operational System</p>
                </div>
            </div>

            <p class="text-xs font-medium">
                © {{ date('Y') }} MONALISA. Sistem operasional distribusi ayam.
            </p>

            <div class="flex gap-5 text-xs font-bold uppercase tracking-widest">
                <a href="#fitur" class="transition hover:text-orange-300">Fitur</a>
                <a href="#alur" class="transition hover:text-orange-300">Alur</a>
                <a href="#tentang" class="transition hover:text-orange-300">Tentang</a>
            </div>
        </div>
    </footer>
</body>
</html>