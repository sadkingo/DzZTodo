<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DzZtodo</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased">
    <div class="dark:bg-gray-900 min-h-screen sm:flex sm:justify-center p-40"
        style="background-image: url('{{ asset('assets/images/background.jpg') }}');background-position: center;">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div>
            <h1 class="text-white font-extrabold mb-4 md:text-6xl tracking-tighter" data-aos="zoom-y-out">
                Make your DoList
                <div
                    class="flex sm:justify-center bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-teal-400">
                    wonderful
                </div>
            </h1>
            <div class="flex justify-center mt-20">
                <a href="{{ route('register') }}">
                    <button
                        class="md:text-xl bg-blue-500 hover:bg-transparent text-white font-semibold hover:text-blue-700 py-2 px-4 border border-blue-500 hover:border-blue-500 rounded">
                        Register
                    </button>
                </a>
                <a href="{{ route('login') }}">
                    <button
                        class="ml-4 md:text-xl bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        Login
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
