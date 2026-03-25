<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('users.index') }}" style="color:#6c757d; text-decoration:none; font-size:13px;">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
            <span>Edit User</span>
        </div>
    </x-slot>

    <div style="max-width: 600px;">
        <div class="pf-card p-4">
            @if ($errors->any())
                <div
                    style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:.75rem 1rem; font-size:13px; color:#dc2626; margin-bottom:1.25rem;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="pf-label" for="name">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="pf-input" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="pf-label" for="username">Username</label>
                        <input id="username" type="text" name="username"
                            value="{{ old('username', $user->username) }}" class="pf-input" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="pf-label" for="email">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="pf-input" required>
                </div>

                <div class="mb-4">
                    <label class="pf-label" for="role">Role</label>
                    <select id="role" name="role" class="pf-input" style="cursor:pointer;">
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin
                        </option>
                    </select>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn-pf-ghost text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-pf-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
