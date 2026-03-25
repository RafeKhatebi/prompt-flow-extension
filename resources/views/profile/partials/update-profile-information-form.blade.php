<section>
    <div class="mb-4">
        <div style="font-size:15px; font-weight:600; margin-bottom:4px;">Profile Information</div>
        <div style="font-size:13px; color:#6c757d;">Update your name and email address.</div>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf @method('patch')

        @if ($errors->profile->any())
            <div
                style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:.75rem 1rem; font-size:13px; color:#dc2626; margin-bottom:1rem;">
                @foreach ($errors->profile->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="mb-3">
            <label class="pf-label" for="name">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="pf-input"
                required autofocus>
        </div>

        <div class="mb-4">
            <label class="pf-label" for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                class="pf-input" required>
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div style="font-size:12px; color:#d97706; margin-top:6px;">
                    Email unverified.
                    <button form="send-verification"
                        style="background:none; border:none; color:#5b5ef4; font-size:12px; cursor:pointer; text-decoration:underline; padding:0;">Resend
                        verification</button>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <div style="font-size:12px; color:#16a34a; margin-top:4px;">Verification link sent!</div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn-pf-primary">Save Changes</button>
            @if (session('status') === 'profile-updated')
                <span style="font-size:13px; color:#16a34a;"><i class="bi bi-check-circle me-1"></i>Saved!</span>
            @endif
        </div>
    </form>
</section>
