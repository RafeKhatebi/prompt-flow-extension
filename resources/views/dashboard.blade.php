<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-2xl font-bold p-6 text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h2>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Welcome to your dashboard! Here you can manage your prompts, view analytics, and customize your profile.') }}
                </div>
                <div class="mb-4 p-6">
                    <a href="{{ route('prompts.index') }}" class="px-5 py-2 border rounded-sm btn btn-md m-6">View
                        Your
                        Prompts</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
