<section>
    <div class="mb-4">
        <div style="font-size:15px; font-weight:600; margin-bottom:4px;">Update Password</div>
        <div style="font-size:13px; color:#6c757d;">Use a long, random password to keep your account secure.</div>
    </div>

    <form method="post" action="{{ route('password.update') }}">
        @csrf @method('put')

        @if($errors->updatePassword->any())
            <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:.75rem 1rem; font-size:13px; color:#dc2626; margin-bottom:1rem;">
                @foreach($errors->updatePassword->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif

        <div class="mb-3">
            <label class="pf-label" for="current_password">Current Password</label>
            <input id="current_password" type="password" name="current_password" class="pf-input" autocomplete="current-password" placeholder="••••••••">
        </div>

        <div class="mb-3">
            <label class="pf-label" for="new_password">New Password</label>
            <input id="new_password" type="password" name="password" class="pf-input" autocomplete="new-password" placeholder="Min. 8 characters">
        </div>

        <div class="mb-4">
            <label class="pf-label" for="password_confirmation">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="pf-input" autocomplete="new-password" placeholder="••••••••">
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn-pf-primary">Update Password</button>
            @if (session('status') === 'password-updated')
                <span style="font-size:13px; color:#16a34a;"><i class="bi bi-check-circle me-1"></i>Updated!</span>
            @endif
        </div>
    </form>
</section>
