<x-guest-layout>
    @if ($errors->any())
        <div class="auth-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="auth-label" for="name">Full Name</label>
            <input id="name" class="auth-input" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe">
        </div>

        <div class="mb-3">
            <label class="auth-label" for="username">Username</label>
            <input id="username" class="auth-input" type="text" name="username" value="{{ old('username') }}" required placeholder="johndoe">
        </div>

        <div class="mb-3">
            <label class="auth-label" for="email">Email</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
        </div>

        <div class="mb-3">
            <label class="auth-label" for="password">Password</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 characters">
        </div>

        <div class="mb-4">
            <label class="auth-label" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required placeholder="••••••••">
        </div>

        <button type="submit" class="auth-btn">Create Account</button>

        <hr class="auth-divider">
        <p class="text-center mb-0" style="font-size:13px; color:#6c757d;">
            Already have an account? <a class="auth-link" href="{{ route('login') }}">Sign in</a>
        </p>
    </form>
</x-guest-layout>
