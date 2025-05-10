<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full">

    @if (!Route::is('register.form') && !Route::is('login.form'))

        <div class="flex h-screen">
            {{-- Sidebar tampil jika di dashboard --}}
            @if (Route::is('dashboard'))
                <x-sidebar />
            @endif

            {{-- Konten utama + Navbar --}}
            <div class="flex flex-col flex-1 overflow-hidden">
                <x-navbar />

                <main class="flex-1 overflow-auto">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

    @else
        {{-- Untuk halaman login/register yang tidak pakai sidebar/navbar --}}
        <main class="h-full">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    @endif

    <script src="script/logoutdropdown.js"></script>
</body>

</html>
