<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Tirtakencana Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .nav-link.active { background-color: rgba(255,255,255,0.12); border-left: 3px solid #38bdf8; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="flex min-h-screen">
        <aside class="w-64 shrink-0 bg-slate-900 text-slate-200 flex flex-col">
            <div class="px-6 py-6 border-b border-slate-800">
                <div class="flex items-center gap-2">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-br from-sky-400 to-indigo-500 flex items-center justify-center font-extrabold text-white">TK</div>
                    <div>
                        <p class="font-bold text-white leading-tight">Tirtakencana Tatawarna</p>
                        <p class="text-xs text-slate-400 leading-tight">Data Management</p>
                    </div>
                </div>
            </div>
            <nav class="flex-1 py-4 space-y-1">
                <p class="px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Master Data</p>
                <a href="{{ route('table-b.index') }}" class="nav-link flex items-center gap-3 px-6 py-2.5 text-sm hover:bg-white/5 {{ request()->routeIs('table-b.*') ? 'active text-white font-semibold' : 'text-slate-300' }}">
                    <span><x-carbon-scales class="w-5 h-5" /></span> Penjualan <span class="text-slate-500 text-xs"></span>
                </a>
                <a href="{{ route('table-a.index') }}" class="nav-link flex items-center gap-3 px-6 py-2.5 text-sm hover:bg-white/5 {{ request()->routeIs('table-a.*') ? 'active text-white font-semibold' : 'text-slate-300' }}">
                    <span><x-iconpark-historyquery-o class="w-5 h-5" /></span> History Kode Toko <span class="text-slate-500 text-xs"></span>
                </a>
                <a href="{{ route('table-c.index') }}" class="nav-link flex items-center gap-3 px-6 py-2.5 text-sm hover:bg-white/5 {{ request()->routeIs('table-c.*') ? 'active text-white font-semibold' : 'text-slate-300' }}">
                    <span><x-carbon-area class="w-5 h-5" /></span> Area Sales <span class="text-slate-500 text-xs"></span>
                </a>
                <a href="{{ route('table-d.index') }}" class="nav-link flex items-center gap-3 px-6 py-2.5 text-sm hover:bg-white/5 {{ request()->routeIs('table-d.*') ? 'active text-white font-semibold' : 'text-slate-300' }}">
                    <span><x-fontisto-person class="w-5 h-5" /></span> Master Sales <span class="text-slate-500 text-xs"></span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between">
                <h1 class="text-xl font-bold text-slate-800">@yield('title', 'Dashboard')</h1>
            </header>

            <main class="flex-1 p-8">
                @if (session('success'))
                    <div class="mb-6 flex items-center gap-2 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm font-medium">
                        <x-feathericon-check-circle class="w-5 h-5" /> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 flex items-center gap-2 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 text-sm font-medium">
                        <x-feathericon-x-circle class="w-5 h-5" /> {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 text-sm">
                        <p class="flex items-center gap-2 font-semibold mb-1"><x-feathericon-alert-triangle class="w-5 h-5" /> Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
