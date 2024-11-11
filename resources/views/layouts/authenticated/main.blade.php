<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    @vite(['resources/css/app.css'])
    @if (session()->has('t'))
    <script>
        sessionStorage.setItem('t', '{{session('t')}}')
    </script>
    @endif
    <script>
        window._ = window._ || {};
        window._.csrf = "{{ csrf_token() }}";
    </script>
    <style>
        #sendMessage-bodyview .msg-from-notme, #sendMessage-bodyview .msg-from-me {
            margin-top: 5px;
        }

        #sendMessage-bodyview .msg-from-me .msgbox-img{
            visibility: hidden;
        }

        #sendMessage-bodyview .msg-from-me + .msg-from-notme, 
        #sendMessage-bodyview .msg-from-notme + .msg-from-me{
            margin-top: 15px;
        }

        #sendMessage-bodyview .hide-details .msgbox-message{
            border-radius: 0.75rem;

        }
        #sendMessage-bodyview .hide-details .msgbox-img{
            visibility: hidden;
        }
        #sendMessage-bodyview .hide-details .msgbox-details{
            display: none;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #ffffff64;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #e0e0e0;
        }
        .new-notif p:first-child {
            color: white !important
        }
    </style>
    <title>Furcom</title>
</head>
<body class="bg-gray-900">    
    <!-- Main Container -->
    <div class="flex flex-col h-screen">

        @include('components.authenticated.navbar')
        @include('components.authenticated.modals.message')
        @include('components.authenticated.modals.submodal')
        
    <div class="flex">
        @if (!isset($isNoSidebar)
        || !$isNoSidebar)
        @include('components.authenticated.sidebar')
        @endif
        @yield('content')
    </div>
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

    <script>
        window.Laravel = {
            userId: {{ auth()->user()->id }}
        };
        document.addEventListener('DOMContentLoaded', function () {
            var items = document.querySelectorAll('button[data-modal-hide]');

            for (const i of items) {
                i.addEventListener('click', function() {
                    const modalId = i.getAttribute('data-modal-hide');
                    
                    // Hide the modal by adding the 'hidden' class
                    document.getElementById(modalId).classList.add('hidden');
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>    
    @vite(['resources/js/app.js'])
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9519517676339673"
     crossorigin="anonymous"></script>
</body>
</html>