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
        <link rel="stylesheet" href="{{ asset('asset/css/app-page.css') }}">

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
