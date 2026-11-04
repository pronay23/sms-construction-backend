@extends('layouts.app')

@section('title', 'Construction Dashboard & Homes')

@section('content')
<div class="space-y-8">
    <!-- Top Greeting Banner -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl dark:text-white">
                Construction Management Dashboard
            </h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Model-View-Controller (MVC) architecture powered by Laravel API routing.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="document.getElementById('create-home-modal').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950 shadow-xs hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add New Home via API</span>
            </button>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Total Homes</span>
                <span class="rounded-lg bg-amber-500/10 p-2 text-amber-600 dark:text-amber-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </span>
            </div>
            <p id="stats-total-homes" class="mt-3 text-2xl font-bold text-slate-900 dark:text-white">{{ $homes->count() }}</p>
            <p class="mt-1 text-xs text-slate-500">Managed in system</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Under Construction</span>
                <span class="rounded-lg bg-blue-500/10 p-2 text-blue-600 dark:text-blue-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-slate-900 dark:text-white">{{ $homes->where('status', 'under_construction')->count() }}</p>
            <p class="mt-1 text-xs text-blue-600 dark:text-blue-400">Active job sites</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Completed Projects</span>
                <span class="rounded-lg bg-emerald-500/10 p-2 text-emerald-600 dark:text-emerald-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-slate-900 dark:text-white">{{ $homes->where('status', 'completed')->count() }}</p>
            <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400">Ready for handover</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">API Status</span>
                <span class="rounded-lg bg-emerald-500/10 p-2 text-emerald-600 dark:text-emerald-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-emerald-600 dark:text-emerald-400">Active</p>
            <p class="mt-1 text-xs text-slate-500">Endpoint: /api/homes</p>
        </div>
    </div>

    <!-- API Routing & MVC Explorer Card -->
    <div id="api-tester" class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs dark:border-slate-800 dark:bg-slate-900">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/10 px-2.5 py-0.5 text-xs font-medium text-amber-600 dark:text-amber-400">
                    API Routing in Action
                </span>
                <h2 class="mt-2 text-lg font-bold text-slate-900 dark:text-white">API Endpoints (routes/api.php)</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Interact directly with your <code class="font-mono text-amber-600">Home</code> model using REST API routes.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <button id="fetch-api-btn" type="button" class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-xs font-semibold text-white shadow-xs hover:bg-slate-800 dark:bg-amber-500 dark:text-slate-950 dark:hover:bg-amber-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Test GET /api/homes</span>
                </button>
                <a href="{{ url('/api/homes') }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800">
                    <span>Open in new tab</span>
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
        </div>

        <!-- API Route Table -->
        <div class="mt-4 overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                <thead class="border-b border-slate-200 text-[11px] uppercase tracking-wider text-slate-400 dark:border-slate-800">
                    <tr>
                        <th class="py-2 pr-4 font-semibold">Method</th>
                        <th class="py-2 px-4 font-semibold">URI</th>
                        <th class="py-2 px-4 font-semibold">Action (Controller)</th>
                        <th class="py-2 pl-4 font-semibold">Description</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-mono dark:divide-slate-800">
                    <tr>
                        <td class="py-2 pr-4 text-emerald-600 dark:text-emerald-400 font-bold">GET</td>
                        <td class="py-2 px-4">/api/homes</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\HomeController@index</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">List homes (paginated)</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-blue-600 dark:text-blue-400 font-bold">POST</td>
                        <td class="py-2 px-4">/api/homes</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\HomeController@store</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Create a new home</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-emerald-600 dark:text-emerald-400 font-bold">GET</td>
                        <td class="py-2 px-4">/api/homes/{home}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\HomeController@show</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">View single home details</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-amber-600 dark:text-amber-400 font-bold">PUT/PATCH</td>
                        <td class="py-2 px-4">/api/homes/{home}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\HomeController@update</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Update an existing home</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-rose-600 dark:text-rose-400 font-bold">DELETE</td>
                        <td class="py-2 px-4">/api/homes/{home}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\HomeController@destroy</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Delete a home record</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-emerald-600 dark:text-emerald-400 font-bold">GET</td>
                        <td class="py-2 px-4">/api/projects</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\ProjectController@index</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">List projects (paginated)</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-blue-600 dark:text-blue-400 font-bold">POST</td>
                        <td class="py-2 px-4">/api/projects</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\ProjectController@store</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Create a project (name, description)</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-emerald-600 dark:text-emerald-400 font-bold">GET</td>
                        <td class="py-2 px-4">/api/projects/{project}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\ProjectController@show</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">View single project details</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-amber-600 dark:text-amber-400 font-bold">PUT/PATCH</td>
                        <td class="py-2 px-4">/api/projects/{project}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\ProjectController@update</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Update a project</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-rose-600 dark:text-rose-400 font-bold">DELETE</td>
                        <td class="py-2 px-4">/api/projects/{project}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\ProjectController@destroy</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Delete a project record</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-emerald-600 dark:text-emerald-400 font-bold">GET</td>
                        <td class="py-2 px-4">/api/categories</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\CategoryController@index</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">List categories (paginated)</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-blue-600 dark:text-blue-400 font-bold">POST</td>
                        <td class="py-2 px-4">/api/categories</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\CategoryController@store</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Create a category (name, description)</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-emerald-600 dark:text-emerald-400 font-bold">GET</td>
                        <td class="py-2 px-4">/api/categories/{category}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\CategoryController@show</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">View single category details</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-amber-600 dark:text-amber-400 font-bold">PUT/PATCH</td>
                        <td class="py-2 px-4">/api/categories/{category}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\CategoryController@update</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Update a category</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 text-rose-600 dark:text-rose-400 font-bold">DELETE</td>
                        <td class="py-2 px-4">/api/categories/{category}</td>
                        <td class="py-2 px-4 text-slate-500 font-sans">Api\CategoryController@destroy</td>
                        <td class="py-2 pl-4 text-slate-500 font-sans">Delete a category record</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Live API Response Preview Box -->
        <div id="api-response-wrapper" class="mt-4 hidden">
            <div class="flex items-center justify-between rounded-t-lg bg-slate-900 px-4 py-2 text-xs font-mono text-slate-300">
                <span>API JSON Response (<span id="api-status-code">200 OK</span>)</span>
                <button type="button" onclick="document.getElementById('api-response-wrapper').classList.add('hidden')" class="text-slate-400 hover:text-white">&times; Close</button>
            </div>
            <pre id="api-response-box" class="max-h-64 overflow-auto rounded-b-lg bg-slate-950 p-4 font-mono text-xs text-emerald-400"></pre>
        </div>
    </div>

    <!-- Homes Project Showcase (MVC View) -->
    <div id="projects" class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white">Featured Construction Homes</h2>
            <span class="text-xs text-slate-500">Rendered via Blade View &amp; Eloquent Model</span>
        </div>

        @if($homes->isNotEmpty())
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($homes as $home)
                    <div class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xs transition hover:shadow-md dark:border-slate-800 dark:bg-slate-900">
                        <div class="relative h-48 w-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                            @if($home->image_url)
                                <img src="{{ $home->image_url }}" alt="{{ $home->title }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
                            @else
                                <div class="flex h-full w-full items-center justify-center text-slate-400">
                                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3">
                                @if($home->status === 'completed')
                                    <span class="rounded-full bg-emerald-500/90 px-2.5 py-0.5 text-xs font-semibold text-white backdrop-blur-xs">Completed</span>
                                @elseif($home->status === 'under_construction')
                                    <span class="rounded-full bg-amber-500/90 px-2.5 py-0.5 text-xs font-semibold text-slate-950 backdrop-blur-xs">In Construction</span>
                                @else
                                    <span class="rounded-full bg-blue-500/90 px-2.5 py-0.5 text-xs font-semibold text-white backdrop-blur-xs">{{ ucfirst(str_replace('_', ' ', $home->status)) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">{{ $home->location ?? 'Site Location Pending' }}</span>
                                @if($home->price)
                                    <span class="text-sm font-bold text-amber-600 dark:text-amber-400">${{ number_format($home->price, 2) }}</span>
                                @endif
                            </div>
                            <h3 class="mt-2 font-bold text-slate-900 dark:text-white line-clamp-1">{{ $home->title }}</h3>
                            <p class="mt-1 text-xs text-slate-500 line-clamp-2 dark:text-slate-400">{{ $home->description ?? 'No description provided.' }}</p>

                            <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs text-slate-600 dark:border-slate-800 dark:text-slate-400">
                                <span><strong>{{ $home->bedrooms ?? '-' }}</strong> Beds</span>
                                <span><strong>{{ $home->bathrooms ?? '-' }}</strong> Baths</span>
                                <span><strong>{{ $home->area_sqft ? number_format($home->area_sqft) : '-' }}</strong> sq.ft</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Placeholder empty state when table has no records -->
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-12 text-center dark:border-slate-800 dark:bg-slate-900">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-amber-50 text-amber-600 dark:bg-amber-950/50 dark:text-amber-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="mt-3 text-sm font-semibold text-slate-900 dark:text-white">No home records in database yet</h3>
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                    Run the database migration and seeder, or use the API button above to create a new home record.
                </p>
                <div class="mt-4 flex justify-center gap-3">
                    <button onclick="document.getElementById('create-home-modal').classList.remove('hidden')" class="rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-slate-950 hover:bg-amber-400">
                        Add Sample Home
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Quick Create Home Modal -->
<div id="create-home-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-xs">
    <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-6 shadow-xl dark:border-slate-800 dark:bg-slate-900">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Create Home (calls POST /api/homes)</h3>
            <button type="button" onclick="document.getElementById('create-home-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">&times;</button>
        </div>

        <form id="create-home-form" class="mt-4 space-y-4">
            <div>
                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300">Title *</label>
                <input type="text" name="title" required value="Sunset Ridge Villa" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm dark:border-slate-700 dark:bg-slate-950" />
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-300">Location</label>
                    <input type="text" name="location" value="Austin, TX" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm dark:border-slate-700 dark:bg-slate-950" />
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-300">Price ($)</label>
                    <input type="number" step="0.01" name="price" value="485000" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm dark:border-slate-700 dark:bg-slate-950" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-300">Beds</label>
                    <input type="number" name="bedrooms" value="4" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm dark:border-slate-700 dark:bg-slate-950" />
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-300">Baths</label>
                    <input type="number" name="bathrooms" value="3" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm dark:border-slate-700 dark:bg-slate-950" />
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 dark:text-slate-300">Sq. Ft.</label>
                    <input type="number" name="area_sqft" value="2850" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm dark:border-slate-700 dark:bg-slate-950" />
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300">Construction Status</label>
                <select name="status" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm dark:border-slate-700 dark:bg-slate-950">
                    <option value="planning">Planning Phase</option>
                    <option value="under_construction" selected>Under Construction</option>
                    <option value="completed">Completed</option>
                    <option value="sold">Sold</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300">Description</label>
                <textarea name="description" rows="2" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm dark:border-slate-700 dark:bg-slate-950">Modern 4-bedroom architectural construction with energy-efficient framing and open floor plan.</textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('create-home-modal').classList.add('hidden')" class="rounded-lg px-4 py-2 text-xs font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">Cancel</button>
                <button type="submit" class="rounded-lg bg-amber-500 px-4 py-2 text-xs font-semibold text-slate-950 hover:bg-amber-400">Send API Request</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Live API Tester logic
    const fetchApiBtn = document.getElementById('fetch-api-btn');
    const apiResponseWrapper = document.getElementById('api-response-wrapper');
    const apiResponseBox = document.getElementById('api-response-box');
    const apiStatusCode = document.getElementById('api-status-code');

    if (fetchApiBtn) {
        fetchApiBtn.addEventListener('click', async () => {
            apiResponseWrapper.classList.remove('hidden');
            apiResponseBox.textContent = 'Fetching data from /api/homes...';

            try {
                const response = await fetch('/api/homes', {
                    headers: { 'Accept': 'application/json' }
                });
                apiStatusCode.textContent = `${response.status} ${response.statusText}`;
                const data = await response.json();
                apiResponseBox.textContent = JSON.stringify(data, null, 2);
            } catch (err) {
                apiStatusCode.textContent = 'Error';
                apiResponseBox.textContent = `Fetch error: ${err.message}`;
            }
        });
    }

    // Live Create Home Form via POST /api/homes
    const createHomeForm = document.getElementById('create-home-form');
    if (createHomeForm) {
        createHomeForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(createHomeForm);
            const payload = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/api/homes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Home created successfully via /api/homes!');
                    window.location.reload();
                } else {
                    alert('API validation error: ' + JSON.stringify(result.errors || result.message));
                }
            } catch (error) {
                alert('Request failed: ' + error.message);
            }
        });
    }
</script>
@endpush

