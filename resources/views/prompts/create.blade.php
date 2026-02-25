{{-- $table->string('title');
$table->text('content');
$table->string('tags')->nullable(); --}}

<x-app-layout>
    <div class="container mx-auto p-6 col-md-8">
        <div class="card w-full bg-dark-200 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Create New Prompt</h2>
                <form action="{{ route('prompts.store') }}" method="POST">
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
                        <input type="text" name="title" class="input input-bordered w-full max-w-xs" required />
                    </div>
                    <div class="form-control mb-4">
                        <label class="label mb-2">Content</label>
                        <textarea name="content" class="textarea textarea-bordered w-full max-w-xs" required></textarea>
                    </div>
                    <div class="form-control mb-4">
                        <label class="label mb-2">Tags (comma separated)</label>
                        <input type="text" name="tags" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <button type="submit" class="btn btn-primary">Create Prompt</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
