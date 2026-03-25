<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'PromptFlow') }} — @yield('title', isset($header) ? strip_tags($header) : 'Dashboard')</title>
        <link rel="icon" type="image/jpg" href="{{ asset('img/user.jpg') }}?v=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <style>
            :root {
                --pf-bg: #f8f9fb;
                --pf-surface: #ffffff;
                --pf-border: #e9ecef;
                --pf-text: #1a1d23;
                --pf-muted: #6c757d;
                --pf-accent: #5b5ef4;
                --pf-accent-hover: #4a4dd6;
                --pf-success: #22c55e;
                --pf-danger: #ef4444;
                --pf-radius: 12px;
                --pf-shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
                --pf-shadow-md: 0 4px 12px rgba(0, 0, 0, .08);
            }

            * {
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: var(--pf-bg);
                color: var(--pf-text);
                font-size: 14px;
            }

            /* Navbar */
            .pf-navbar {
                background: var(--pf-surface);
                border-bottom: 1px solid var(--pf-border);
                padding: 0 1.5rem;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: sticky;
                top: 0;
                z-index: 100;
            }

            .pf-navbar-brand {
                font-weight: 700;
                font-size: 1.1rem;
                color: var(--pf-accent);
                text-decoration: none;
                letter-spacing: -0.3px;
            }

            .pf-navbar-brand span {
                color: var(--pf-text);
            }

            .pf-nav-links {
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            .pf-nav-link {
                padding: 0.4rem 0.85rem;
                border-radius: 8px;
                color: var(--pf-muted);
                text-decoration: none;
                font-weight: 500;
                font-size: 13px;
                transition: all .15s;
            }

            .pf-nav-link:hover,
            .pf-nav-link.active {
                background: #f0f0ff;
                color: var(--pf-accent);
            }

            .pf-nav-right {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .pf-avatar {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: var(--pf-accent);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                font-size: 13px;
                cursor: pointer;
            }

            .pf-badge-admin {
                font-size: 10px;
                background: #fef3c7;
                color: #92400e;
                padding: 2px 7px;
                border-radius: 20px;
                font-weight: 600;
            }

            /* Page header */
            .pf-page-header {
                padding: 1.5rem 0 0.5rem;
                margin-bottom: 1.5rem;
                border-bottom: 1px solid var(--pf-border);
            }

            .pf-page-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--pf-text);
                margin: 0;
            }

            /* Cards */
            .pf-card {
                background: var(--pf-surface);
                border: 1px solid var(--pf-border);
                border-radius: var(--pf-radius);
                box-shadow: var(--pf-shadow);
                transition: box-shadow .2s, border-color .2s;
            }

            .pf-card:hover {
                box-shadow: var(--pf-shadow-md);
            }

            .pf-card.selected {
                border-color: var(--pf-accent);
                box-shadow: 0 0 0 3px rgba(91, 94, 244, .12);
            }

            /* Buttons */
            .btn-pf-primary {
                background: var(--pf-accent);
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 0.45rem 1rem;
                font-size: 13px;
                font-weight: 500;
                transition: background .15s;
            }

            .btn-pf-primary:hover {
                background: var(--pf-accent-hover);
                color: #fff;
            }

            .btn-pf-ghost {
                background: transparent;
                color: var(--pf-muted);
                border: 1px solid var(--pf-border);
                border-radius: 8px;
                padding: 0.4rem 0.85rem;
                font-size: 13px;
                font-weight: 500;
                transition: all .15s;
            }

            .btn-pf-ghost:hover {
                background: var(--pf-bg);
                color: var(--pf-text);
                border-color: #ccc;
            }

            .btn-pf-danger {
                background: transparent;
                color: var(--pf-danger);
                border: 1px solid #fecaca;
                border-radius: 8px;
                padding: 0.4rem 0.85rem;
                font-size: 13px;
                font-weight: 500;
                transition: all .15s;
            }

            .btn-pf-danger:hover {
                background: #fef2f2;
                border-color: var(--pf-danger);
            }

            .btn-pf-success {
                background: var(--pf-success);
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 0.4rem 0.85rem;
                font-size: 13px;
                font-weight: 500;
                transition: background .15s;
            }

            .btn-pf-success:hover {
                background: #16a34a;
                color: #fff;
            }

            /* Form controls */
            .pf-input {
                border: 1px solid var(--pf-border);
                border-radius: 8px;
                padding: 0.5rem 0.85rem;
                font-size: 14px;
                width: 100%;
                transition: border-color .15s, box-shadow .15s;
                outline: none;
                background: var(--pf-surface);
            }

            .pf-input:focus {
                border-color: var(--pf-accent);
                box-shadow: 0 0 0 3px rgba(91, 94, 244, .1);
            }

            .pf-label {
                font-size: 13px;
                font-weight: 500;
                color: var(--pf-text);
                margin-bottom: 0.35rem;
                display: block;
            }

            /* Tag badge */
            .pf-tag {
                display: inline-flex;
                align-items: center;
                background: #f0f0ff;
                color: var(--pf-accent);
                border-radius: 20px;
                padding: 2px 10px;
                font-size: 12px;
                font-weight: 500;
            }

            /* Toast */
            .pf-toast {
                position: fixed;
                top: 1rem;
                right: 1rem;
                z-index: 9999;
                min-width: 280px;
                background: var(--pf-surface);
                border: 1px solid var(--pf-border);
                border-left: 4px solid var(--pf-success);
                border-radius: var(--pf-radius);
                padding: 0.85rem 1rem;
                box-shadow: var(--pf-shadow-md);
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-size: 13px;
                font-weight: 500;
                animation: slideIn .25s ease;
            }

            .pf-toast.error {
                border-left-color: var(--pf-danger);
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(20px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            /* Search */
            .pf-search-wrap {
                position: relative;
            }

            .pf-search-wrap .bi {
                position: absolute;
                left: 0.75rem;
                top: 50%;
                transform: translateY(-50%);
                color: var(--pf-muted);
                font-size: 14px;
            }

            .pf-search-wrap .pf-input {
                padding-left: 2.25rem;
            }

            /* Stat card */
            .pf-stat {
                background: var(--pf-surface);
                border: 1px solid var(--pf-border);
                border-radius: var(--pf-radius);
                padding: 1.25rem 1.5rem;
            }

            .pf-stat-label {
                font-size: 12px;
                font-weight: 600;
                color: var(--pf-muted);
                text-transform: uppercase;
                letter-spacing: .5px;
            }

            .pf-stat-value {
                font-size: 2rem;
                font-weight: 700;
                color: var(--pf-text);
                line-height: 1.2;
                margin-top: 0.25rem;
            }

            /* Table */
            .pf-table {
                width: 100%;
                border-collapse: collapse;
            }

            .pf-table th {
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: .5px;
                color: var(--pf-muted);
                padding: 0.75rem 1rem;
                border-bottom: 1px solid var(--pf-border);
                text-align: left;
            }

            .pf-table td {
                padding: 0.85rem 1rem;
                border-bottom: 1px solid var(--pf-border);
                vertical-align: middle;
            }

            .pf-table tr:last-child td {
                border-bottom: none;
            }

            .pf-table tr:hover td {
                background: var(--pf-bg);
            }

            /* Empty state */
            .pf-empty {
                text-align: center;
                padding: 4rem 2rem;
                color: var(--pf-muted);
            }

            .pf-empty i {
                font-size: 2.5rem;
                opacity: .3;
                display: block;
                margin-bottom: 1rem;
            }

            /* Prompt content box */
            .pf-content-box {
                background: var(--pf-bg);
                border: 1px solid var(--pf-border);
                border-radius: 8px;
                padding: 1.25rem;
                font-size: 14px;
                line-height: 1.7;
                white-space: pre-wrap;
                color: var(--pf-text);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .pf-navbar {
                    padding: 0 1rem;
                }

                .hide-mobile {
                    display: none !important;
                }
            }
        </style>
    </head>

    <body>

        {{-- Navbar --}}
        <nav class="pf-navbar">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('dashboard') }}" class="pf-navbar-brand">Prompt<span>Flow</span></a>
                <div class="pf-nav-links hide-mobile">
                    <a href="{{ route('dashboard') }}"
                        class="pf-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid me-1"></i>Dashboard
                    </a>
                    <a href="{{ route('prompts.index') }}"
                        class="pf-nav-link {{ request()->routeIs('prompts.*') ? 'active' : '' }}">
                        <i class="bi bi-collection me-1"></i>Prompts
                    </a>
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('users.index') }}"
                                class="pf-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                <i class="bi bi-people me-1"></i>Users
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="pf-nav-right">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <span class="pf-badge-admin hide-mobile">Admin</span>
                    @endif
                    <div class="dropdown">
                        <div class="pf-avatar" data-bs-toggle="dropdown">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border"
                            style="border-radius:10px; min-width:180px; font-size:13px;">
                            <li><span class="dropdown-item-text text-muted"
                                    style="font-size:12px;">{{ Auth::user()->email }}</span></li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                        class="bi bi-person me-2"></i>Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i
                                            class="bi bi-box-arrow-right me-2"></i>Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>

        {{-- Toast notification --}}
        @if (session('success'))
            <div class="pf-toast" id="pf-toast">
                <i class="bi bi-check-circle-fill text-success"></i>
                {{ session('success') }}
                <button onclick="document.getElementById('pf-toast').remove()"
                    style="margin-left:auto; background:none; border:none; cursor:pointer; color:var(--pf-muted);">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <script>
                setTimeout(() => document.getElementById('pf-toast')?.remove(), 4000);
            </script>
        @endif

        {{-- Page Content --}}
        <main class="container-lg py-4">
            @isset($header)
                <div class="pf-page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="pf-page-title">{{ $header }}</div>
                </div>
            @endisset
            {{ $slot }}
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
