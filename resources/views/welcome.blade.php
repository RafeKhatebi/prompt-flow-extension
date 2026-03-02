<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
        <!-- This line connects your Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <nav class="flex gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2 bg-blue-600 text-black rounded-md">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-white border border-gray-300 rounded-md">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-white text-black rounded-md">Register</a>
                    @endif
                @endauth
            </nav>
        </div>
    </body>

</html>
