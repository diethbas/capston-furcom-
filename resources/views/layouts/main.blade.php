<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    @vite(['resources/css/app.css'])
    <title>Furcom</title>
</head>
<body class="bg-gray-900">
    @if ($isShowNavBar)
    @include('components.navbar')
    @endif 
    @yield('content')
    @if ($isShowFooter)
    @include('components.footer')
    @endif
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>   
    @vite(['resources/js/app.js']) 
</body>
</html>