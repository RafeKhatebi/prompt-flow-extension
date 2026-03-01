<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="col-md-12">
            <div class="flex items-center  justify-between mb-6">
                {{-- items-center justify-between mb-6 --}}
                <h1 class="text-2xl font-bold">Prompts</h1>
                <a href="{{ route('prompts.create') }}" class="btn btn-primary">Create New Prompt</a>
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
                <div class="card w-full bg-dark-200 shadow-xl mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p>#{{ $prompt->id }}</p>
                                <h2 class="card-title">{{ $prompt->title }}</h2>
                                <p>{{ $prompt->content }}</p>
                                <p class="text-sm text-gray-200">Last edited:
                                    {{ $prompt->updated_at->diffForHumans() }}
                                </p>
                                <p>User: {{ $prompt->user->name }}</p>
                                @if ($prompt->tags)
                                    <div class="badge badge-outline">{{ $prompt->tags }}</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-2"> <a
                                            href="{{ route('prompts.edit', $prompt) }}"class="btn btn-sm btn-secondary">Edit</a>
                                    </div>
                                    <div class="col-md-2">
                                        <form action="{{ route('prompts.destroy', $prompt) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this prompt?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger text-white">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('prompts.show', $prompt) }}"
                                            class="btn btn-sm btn-info">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
