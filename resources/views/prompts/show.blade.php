<x-app-layout>
    <div class="container mx-auto p-6 col-md-8">
        <div class="card w-full bg-dark-200 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Show Prompt</h2>
                <form action="{{ route('prompts.index') }}" method="POST">
                    @method('GET')
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-error mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-control mb-4">
                        <label class="label mb-2">Title</label>
                        <p class="input input-bordered w-full max-w-xs" required>{{ old('title', $prompt->title) }}</p>
                    </div>
                    <div class="form-control mb-4">
                        <label class="label mb-2">Content</label>
                        <p class="textarea textarea-bordered w-full max-w-xs" required>
                            {{ old('content', $prompt->content) }}</p>
                    </div>
                    <div class="form-control mb-4">
                        <label class="label mb-2">Tags (comma separated)</label>
                        <p class="input input-bordered w-full max-w-xs" value="{{ old('tags', $prompt->tags) }}">
                            {{ old('tags', $prompt->tags) }}</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Back to List</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
