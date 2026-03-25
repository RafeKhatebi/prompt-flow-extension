<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('prompts.index') }}" style="color:#6c757d; text-decoration:none; font-size:13px;">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
            <span>View Prompt</span>
        </div>
    </x-slot>

    <div style="max-width: 720px;">
        <div class="pf-card p-4 mb-3">
            {{-- Meta --}}
            <div style="font-size:12px; color:#adb5bd; margin-bottom:0.5rem;">
                #{{ $prompt->id }} · by {{ $prompt->user->name }} · {{ $prompt->updated_at->format('M d, Y H:i') }}
            </div>

            {{-- Title --}}
            <h1 style="font-size:1.4rem; font-weight:700; margin-bottom:1rem; letter-spacing:-0.3px;">{{ $prompt->title }}</h1>

            {{-- Tags --}}
            @if($prompt->tags)
                <div class="mb-3">
                    <span class="pf-tag">{{ $prompt->tags }}</span>
                </div>
            @endif

            {{-- Content --}}
            <div class="pf-label mb-2">Prompt Content</div>
            <div class="pf-content-box" id="promptContent">{{ $prompt->content }}</div>
        </div>

        {{-- Actions --}}
        <div class="d-flex gap-2 flex-wrap">
            <button id="copyBtn" onclick="copyContent()" class="btn-pf-success text-decoration-none">
                <i class="bi bi-clipboard me-1"></i>Copy Content
            </button>
            <a href="{{ route('prompts.edit', $prompt) }}" class="btn-pf-ghost text-decoration-none">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
            <form action="{{ route('prompts.duplicate', $prompt) }}" method="POST">
                @csrf
                <button type="submit" class="btn-pf-ghost">
                    <i class="bi bi-copy me-1"></i>Duplicate
                </button>
            </form>
            <form action="{{ route('prompts.destroy', $prompt) }}" method="POST" onsubmit="return confirm('Delete this prompt?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-pf-danger">
                    <i class="bi bi-trash me-1"></i>Delete
                </button>
            </form>
        </div>
    </div>

    <script>
        function copyContent() {
            const content = document.getElementById('promptContent').innerText;
            navigator.clipboard.writeText(content).then(() => {
                fetch('{{ route('prompts.use', $prompt) }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                const btn = document.getElementById('copyBtn');
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check me-1"></i>Copied!';
                setTimeout(() => btn.innerHTML = orig, 2000);
            });
        }

        @if(session('copy_on_load'))
        window.addEventListener('DOMContentLoaded', () => copyContent());
        @endif
    </script>
</x-app-layout>
