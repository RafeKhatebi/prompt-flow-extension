<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('prompts.index') }}" style="color:#6c757d; text-decoration:none; font-size:13px;">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
            <span>Edit Prompt</span>
        </div>
    </x-slot>

    <div style="max-width: 680px;">
        <div class="pf-card p-4">
            @if ($errors->any())
                <div
                    style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:.75rem 1rem; font-size:13px; color:#dc2626; margin-bottom:1.25rem;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('prompts.update', $prompt) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="pf-label" for="title">Title</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $prompt->title) }}"
                        class="pf-input" required>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="pf-label mb-0" for="content">Prompt Content</label>
                        <span id="charCount" style="font-size:12px; color:#adb5bd;"></span>
                    </div>
                    <textarea id="content" name="content" rows="8" class="pf-input" required style="resize:vertical;">{{ old('content', $prompt->content) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="pf-label" for="tags">Tags <span
                            style="color:#adb5bd; font-weight:400;">(optional)</span></label>
                    <input id="tags" type="text" name="tags" value="{{ old('tags', $prompt->tags) }}"
                        class="pf-input" placeholder="e.g. writing, email">
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('prompts.index') }}" class="btn-pf-ghost text-decoration-none">Cancel</a>
                    <button type="submit" class="btn-pf-primary">Update Prompt</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const textarea = document.getElementById('content');
        const counter = document.getElementById('charCount');
        textarea.addEventListener('input', () => {
            const len = textarea.value.length;
            counter.textContent = `${len.toLocaleString()} chars · ~${Math.ceil(len / 4).toLocaleString()} tokens`;
        });
        textarea.dispatchEvent(new Event('input'));
    </script>
</x-app-layout>
