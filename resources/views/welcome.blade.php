<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">

        <!-- Background Image -->
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg"
            alt="Background"
        />

        <!-- Main Container -->
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">

            <div class="relative w-full max-w-7xl px-6 lg:px-8">

                <!-- Header -->
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">

                    <!-- Logo -->
                    <div class="flex lg:justify-center lg:col-start-2">

                        <h1 class="text-3xl font-bold text-[#FF2D20]">
                            Laravel
                        </h1>

                    </div>

                    <!-- Navigation -->
                    @if (Route::has('login'))

                        <nav class="-mx-3 flex flex-1 justify-end">

                            @auth

                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black dark:text-white hover:text-black/70 dark:hover:text-white/80 transition"
                                >
                                    Dashboard
                                </a>

                            @else

                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black dark:text-white hover:text-black/70 dark:hover:text-white/80 transition"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))

                                    <a
                                        href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black dark:text-white hover:text-black/70 dark:hover:text-white/80 transition"
                                    >
                                        Register
                                    </a>

                                @endif

                            @endauth

                        </nav>

                    @endif

                </header>

                <!-- Main Content -->
                <main class="mt-6">

                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">

                        <!-- Documentation Card -->
                        <a
                            href="https://laravel.com/docs"
                            target="_blank"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white dark:bg-zinc-900 p-6 shadow-lg transition hover:scale-105 duration-300"
                        >

                            <img
                                src="https://laravel.com/assets/img/welcome/docs-light.svg"
                                alt="Laravel Docs"
                                class="rounded-lg"
                            />

                            <div>

                                <h2 class="text-xl font-semibold text-black dark:text-white">
                                    Documentation
                                </h2>

                                <p class="mt-4 text-sm leading-relaxed">
                                    Laravel has wonderful documentation covering every aspect of the framework.
                                    Whether you are a beginner or experienced developer, Laravel docs are very helpful.
                                </p>

                            </div>

                        </a>

                        <!-- Laracasts Card -->
                        <a
                            href="https://laracasts.com"
                            target="_blank"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white dark:bg-zinc-900 p-6 shadow-lg transition hover:scale-105 duration-300"
                        >

                            <img
                                src="https://laravel.com/assets/img/welcome/docs-dark.svg"
                                alt="Laracasts"
                                class="rounded-lg"
                            />

                            <div>

                                <h2 class="text-xl font-semibold text-black dark:text-white">
                                    Laracasts
                                </h2>

                                <p class="mt-4 text-sm leading-relaxed">
                                    Laracasts offers thousands of tutorials on Laravel, PHP, JavaScript, and modern web development.
                                </p>

                            </div>

                        </a>

                        <!-- Laravel News -->
                        <a
                            href="https://laravel-news.com"
                            target="_blank"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white dark:bg-zinc-900 p-6 shadow-lg transition hover:scale-105 duration-300"
                        >

                            <div>

                                <h2 class="text-xl font-semibold text-black dark:text-white">
                                    Laravel News
                                </h2>

                                <p class="mt-4 text-sm leading-relaxed">
                                    Get all the latest Laravel updates, tutorials, packages, and community news.
                                </p>

                            </div>

                        </a>

                        <!-- Ecosystem -->
                        <div
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white dark:bg-zinc-900 p-6 shadow-lg"
                        >

                            <div>

                                <h2 class="text-xl font-semibold text-black dark:text-white">
                                    Vibrant Ecosystem
                                </h2>

                                <p class="mt-4 text-sm leading-relaxed">

                                    Laravel provides many amazing tools like:

                                    <a href="https://forge.laravel.com" class="underline text-[#FF2D20]">
                                        Forge
                                    </a>,

                                    <a href="https://vapor.laravel.com" class="underline text-[#FF2D20]">
                                        Vapor
                                    </a>,

                                    <a href="https://nova.laravel.com" class="underline text-[#FF2D20]">
                                        Nova
                                    </a>

                                    and many more.

                                </p>

                            </div>

                        </div>

                    </div>

                </main>

                <!-- Footer -->
                <footer class="py-16 text-center text-sm text-black dark:text-white/70">

                    Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                    (PHP v{{ PHP_VERSION }})

                </footer>

            </div>

        </div>

    </div>

</body>
</html>
