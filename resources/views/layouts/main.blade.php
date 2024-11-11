<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    @vite(['resources/css/app.css'])
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9519517676339673"
     crossorigin="anonymous"></script>
    <script>
        if (window.location.hostname === 'myslambook.net') {
            // Redirect to "furcom.myslambook.net" while preserving the path and query parameters
            window.location.href = window.location.href.replace('myslambook.net', 'furcom.myslambook.net');
        }
    </script>
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
    <!-- Loading Modal -->
    <div id="loadingModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden">
        <div class="bg-white p-8 rounded shadow-lg flex items-center justify-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path stroke="currentColor" stroke-width="4" d="M4 12a8 8 0 0116 0" />
                </svg>
                <span class="text-blue-500 text-lg">Processing...</span>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>   
    @vite(['resources/js/app.js']) 
</body>
</html>