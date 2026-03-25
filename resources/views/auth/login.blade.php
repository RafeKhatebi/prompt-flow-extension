<x-guest-layout>
    <x-auth-session-status class="mb-3" :status="session('status')" />

    @if ($errors->any())
        <div class="auth-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="auth-label" for="email">Email</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@example.com">
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="auth-label mb-0" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
        </div>

        <div class="mb-4 d-flex align-items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember" style="accent-color: #5b5ef4;">
            <label for="remember_me" style="font-size:13px; color:#6c757d; cursor:pointer;">Remember me</label>
        </div>

        <button type="submit" class="auth-btn">Sign In</button>

        <hr class="auth-divider">
        <p class="text-center mb-0" style="font-size:13px; color:#6c757d;">
            Don't have an account? <a class="auth-link" href="{{ route('register') }}">Create one</a>
        </p>
    </form>
</x-guest-layout>
