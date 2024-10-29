<!-- Sidebar -->
<aside class="sticky top-0 flex flex-col items-center h-screen bg-white border-r border-white dark:bg-gray-900 dark:border-white">
    <nav class="flex flex-col flex-1 space-y-6 pt-4">
        @php
            $url = url('profile');
            if (Request::segment(1) == 'profile') {
                $url = url('community');
            }
        @endphp
        <a href="{{$url}}" class="p-2.5 text-gray-700 focus:outline-none transition-colors duration-200 rounded-lg dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100 flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800 dark:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2" fill="none"></circle>
                <path d="M4 20v-2c0-2.67 2.31-5 6-5s6 2.33 6 5v2" stroke="currentColor" stroke-width="2" fill="none"></path>
            </svg>
        </a>
        
        <a href="#" class="p-2.5 text-gray-700 focus:outline-none transition-colors duration-200 rounded-lg dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100 flex justify-center">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M1 5h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 1 0 0-2H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2Zm18 4h-1.424a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2h10.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Zm0 6H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 0 0 0 2h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Z"/>
            </svg>
        </a>
        
        <a href="#" class="p-2.5 text-gray-700 focus:outline-none transition-colors duration-200 rounded-lg dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100 flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800 dark:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="12 2 15 8.09 21 9.17 17 14.12 18 21 12 17.27 6 21 7 14.12 3 9.17 9 8.09 12 2" />
            </svg>
        </a>
    </nav>
    
</aside>