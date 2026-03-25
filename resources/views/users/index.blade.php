<x-app-layout>
    <x-slot name="header">Users Management</x-slot>

    <div class="pf-card overflow-hidden">
        <table class="pf-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td style="color:#adb5bd; font-size:12px;">{{ $user->id }}</td>
                        <td style="font-weight:500;">{{ $user->name }}</td>
                        <td style="color:#6c757d;">{{ $user->email }}</td>
                        <td style="color:#6c757d;">{{ $user->username }}</td>
                        <td>
                            @if ($user->role === 'admin')
                                <span
                                    style="background:#fef3c7; color:#92400e; font-size:11px; font-weight:600; padding:2px 8px; border-radius:20px;">Admin</span>
                            @else
                                <span
                                    style="background:#f0f0ff; color:#5b5ef4; font-size:11px; font-weight:600; padding:2px 8px; border-radius:20px;">User</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('users.show', $user->id) }}"
                                    class="btn-pf-ghost text-decoration-none">View</a>
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn-pf-ghost text-decoration-none">Edit</a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                    onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-pf-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="pf-empty"><i class="bi bi-people"></i>No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $users->links() }}</div>
</x-app-layout>
