<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .custome-ani1 {
            animation: ani1 2s;
        }

        @keyframes ani1 {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-orange-200 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="py-12 max-w-5xl w-3/4">
            <div class="w-full">
                @foreach ($articles as $article)
                    <div
                        class="custome-ani1 m-5 mb-3 p-6 border-solid border-2 border-grey-600 rounded-lg shadow-md transition ease-in-out hover:scale-105 bg-white">
                        <div class="w-full">
                            <p class="text-3xl mb-2">{{ $article->name }}</p>
                            <p class="text-base ml-8 mb-2">{{ $article->content }}</p>
                            <p class="float-right mb-5">最新時間 : {{ $article->updated_at }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="w-full px-6">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
</body>

</html>
