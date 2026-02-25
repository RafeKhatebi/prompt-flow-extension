<x-app-layout>
    <div class="container mx-auto p-6 col-md-8">
        <div class="card w-full bg-dark-200 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Edit Prompt</h2>
                <form action="{{ route('prompts.update', $prompt->id) }}" method="POST">
                    @method('PUT')
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
                        <input type="text" name="title" class="input input-bordered w-full max-w-xs" required
                            value="{{ old('title', $prompt->title) }}" />
                    </div>
                    <div class="form-control mb-4">
                        <label class="label mb-2">Content</label>
                        <textarea name="content" class="textarea textarea-bordered w-full max-w-xs" required>{{ old('content', $prompt->content) }}</textarea>
                    </div>
                    <div class="form-control mb-4">
                        <label class="label mb-2">Tags (comma separated)</label>
                        <input type="text" name="tags" class="input input-bordered w-full max-w-xs"
                            value="{{ old('tags', $prompt->tags) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary">Update Prompt</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
