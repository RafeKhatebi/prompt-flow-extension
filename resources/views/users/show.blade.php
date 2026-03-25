<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('users.index') }}" style="color:#6c757d; text-decoration:none; font-size:13px;">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
            <span>User Details</span>
        </div>
    </x-slot>

    <div style="max-width: 560px;">
        <div class="pf-card p-4 mb-3">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div
                    style="width:48px; height:48px; border-radius:50%; background:#5b5ef4; color:#fff; display:flex; align-items:center; justify-content:center; font-size:1.2rem; font-weight:700;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight:600; font-size:1rem;">{{ $user->name }}</div>
                    <div style="font-size:13px; color:#6c757d;">{{ $user->email }}</div>
                </div>
                @if ($user->role === 'admin')
                    <span
                        style="margin-left:auto; background:#fef3c7; color:#92400e; font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px;">Admin</span>
                @else
                    <span
                        style="margin-left:auto; background:#f0f0ff; color:#5b5ef4; font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px;">User</span>
                @endif
            </div>

            <div style="border-top:1px solid #e9ecef; padding-top:1rem; display:grid; gap:.75rem;">
                <div class="d-flex justify-content-between">
                    <span style="font-size:13px; color:#6c757d;">Username</span>
                    <span style="font-size:13px; font-weight:500;">{{ $user->username }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span style="font-size:13px; color:#6c757d;">Total Prompts</span>
                    <span style="font-size:13px; font-weight:500;">{{ $user->prompts()->count() }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span style="font-size:13px; color:#6c757d;">Joined</span>
                    <span style="font-size:13px; font-weight:500;">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('users.edit', $user) }}" class="btn-pf-primary text-decoration-none">
                <i class="bi bi-pencil me-1"></i>Edit User
            </a>
            <a href="{{ route('users.index') }}" class="btn-pf-ghost text-decoration-none">Back to List</a>
        </div>
    </div>
</x-app-layout>
