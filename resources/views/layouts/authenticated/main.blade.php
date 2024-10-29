<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <title>Furcom</title>
</head>
<body class="bg-gray-900">    
    <!-- Main Container -->
    <div class="flex flex-col h-screen">

        @include('components.authenticated.navbar')
        @include('components.authenticated.modals.reply')
        @include('components.authenticated.modals.message')
        @include('components.authenticated.modals.submodal')
    <!-- Main Content Wrapper with Sidebar and Grid -->
    <div class="flex h-screen overflow-hidden">
        @include('components.authenticated.sidebar')
        @yield('content')
    </div>
    <script>
        window.Laravel = {
            userId: {{ auth()->user()->id }}
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>    
    @vite(['resources/js/app.js'])
</body>
</html>