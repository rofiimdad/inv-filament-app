<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-gray-900 border-b border-gray-700 p-4 flex items-center justify-between">
                <h1 class=" text-gray-100 text-lg font-semibold">{{ $data['barcode_number'] ?? 'Dashboard' }}</h1>
            </header>

            <!-- Content -->
            <main class="bg-gray-900 flex-1 p-6 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>
