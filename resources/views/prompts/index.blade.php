<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Prompts Management') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('prompts.export') }}" class="btn btn-sm btn-success">Export</a>
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
                <a href="{{ route('prompts.create') }}" class="btn btn-sm btn-primary">Create New</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Search Bar -->
            <div class="mb-6">
                <input type="text" id="searchPrompts" class="form-control form-control-lg shadow-sm"
                    placeholder="Search by title, content, or tags...">
            </div>

            @if (Auth::user()->role === 'admin')
                <!-- Admin Table View -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4 dark:text-white">Master List: All Prompts</h2>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle dark:text-gray-300">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Updated</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="promptContainer">
                                @foreach ($prompts as $prompt)
                                    <tr class="prompt-item">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $prompt->title }}</strong></td>
                                        <td>{{ $prompt->user->name }}</td>
                                        <td>{{ $prompt->updated_at->diffForHumans() }}</td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('prompts.show', $prompt) }}"
                                                    class="btn btn-sm btn-info">View</a>
                                                <form action="{{ route('prompts.destroy', $prompt) }}" method="POST"
                                                    onsubmit="return confirm('Delete this prompt?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $prompts->links() }}
                    </div>
                </div>
            @else
                <!-- User Card View -->
                <div id="promptContainer">
                    @foreach ($prompts as $prompt)
                        <div class="card w-full shadow-sm mb-4 prompt-item border-0 dark:bg-gray-800"
                            data-prompt-id="{{ $prompt->id }}">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <p class="text-muted small mb-1">#{{ $prompt->id }} •
                                            {{ $prompt->user->name }}</p>
                                        <h4 class="card-title font-bold dark:text-white">{{ $prompt->title }}</h4>
                                        <p class="text-gray-600 dark:text-gray-400">
                                            {{ Str::limit($prompt->content, 150) }}</p>
                                        <div class="mt-2">
                                            @if ($prompt->tags)
                                                <span
                                                    class="badge bg-light text-dark border">{{ $prompt->tags }}</span>
                                            @endif
                                            <span class="text-xs text-gray-400 ml-2">Edited
                                                {{ $prompt->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('prompts.show', $prompt) }}"
                                                class="btn btn-sm btn-outline-info">View</a>
                                            <a href="{{ route('prompts.edit', $prompt) }}"
                                                class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <form action="{{ route('prompts.destroy', $prompt) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                            <button
                                                onclick="injectPrompt({{ \Illuminate\Support\Js::from($prompt->title) }}, {{ \Illuminate\Support\Js::from($prompt->content) }}, {{ \Illuminate\Support\Js::from($prompt->tags) }}, {{ $prompt->id }})"
                                                class="btn btn-sm btn-success">Copy All</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $prompts->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('prompts.import') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import JSON Prompts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="file" class="form-control" accept=".json" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Start Import</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Universal Search Logic
        document.getElementById('searchPrompts')?.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('.prompt-item').forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(term) ? '' : 'none';
            });
        });

        function injectPrompt(title, content, tags, id) {
            // Remove previous highlights
            document.querySelectorAll('.prompt-item').forEach(el => el.classList.remove('ring-2', 'ring-green-500'));

            // Add highlight to selected
            const selected = document.querySelector(`[data-prompt-id="${id}"]`);
            if (selected) selected.classList.add('ring-2', 'ring-green-500');

            // Copy to clipboard logic
            navigator.clipboard.writeText(content).then(() => {
                alert('Prompt content copied to clipboard!');
            });
        }
    </script>
</x-app-layout>
