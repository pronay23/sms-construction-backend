<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50 dark:bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Construction Manager') }} - @yield('title', 'Home')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full text-slate-800 antialiased dark:text-slate-100 font-sans">
    <div class="min-h-full flex flex-col">
        <!-- TOP NAVBAR -->
        <header class="sticky top-0 z-40 flex h-16 w-full items-center justify-between border-b border-slate-200 bg-white/95 px-4 backdrop-blur-md sm:px-6 lg:px-8 dark:border-slate-800 dark:bg-slate-900/95">
            <div class="flex items-center gap-3">
                <!-- Mobile Sidebar Toggle -->
                <button id="mobile-sidebar-toggle" type="button" class="inline-flex items-center justify-center rounded-lg p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 lg:hidden dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200" aria-label="Toggle sidebar">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-lg tracking-tight text-slate-900 dark:text-white">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500 text-slate-950 shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <span>Build<span class="text-amber-500">Core</span></span>
                </a>

                <span class="hidden md:inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                    Construction ERP
                </span>
            </div>

            <!-- Navbar Center: Quick Search -->
            <div class="hidden sm:flex flex-1 max-w-md mx-6">
                <div class="relative w-full">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search homes, projects, blueprints..." class="w-full rounded-lg border border-slate-200 bg-slate-50 py-1.5 pl-9 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-amber-500" />
                </div>
            </div>

            <!-- Navbar Right: API status & User Profile -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/api/homes') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-xs hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    API: <code class="font-mono text-amber-600 dark:text-amber-400">/api/homes</code>
                </a>

                <!-- Profile avatar -->
                <div class="flex items-center gap-2 pl-2 border-l border-slate-200 dark:border-slate-800">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-amber-500/10 text-amber-600 font-semibold text-xs border border-amber-500/20">
                        JD
                    </div>
                    <span class="hidden md:inline-block text-sm font-medium text-slate-700 dark:text-slate-300">Admin</span>
                </div>
            </div>
        </header>

        <!-- BODY WRAPPER: SIDEBAR + MAIN CONTENT -->
        <div class="flex flex-1 overflow-hidden">
            <!-- LEFT SIDEBAR -->
            <aside id="app-sidebar" class="fixed inset-y-0 left-0 z-30 w-64 -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out lg:static border-r border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900 flex flex-col justify-between pt-16 lg:pt-0">
                <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6">
                    <!-- Navigation Group -->
                    <div>
                        <p class="px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Main Menu</p>
                        <nav class="mt-2 space-y-1">
                            <a href="{{ route('home') }}" class="group flex items-center gap-3 rounded-lg bg-amber-500/10 px-3 py-2 text-sm font-semibold text-amber-600 dark:text-amber-400">
                                <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Home (MVC)</span>
                            </a>

                            <a href="#projects" class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                <svg class="h-5 w-5 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span>Construction Projects</span>
                            </a>

                            <a href="#api-tester" class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                <svg class="h-5 w-5 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>API Routes Explorer</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Construction Management Group -->
                    <div>
                        <p class="px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Modules</p>
                        <nav class="mt-2 space-y-1">
                            <a href="#" class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                <span class="flex items-center gap-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Progress Tracking
                                </span>
                                <span class="rounded bg-slate-100 px-1.5 py-0.5 text-[10px] font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-400">Phase 2</span>
                            </a>

                            <a href="#" class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Contractors & Staff
                            </a>

                            <a href="#" class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Sidebar Footer Status -->
                <div class="border-t border-slate-200 p-4 dark:border-slate-800">
                    <div class="flex items-center justify-between rounded-lg bg-slate-50 p-3 dark:bg-slate-950">
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">API Gateway</span>
                        </div>
                        <span class="text-[10px] font-mono text-slate-400">v1.0</span>
                    </div>
                </div>
            </aside>

            <!-- Backdrop for Mobile Sidebar -->
            <div id="sidebar-backdrop" class="fixed inset-0 z-20 hidden bg-slate-900/50 backdrop-blur-xs lg:hidden"></div>

            <!-- MAIN CONTENT AREA -->
            <main class="flex-1 overflow-y-auto px-4 py-8 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Toggle sidebar script -->
    <script>
        const toggleBtn = document.getElementById('mobile-sidebar-toggle');
        const sidebar = document.getElementById('app-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        if (toggleBtn && sidebar && backdrop) {
            toggleBtn.addEventListener('click', toggleSidebar);
            backdrop.addEventListener('click', toggleSidebar);
        }
    </script>
    @stack('scripts')
</body>
</html>

