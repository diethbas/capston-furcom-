
    <!-- Navigation Bar -->
    <nav class="sticky top-0 py-0.5 border-b border-gray-200 shadow-sm dark:bg-gray-900 dark:border-white dark:shadow-[0_1px_2px_rgba(255,255,255,0.1)] shadow-[0_1px_2px_rgba(0,0,0,0.05)] z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-1.5">
            <div class="flex items-center justify-between w-full md:w-auto">
                <!-- Mobile menu button -->
                <button id="burger-menu" data-collapse-toggle="mobile-menu" type="button"
                    class="inline-flex items-center p-1 w-10 h-10 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <!-- Logo -->
                <a href="{{url('/')}}" class="ml-2 flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="/img/logo.png" class="h-8" alt="Furcom Logo" />
                </a>
            </div>

            <!-- Desktop search bar -->
            <div class="relative hidden md:block md:w-48 lg:w-80">
                <input type="text" id="search-navbar"
                    class="block w-full p-1 pl-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search...">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm8 8l4 4" />
                    </svg>
                </div>
            </div>

            <!-- Login and Sign Up buttons (Desktop) -->
            <div class="hidden md:flex items-center space-x-3 md:order-2 mt-3 md:mt-0">
                <a href="{{url('login')}}"
                    class="text-gray-900 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-400 font-medium rounded-lg px-3 py-1">Login</a>
                <a href="{{url('signup')}}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg px-3 py-1">Sign Up</a>
            </div>

            <!-- Collapsible Menu for Mobile -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu">
                <ul class="flex flex-col font-medium p-3 mt-3 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-3 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 dark:border-gray-700 md:dark:bg-gray-900">
                    <li><a href="{{url('/')}}" class="block py-1 px-2 text-gray-900 rounded md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white">Home</a></li>
                    <li><a href="{{url('about')}}" class="block py-1 px-2 text-gray-900 rounded md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white">About</a></li>
                    <li><a href="{{url('contact')}}" class="block py-1 px-2 text-gray-900 rounded md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white">Contact</a></li>
                    <!-- Mobile Search Bar -->
                    <li class="relative mt-2 md:hidden">
                        <input type="text"
                            class="block w-full p-1.5 pl-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search...">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4a6 6 0 100 12 6 6 0 000-12zm8 8l4 4" />
                            </svg>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Mobile Login and Sign Up buttons -->
            <div class="flex md:hidden flex-col space-y-3 items-center fixed bottom-0 left-0 right-0 bg-gray-50 dark:bg-gray-900 p-3 w-full sm:w-auto sm:left-auto sm:right-4">
                <a href="{{url('login')}}" class="text-gray-900 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-400 font-medium rounded-lg px-3 py-1 w-full text-center sm:w-auto">Login</a>
                <a href="{{url('signup')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg px-3 py-1 w-full text-center sm:w-auto">Sign Up</a>
            </div>
        </div>
    </nav>