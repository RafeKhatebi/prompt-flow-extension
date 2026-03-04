<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="col-md-12">
            <div class="flex items-center  justify-between mb-6">
                {{-- items-center justify-between mb-6 --}}
                <h1 class="text-2xl font-bold">Prompts</h1>
                <div>
                    <a href="{{ route('prompts.export') }}" class="btn btn-success me-2">Export</a>
                    <button class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
                    <a href="{{ route('prompts.create') }}" class="btn btn-primary">Create New Prompt</a>
                </div>
            </div>
            <div class="mb-4">
                <input type="text" id="searchPrompts" class="form-control"
                    placeholder="Search prompts by title, content, or tags...">
            </div>
        </div>
        @if (Auth::user()->role === 'admin')
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Admin List: All Prompts</h2>
                <ul class="list-disc pl-5"> {{-- Added <ul> here --}}
                    @foreach ($prompts as $prompt)
                        <li class="mb-2">
                            <span class="text-sm text-gray-500 p-2">{{ $loop->iteration }}</span>
                            <span class="font-semibold">{{ $prompt->title }}</span>
                            <span class="font-light text-sm p-4">{{ $prompt->updated_at->diffForHumans() }}</span>
                            <span class="text-sm text-gray-500">— Created by: {{ $prompt->user->name }}</span>
                            <a href="{{ route('prompts.show', $prompt) }}"
                                class="text-blue-500 hover:underline ml-2">View</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            @foreach ($prompts as $prompt)
                {{-- Will return all created prompts --}}
                <div class="card w-full bg-dark-200 shadow-xl mb-4 prompt-card" data-prompt-id="{{ $prompt->id }}">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Main Content (8 columns for better spacing) -->
                            <div class="col-md-8">
                                <p class="text-muted mb-1">#{{ $prompt->id }}</p>
                                <h2 class="card-title">{{ $prompt->title }}</h2>
                                <p>{{ $prompt->content }}</p>
                                <p class="text-sm text-secondary">
                                    Last edited: {{ $prompt->updated_at->diffForHumans() }}
                                </p>
                                <p><strong>User:</strong> {{ $prompt->user->name ?? 'Unknown' }}</p>

                                @if ($prompt->tags)
                                    <div class="badge badge-outline border-secondary">{{ $prompt->tags }}</div>
                                @endif
                            </div>

                            <!-- Action Buttons (4 columns) -->
                            <div class="col-md-4">
                                <div class="d-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('prompts.show', $prompt) }}" class="btn btn-sm btn-info">View</a>

                                    <a href="{{ route('prompts.edit', $prompt) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>

                                    <form action="{{ route('prompts.destroy', $prompt) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger text-white">Delete</button>
                                    </form>

                                    <!-- Inject Buttons -->
                                    <button
                                        onclick="injectPrompt(
                    {{ \Illuminate\Support\Js::from($prompt->title) }},
                    {{ \Illuminate\Support\Js::from($prompt->content) }},
                    {{ \Illuminate\Support\Js::from($prompt->tags) }}, 
                    {{ $prompt->id }})"
                                        class="btn btn-sm btn-success text-white">
                                        Inject/Copy
                                    </button>

                                    <button
                                        onclick="injectPrompt('', {{ \Illuminate\Support\Js::from($prompt->content) }}, '', {{ $prompt->id }})"
                                        class="btn btn-sm btn-primary text-white">
                                        Just Prompt
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Prompts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('prompts.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Select JSON file</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".json"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net"></script>
    <script>
        // Search functionality
        document.getElementById('searchPrompts')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.card, .bg-white li');

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        function injectPrompt(title, content, tags, promptId) {
            // Highlight selected prompt
            document.querySelectorAll('.prompt-card').forEach(card => {
                card.style.border = '';
            });
            if (promptId) {
                const selectedCard = document.querySelector(`[data-prompt-id="${promptId}"]`);
                if (selectedCard) selectedCard.style.border = '3px solid #28a745';
            }
            // Debugging: Open your browser console (F12) to see if this triggers
            console.log("Button Clicked:", {
                title,
                content,
                tags
            });
            // This removes the labels and just joins the values with new lines
            const fullText = `${title}\n\n${content}\n\n${tags || ''}`;

            // const fullText = `Title: ${title}\n\nPrompt: ${content}\n\nTags: ${tags || 'No tags'}`;
            const textarea = document.querySelector('textarea');

            // Check if SweetAlert is actually loaded
            const hasSwal = typeof Swal !== 'undefined';

            if (textarea) {
                textarea.value = fullText;
                textarea.focus();
                textarea.dispatchEvent(new Event('input', {
                    bubbles: true
                }));

                if (hasSwal) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Injected!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    alert('Injected into textarea!');
                }
            } else {
                // Attempt to copy to clipboard
                navigator.clipboard.writeText(fullText).then(() => {
                    if (hasSwal) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'info',
                            title: 'Copied to clipboard!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        alert('Copied to clipboard!');
                    }
                }).catch(err => {
                    console.error('Failed to copy: ', err);
                    alert('Copy failed. Check browser console.');
                });
            }
        }
    </script>


</x-app-layout>
