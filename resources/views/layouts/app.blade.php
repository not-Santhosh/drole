<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white flex">
        @auth
            <aside class="w-64 h-screen hidden bg-slate-100 dark:bg-slate-900 border-r border-slate-200 dark:border-slate-700 sm:flex flex-col">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </h2>
                </div>
                <nav class="flex-1 px-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('students.index') }}" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-md transition-colors">
                                Students
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('staff.index') }}" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-md transition-colors">
                                Staff
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 text-left text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-md transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </aside>
        @endauth

        <main class="flex-1">
            @yield('content')
        </main>
    </body>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @yield('scripts')
</html>