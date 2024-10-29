<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <title>Furcom</title>
</head>
<body class="bg-gray-900">
    <!-- Navigation Bar -->
    <nav class="sticky top-0 py-0.5 border-b border-gray-200 shadow-sm dark:bg-gray-900 dark:border-white dark:shadow-[0_1px_2px_rgba(255,255,255,0.1)] shadow-[0_1px_2px_rgba(0,0,0,0.05)] z-50">
        <div class="max-w-screen-xl flex items-center justify-between mx-auto p-1.5">

            <!-- Logo-->
            <a href="./profile.html" class="ml-2 flex items-center space-x-3 rtl:space-x-reverse">
                <img src="/img/logo.png" class="h-8" alt="Furcon Logo" />
            </a>

            <!-- Search Bar for larger screens -->
            <div class="relative hidden md:block md:w-48 lg:w-80 mx-auto">
                <input type="text" id="search-navbar"
                    class="block w-full p-1 pl-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search...">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" stroke="CurrentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm8 8l4 4" />
                    </svg>
                </div>
            </div>

            <!-- Search Icon for smaller screens-->
            <div class="md:hidden relative">
                <button id="mobileSearchButton" data-dropdown-toggle="dropdownSearch" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-full">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="CurrentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4a6 6 0 100 12 6 6 0 000-12zm8 8l4 4" />
                    </svg>
                </button>

                <!-- Dropdown for search input -->
                <div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <div class="p-3">
                        <label for="input-group-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="CurrentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 19l-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" id="input-group-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
                        </div>
                    </div>
                </div>
            </div>


            <!-- Icons: Chat, Notification, Profile -->
            <div class="flex items-center space-x-3">

                <!-- Chat Icon with Circle Background and Badge -->
                <div class="relative">
                    <button id="chatDropdownButton" data-dropdown-toggle="chatDropdown" class="flex items-center justify-center p-1 w-8 h-8 bg-gray-800 rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h9M5 9h5m8-8H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4l3.5 4 3.5-4h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                        </svg>
                        <!-- Badge -->
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-red-100 bg-red-600 rounded-full">3</span>
                    </button>

                    <!-- Chat Dropdown menu for messages -->
                    <div id="chatDropdown" class="z-20 hidden bg-white rounded-lg shadow-lg w-72 max-h-60 overflow-y-auto dark:bg-gray-700">
                        <div class="p-4 text-sm text-gray-700 dark:text-gray-300">
                            <p class="font-semibold text-gray-900 dark:text-white">Messages</p>
                            <ul class="mt-2 space-y-2">
                                <li class="flex items-center cursor-pointer" data-modal-target="replyModal" data-modal-toggle="replyModal">
                                    <!-- Profile Picture -->
                                    <img src="/img/user2.png" alt="John Doe" class="w-8 h-8 rounded-full mr-3">
                                    <!-- Message Content -->
                                    <p class="text-gray-600 dark:text-gray-400 truncate max-w-xs">
                                        <strong>Mark Aragon:</strong> Hello! How are you? This message is too long to display in one line...
                                    </p>
                                </li>
                            </ul>                            
                        </div>
                    </div>
                </div>

                <!-- Notification Icon with Circle Background -->
                <div class="relative">
                    <button id="notificationDropdownButton" data-dropdown-toggle="notificationDropdown" class="flex items-center justify-center p-1 w-8 h-8 bg-gray-800 rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 21">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C15 15.4 15 16 14.462 16H1.538C1 16 1 15.4 1 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 8 3.464ZM4.54 16a3.48 3.48 0 0 0 6.92 0H4.54Z"/>
                        </svg>
                        <!-- Badge -->
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-red-100 bg-red-600 rounded-full">5</span>
                    </button>  
                    
                    <!-- Notification Dropdown menu -->
                    <div id="notificationDropdown" class="z-20 hidden bg-white rounded-lg shadow-lg w-72 max-h-60 overflow-y-auto dark:bg-gray-700">
                        <div class="p-4 text-sm text-gray-700 dark:text-gray-300">
                            <p class="font-semibold text-gray-900 dark:text-white">Notifications</p>
                            <ul class="mt-2 space-y-2">
                                <li class="flex items-start">
                                    <span class="block w-2.5 h-2.5 bg-blue-500 rounded-full mt-1.5"></span>
                                    <p class="ml-2 text-gray-600 dark:text-gray-400 truncate max-w-xs">Mark Aragon added you!</p>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- User Profile with Dropdown -->
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="/img/user.png" alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">Diether Daniel A. Bas</span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">dietherbas27@gmail.com</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Reply Modal -->
    <div id="replyModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center md:justify-end md:items-end bg-black bg-opacity-50">
        <div class="relative w-full md:max-w-xs bg-white bg-opacity-90 rounded-lg shadow dark:bg-gray-800 md:mr-10 md:mb-10 h-96 flex flex-col">
            <div class="p-4 border-b dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Reply to Message</h3>
                <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-900 bg-transparent hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="replyModal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Scrollable Messages Section -->
            <div class="p-4 overflow-y-auto flex-grow">
                <div class="flex items-start mb-4">
                    <img class="w-8 h-8 rounded-full object-cover mr-3" src="/img/user.png" alt="John Doe">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300"><strong class="text-gray-800 dark:text-white">John Doe:</strong> Hello! How are you?</p>
                        <span class="text-xs text-gray-500 dark:text-gray-400">5 minutes ago</span>
                    </div>
                </div>
            </div>

            <!-- Reply Input -->
            <div class="p-4 border-t dark:border-gray-600">
                <div class="relative">
                    <input type="text" class="block w-full py-2 px-4 text-gray-900 bg-gray-100 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400" placeholder="Type your message...">
                    <button class="absolute right-3 top-2.5 text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="CurrentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Profile Section -->
    <section class="flex justify-center items-center bg-gray-900">
        <div class="bg-gray-00 p-6 rounded-lg max-w-screen-lg flex flex-col md:flex-row items-center md:items-center space-y-6 md:space-y-0 md:space-x-6">

            <!-- Profile Picture Section -->
            <div class="relative">
                <label for="upload-image">
                    <img class="w-40 h-40 rounded-full object-cover border-4 border-gray-600 cursor-pointer" src="/img/user2.png" alt="Profile Picture" />
                </label>
                <!-- Image Input -->
                <input type="file" id="upload-image" class="hidden" accept="image/*" />
            </div>

            <!-- Name and Email Section -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left">
                <h2 class="text-white text-3xl font-bold">Mark Aragon</h2>
                <p class="pt-2 text-gray-400 text-sm">@mark.aragon</p>
            </div>

            <!-- Buttons Section (Add and Message) -->
            <div class="flex space-x-3 mt-4 md:mt-0 md:ml-auto">
                <!-- Add Button -->
                <button data-modal-target="furbabyModal" data-modal-toggle="furbabyModal" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add
                </button>

                <!-- Message Button -->
                <button data-modal-target="messageModal" data-modal-toggle="messageModal" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none rounded-md">
                    Message
                </button>
            </div>
        </div>
    </section>

    <!-- Message Modal -->
    <div id="messageModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center md:justify-end md:items-end bg-black bg-opacity-50">
        <div class="relative w-full md:max-w-xs bg-white bg-opacity-90 rounded-lg shadow dark:bg-gray-800 md:mr-10 md:mb-10 h-96 flex flex-col">
            <div class="p-4 border-b dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Send a Message</h3>
                <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-900 bg-transparent hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="messageModal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Scrollable Messages Section -->
            <div class="p-4 overflow-y-auto flex-grow">
                <!-- Example message from user -->
                <div class="flex items-start mb-4">
                    <img class="w-8 h-8 rounded-full object-cover mr-3" src="/img/user.png" alt="John Doe">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300"><strong class="text-gray-800 dark:text-white">John Doe:</strong> Hi there, I'm interested in connecting with you!</p>
                        <span class="text-xs text-gray-500 dark:text-gray-400">5 minutes ago</span>
                    </div>
                </div>
            </div>

            <!-- Reply Input -->
            <div class="p-4 border-t dark:border-gray-600">
                <div class="relative">
                    <input type="text" class="block w-full py-2 px-4 text-gray-900 bg-gray-100 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400" placeholder="Type your message...">
                    <button class="absolute right-3 top-2.5 text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="CurrentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>


    
    <!-- Centered Tabs -->
    <ul class="flex justify-center flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 max-w-screen-lg mx-auto" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
        <li class="mr-2">
            <button id="furbabies-tab" data-tabs-target="#furbabies" type="button" role="tab" aria-controls="furbabies" aria-selected="true" class="inline-block p-4 border-b-2 rounded-t-lg text-gray-900 border-blue-600 dark:text-white dark:border-blue-500">Furbabies</button>
        </li>
        <li class="mr-2">
            <button id="media-tab" data-tabs-target="#media" type="button" role="tab" aria-controls="media" aria-selected="false" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Media</button>
        </li>
        <li class="mr-2">
            <button id="pack-tab" data-tabs-target="#pack" type="button" role="tab" aria-controls="pack" aria-selected="false" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Troop</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div id="myTabContent" class="max-w-screen-lg mx-auto">
        
        <!-- Furbabies Content -->
        <div class="p-4" id="furbabies" role="tabpanel" aria-labelledby="furbabies-tab">
            <section class="bg-gray-900 py-8">
                <div class="max-w-screen-lg mx-auto px-4">
                    <!-- Image Cards Grid -->
                    <div class="grid grid-cols-3 gap-1 sm:gap-1 lg:gap-1">
                        <!-- Single Image Card -->
                        <div class="relative group">
                            <img class="w-full aspect-square object-cover" src="/img/pet.png" alt="Furbaby Image 1">
                            <!-- Overlay on hover -->
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                                <button data-modal-target="bigModal" data-modal-toggle="bigModal" data-furbaby="Furbaby 1" class="text-white font-semibold cursor-pointer">
                                    Name
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Media Content -->
        <div class="hidden p-4" id="media" role="tabpanel" aria-labelledby="media-tab">
            <section class="bg-gray-900 py-8">
                <div class="max-w-screen-lg mx-auto px-4">
                    <!-- Image Cards Grid -->
                    <div class="grid grid-cols-3 gap-1 sm:gap-1 lg:gap-1">
                        <!-- Single Image Card -->
                        <div class="relative group">
                            <img class="w-full aspect-square object-cover" src="/img/pet 2.png" alt="Media Image 1">
                            <!-- Overlay on hover -->
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                            </div>
                        </div>

                        <div class="relative group">
                            <img class="w-full aspect-square object-cover" src="/img/pet.png" alt="Media Image 2">
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                            </div>
                        </div>

                        <div class="relative group">
                            <img class="w-full aspect-square object-cover" src="/img//pet 3.png" alt="Media Image 3">
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Troop Content -->
        <div class="hidden p-4" id="pack" role="tabpanel" aria-labelledby="pack-tab">
            <section class="bg-gray-900 py-8">
                <div class="max-w-screen-lg mx-auto px-4">

                    <!-- Image Cards Grid -->
                    <div class="grid grid-cols-3 gap-1 sm:gap-1 lg:gap-1">
                        <!-- Single Image Card -->
                        <div class="relative group">
                            <img class="w-full aspect-square object-cover" src="/img/user2.png" alt="Pack Image 1">
                            <!-- Overlay on hover -->
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <!-- Modal Structure for Furbabies Tab -->
    <div id="bigModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto">
        <div class="relative w-full max-w-7xl mx-auto h-full">
            <div class="relative bg-gray-800 rounded-lg shadow-lg flex flex-col md:flex-row h-full overflow-hidden">
                
                <!-- Close Button (X) -->
                <button type="button" class="absolute top-4 right-3 text-gray-400 hover:text-white" data-modal-hide="bigModal">
                    <svg aria-hidden="true" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <!-- Left Column -->
                <div class="w-full md:w-[30%] bg-gray-700 p-8 flex flex-col items-center justify-start relative">
                    <!-- Profile Circle -->
                    <div class="w-40 h-40 bg-gray-500 rounded-full flex items-center justify-center mb-4 mt-8">
                        <img src="/img/pet.png" alt="Profile Picture" class="w-full h-full rounded-full object-cover">
                    </div>
                    <!-- Name and Age -->
                    <p class="text-white text-lg font-bold mb-2">Oryo</p>
                    <p class="text-gray-300 text-sm mb-8">Age: 2</p>
                    <!-- QR Code Square -->
                    <div class="w-48 h-48 bg-white flex items-center justify-center">
                        <img src="/img/qr.png" alt="QR Code" class="w-full h-full object-contain">
                    </div>
                </div>

                <!-- Right Column -->
                <div class="w-full md:w-[70%] bg-black p-16 overflow-auto no-scrollbar">
                    <!-- Image Cards Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-1">
                        <!-- Single Image Card -->
                        <div class="relative group">
                            <img class="w-full aspect-square object-cover" src="/img/pet 2.png" alt="Image 1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>