<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('View Prompt') }} #{{ $prompt->id }}
            </h2>
            <a href="{{ route('prompts.index') }}"
                class="inline-flex items-center px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition ease-in-out duration-150">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Title Section -->
                    <div class="mb-3 border-b pb-4 dark:border-gray-700">
                        <label
                            class="block text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</label>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">
                            {{ $prompt->title }}
                        </h1>
                    </div>

                    <!-- Content Section -->
                    <div class="mb-3">
                        <label
                            class="block text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Prompt
                            Content</label>
                        <div
                            class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border dark:border-gray-700 text-gray-800 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">
                            {{ $prompt->content }}
                        </div>
                    </div>

                    <!-- Metadata Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tags</label>
                            <div class="mt-1">
                                @if ($prompt->tags)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                        {{ $prompt->tags }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-sm">No tags assigned</span>
                                @endif
                            </div>
                        </div>

                        <div class="text-right md:text-left">
                            <label
                                class="block text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Information</label>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                <strong>Author:</strong> {{ $prompt->user->name }}<br>
                                <strong>Last Updated:</strong> {{ $prompt->updated_at->format('M d, Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-10 pt-6 border-t dark:border-gray-700 flex gap-3">
                        <a href="{{ route('prompts.edit', $prompt) }}" class="btn btn-primary">
                            Edit Prompt
                        </a>
                        <button
                            onclick="navigator.clipboard.writeText('{{ addslashes($prompt->content) }}').then(() => alert('Copied!'))"
                            class="btn btn-success text-white">
                            Copy Content
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
