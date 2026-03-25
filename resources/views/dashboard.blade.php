<x-app-layout>
    <x-slot name="header">Welcome back, {{ Auth::user()->name }} 👋</x-slot>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="pf-stat">
                <div class="pf-stat-label">Total Prompts</div>
                <div class="pf-stat-value">{{ Auth::user()->prompts()->count() }}</div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="pf-stat">
                <div class="pf-stat-label">This Month</div>
                <div class="pf-stat-value">{{ Auth::user()->prompts()->whereMonth('created_at', now()->month)->count() }}</div>
            </div>
        </div>
        @if(Auth::user()->role === 'admin')
        <div class="col-sm-6 col-lg-3">
            <div class="pf-stat">
                <div class="pf-stat-label">All Users</div>
                <div class="pf-stat-value">{{\App\Models\User::count()}}</div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="pf-stat">
                <div class="pf-stat-label">All Prompts</div>
                <div class="pf-stat-value">{{\App\Models\Prompt::count()}}</div>
            </div>
        </div>
        @endif
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="pf-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="mb-0 fw-semibold">Recent Prompts</h6>
                    <a href="{{ route('prompts.index') }}" style="font-size:13px; color:#5b5ef4; text-decoration:none;">View all →</a>
                </div>
                @php $recent = Auth::user()->prompts()->latest()->take(5)->get(); @endphp
                @forelse($recent as $prompt)
                    <div class="d-flex align-items-center justify-content-between py-2" style="border-bottom: 1px solid #f0f0f0;">
                        <div>
                            <div style="font-size:14px; font-weight:500;">{{ $prompt->title }}</div>
                            <div style="font-size:12px; color:#6c757d;">{{ $prompt->updated_at->diffForHumans() }}
                                @if($prompt->tags) · <span class="pf-tag">{{ $prompt->tags }}</span>@endif
                            </div>
                        </div>
                        <a href="{{ route('prompts.show', $prompt) }}" style="font-size:12px; color:#5b5ef4; text-decoration:none;">View</a>
                    </div>
                @empty
                    <div class="pf-empty" style="padding: 2rem;">
                        <i class="bi bi-collection"></i>
                        <p class="mb-0">No prompts yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="col-lg-4">
            <div class="pf-card p-4">
                <h6 class="mb-3 fw-semibold">Quick Actions</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('prompts.create') }}" class="btn-pf-primary text-center text-decoration-none py-2">
                        <i class="bi bi-plus-lg me-1"></i> New Prompt
                    </a>
                    <a href="{{ route('prompts.index') }}" class="btn-pf-ghost text-center text-decoration-none py-2">
                        <i class="bi bi-collection me-1"></i> All Prompts
                    </a>
                    <a href="{{ route('prompts.export') }}" class="btn-pf-ghost text-center text-decoration-none py-2">
                        <i class="bi bi-download me-1"></i> Export JSON
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn-pf-ghost text-center text-decoration-none py-2">
                        <i class="bi bi-person me-1"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
