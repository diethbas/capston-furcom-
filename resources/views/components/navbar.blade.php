<!-- Navigation Bar -->
<nav class="sticky top-0 border-b border-gray-200 bg-gray-900 shadow-[0_1px_2px_rgba(255,255,255,0.1)] z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-1.5">
        <div class="flex items-center justify-between w-full md:w-auto">
            <!-- Logo -->
            <a href="{{url('/')}}" class="flex items-center space-x-3 rtl:space-x-reverse ">
                <img src="/img/logo.png" class="h-8" alt="Furcom Logo" />
            </a>
            
            <!-- Mobile menu button -->
            <button id="burger-menu" data-collapse-toggle="mobile-menu" type="button"
                class="inline-flex items-center justify-center p-1 w-10 h-10 text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-white hover:bg-gray-700 focus:ring-gray-600 ml-auto">
                <span class="sr-only">Open main menu</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 7H19M5 12H19M5 17H19" stroke="white" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>


        <!-- Desktop Login and Sign Up buttons -->
        <div class="hidden md:flex items-center space-x-3 md:order-2 mt-3 md:mt-0">
            <a href="{{url('login')}}"
                class="text-gray-800 bg-gray-300 hover:bg-gray-600 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg px-3 py-1">Login</a>
            <a href="{{url('signup')}}"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-800 font-medium rounded-lg px-3 py-1">Sign Up</a>
        </div>

        <!-- Collapsible Menu for Mobile -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu">
            <ul class="flex flex-col font-medium p-3 mt-3 border rounded-lg md:flex-row md:space-x-3 md:mt-0 md:border-0 bg-gray-900 border-gray-900 md:bg-gray-900">
                <li><a href="{{url('/')}}" class="block py-1 px-2 rounded md:hover:bg-transparent md:p-0 text-white md:hover:text-blue-500 hover:text-white">Home</a></li>
                <li><a href="{{url('about')}}" class="block py-1 px-2 rounded md:hover:bg-transparent md:p-0 text-white md:hover:text-blue-500 hover:text-white">About</a></li>
                <li><a href="{{url('contact')}}" class="block py-1 px-2 rounded md:hover:bg-transparent md:p-0 text-white md:hover:text-blue-500 hover:text-white">Contact</a></li>



                
            </ul>
        </div>

        <!-- Mobile Login and Sign Up buttons -->
        <div class="flex md:hidden flex-col space-y-3 items-center fixed bottom-0 left-0 right-0 bg-gray-800 p-3 w-full sm:w-auto sm:left-auto sm:right-4">
            <a href="{{url('login')}}" class="text-gray-300 bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:ring-gray-600 font-medium rounded-lg px-3 py-1 w-full text-center sm:w-auto">Login</a>
            <a href="{{url('signup')}}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-800 font-medium rounded-lg px-3 py-1 w-full text-center sm:w-auto">Sign Up</a>
        </div>
    </div>
</nav>
