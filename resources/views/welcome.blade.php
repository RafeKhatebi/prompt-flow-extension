<nav class="flex items-center justify-end gap-4">
    @auth
        <a href="{{ route('dashboard') }}" class="px-5 py-2 border rounded-sm btn btn-md">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="px-5 py-1.5  btn btn-md p-3">Log in</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="px-5 py-2  btn btn-md">Register</a>
        @endif
    @endauth
</nav>
