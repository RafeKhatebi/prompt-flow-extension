<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <span>{{ Auth::user()->role === 'admin' ? 'All Prompts (Admin)' : 'My Prompts' }}</span>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('prompts.export') }}" class="btn-pf-ghost text-decoration-none">
                    <i class="bi bi-download me-1"></i>Export
                </a>
                <button class="btn-pf-ghost" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="bi bi-upload me-1"></i>Import
                </button>
                <a href="{{ route('prompts.create') }}" class="btn-pf-primary text-decoration-none">
                    <i class="bi bi-plus-lg me-1"></i>New Prompt
                </a>
            </div>
        </div>
    </x-slot>

    {{-- Search --}}
    <div class="pf-search-wrap mb-4" style="max-width: 420px;">
        <i class="bi bi-search"></i>
        <input type="text" id="searchPrompts" class="pf-input" placeholder="Search by title, content, or tags…">
    </div>

    @if(Auth::user()->role === 'admin')
        {{-- Admin Table View --}}
        <div class="pf-card overflow-hidden">
            <table class="pf-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Tags</th>
                        <th>Updated</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody id="promptContainer">
                    @forelse($prompts as $prompt)
                        <tr class="prompt-item">
                            <td style="color:#adb5bd; font-size:12px;">{{ $loop->iteration }}</td>
                            <td style="font-weight:500;">{{ $prompt->title }}</td>
                            <td style="color:#6c757d;">{{ $prompt->user->name }}</td>
                            <td>@if($prompt->tags)<span class="pf-tag">{{ $prompt->tags }}</span>@else<span style="color:#ccc;">—</span>@endif</td>
                            <td style="color:#6c757d; font-size:12px;">{{ $prompt->updated_at->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('prompts.show', $prompt) }}" class="btn-pf-ghost text-decoration-none">View</a>
                                    <form action="{{ route('prompts.destroy', $prompt) }}" method="POST" onsubmit="return confirm('Delete this prompt?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-pf-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="pf-empty"><i class="bi bi-collection"></i>No prompts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $prompts->links() }}</div>

    @else
        {{-- User Card View --}}
        <div id="promptContainer">
            @forelse($prompts as $prompt)
                <div class="pf-card p-4 mb-3 prompt-item" data-id="{{ $prompt->id }}">
                    <div class="row align-items-center g-3">
                        <div class="col-md-8">
                            <div style="font-size:12px; color:#adb5bd; margin-bottom:4px;">#{{ $prompt->id }} · {{ $prompt->updated_at->diffForHumans() }}</div>
                            <h5 style="font-size:15px; font-weight:600; margin-bottom:6px;">{{ $prompt->title }}</h5>
                            <p style="font-size:13px; color:#6c757d; margin-bottom:8px; line-height:1.6;">{{ Str::limit($prompt->content, 160) }}</p>
                            @if($prompt->tags)
                                <span class="pf-tag">{{ $prompt->tags }}</span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                                <a href="{{ route('prompts.show', $prompt) }}" class="btn-pf-ghost text-decoration-none">View</a>
                                <a href="{{ route('prompts.edit', $prompt) }}" class="btn-pf-ghost text-decoration-none">Edit</a>
                                <button onclick="injectPrompt({{ \Illuminate\Support\Js::from($prompt->content) }}, {{ $prompt->id }})" class="btn-pf-success">
                                    <i class="bi bi-clipboard me-1"></i>Copy
                                </button>
                                <form action="{{ route('prompts.destroy', $prompt) }}" method="POST" onsubmit="return confirm('Delete this prompt?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-pf-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="pf-card pf-empty">
                    <i class="bi bi-collection"></i>
                    <p class="mb-2">No prompts yet.</p>
                    <a href="{{ route('prompts.create') }}" class="btn-pf-primary text-decoration-none">Create your first prompt</a>
                </div>
            @endforelse
        </div>
        <div class="mt-3">{{ $prompts->links() }}</div>
    @endif

    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('prompts.import') }}" method="POST" enctype="multipart/form-data" class="modal-content" style="border-radius:14px; border:1px solid #e9ecef;">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-semibold">Import Prompts</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p style="font-size:13px; color:#6c757d;">Select a JSON file exported from PromptFlow.</p>
                    <input type="file" name="file" class="pf-input" accept=".json" required>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-pf-ghost" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-pf-primary">Import</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Real-time search
        document.getElementById('searchPrompts').addEventListener('input', function () {
            const term = this.value.toLowerCase();
            document.querySelectorAll('.prompt-item').forEach(el => {
                el.style.display = el.innerText.toLowerCase().includes(term) ? '' : 'none';
            });
        });

        // Inject / copy with highlight
        function injectPrompt(content, id) {
            document.querySelectorAll('.prompt-item').forEach(el => el.classList.remove('selected'));
            const card = document.querySelector(`[data-id="${id}"]`);
            if (card) card.classList.add('selected');

            const textarea = document.querySelector('textarea');
            if (textarea) {
                textarea.value = content;
                textarea.focus();
                textarea.dispatchEvent(new Event('input', { bubbles: true }));
                showToast('Injected into textarea!');
            } else {
                navigator.clipboard.writeText(content)
                    .then(() => showToast('Copied to clipboard!'))
                    .catch(() => alert('Copy failed. Please try again.'));
            }
        }

        function showToast(msg) {
            const existing = document.getElementById('pf-inject-toast');
            if (existing) existing.remove();
            const t = document.createElement('div');
            t.id = 'pf-inject-toast';
            t.className = 'pf-toast';
            t.innerHTML = `<i class="bi bi-check-circle-fill" style="color:#22c55e;"></i> ${msg} <button onclick="this.parentElement.remove()" style="margin-left:auto;background:none;border:none;cursor:pointer;color:#adb5bd;"><i class="bi bi-x"></i></button>`;
            document.body.appendChild(t);
            setTimeout(() => t?.remove(), 3500);
        }
    </script>
</x-app-layout>
