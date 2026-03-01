<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0">User Details</h2>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">Back to List</a>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted">Full Name</div>
                            <div class="col-sm-8 fw-bold">{{ $user->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted">Email Address</div>
                            <div class="col-sm-8">{{ $user->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted">Username</div>
                            <div class="col-sm-8"><code>{{ $user->username }}</code></div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-sm-4 text-muted">Account Role</div>
                            <div class="col-sm-8">
                                <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light text-end">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
