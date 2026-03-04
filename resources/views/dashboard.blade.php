<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Welcome back, {{ Auth::user()->name }}!
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Here is a summary of your system activity.
                    </p>
                </div>
            </div>

            <!-- Stats Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Prompts Count -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-indigo-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Total Prompts</div>
                    <div class="text-3xl font-bold dark:text-white">{{ Auth::user()->prompts()->count() }}</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-indigo-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Quick Actions</div>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('prompts.index') }}"
                            class="inline-flex items-center bg-indigo-600 border px-2 py-2 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150">
                            Manage Prompts
                        </a>

                        <a href="{{ route('prompts.create') }}"
                            class="inline-flex items-center  bg-gray-800 dark:bg-gray-200 px-2 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition ease-in-out duration-150">
                            + New Prompt
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
