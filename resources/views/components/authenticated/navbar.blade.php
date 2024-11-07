<!-- Navigation Bar -->

<nav class="sticky top-0 py-0.5 border-b border-gray-200 bg-gray-900 shadow-[0_1px_2px_rgba(0,0,0,0.05)] z-50">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-1.5">

        <!-- Logo -->
        <a href="/profile" class="ml-2 flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/img/logo.png" class="h-8" alt="Furcon Logo" />
        </a>

        <!-- Search Bar -->
        <div class="relative hidden md:block md:w-48 lg:w-80 mx-auto" onclick="document.getElementById('searchModal').classList.remove('hidden'); document.getElementById('searchText').value = ''; document.getElementById('searchText').focus(); window._.searchbox.findFurparent();">
            <input type="text" id="search-navbar"
                class="block w-full p-1 pl-8 text-sm border  rounded-lg   bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search..." readonly>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4  text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" stroke="CurrentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm8 8l4 4" />
                </svg>
            </div>
        </div>

        <!-- Search Icon  -->
        <div class="md:hidden relative">
            <button id="mobileSearchButton" class="text-gray-400  bg-gray-700 p-2 rounded-full" onclick="document.getElementById('searchModal').classList.remove('hidden'); document.getElementById('searchText').value = ''; document.getElementById('searchText').focus(); window._.searchbox.findFurparent();">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="CurrentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4a6 6 0 100 12 6 6 0 000-12zm8 8l4 4" />
                </svg>
            </button>
        </div>


        <!-- Chat, Notification, Profile -->
        <div class="flex items-center space-x-3">

            <!-- Chat Icon with Circle Background and Badge -->
            <div class="relative">
                <button id="chatDropdownButton" data-dropdown-toggle="chatDropdown" class="flex items-center justify-center p-1 w-8 h-8 bg-gray-800 rounded-full   focus:outline-none text-gray-400 hover:bg-gray-700" onclick="window._.notif.msgNotifTagRead()">
                    <svg class="w-5 h-5  text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h9M5 9h5m8-8H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4l3.5 4 3.5-4h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                    </svg>
                    <!-- Badge -->
                    @if (isset($messageUnreadCount) && $messageUnreadCount > 0)
                    <span id="badge-msg"  class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-1 text-[10px] font-bold leading-none text-red-100 bg-red-600 rounded-full">{{$messageUnreadCount}}</span>
                    @endif
                </button>

                <!-- Chat Dropdown menu for messages -->
                <div id="chatDropdown" class="z-20 hidden rounded-lg shadow-lg w-72 max-h-60 overflow-y-auto bg-gray-700">
                    <div class="p-4 text-sm text-gray-300">
                        <p class="font-semibold  text-white">Messages</p>
                        <ul class="mt-2 space-y-2">
                            @if (isset($messages))
                            @foreach ($messages as $item)
                            <li class="flex items-center cursor-pointer {{!$item['isread'] && $item['isreadTo'] == session('user.furparentID') ? 'new-notif' : ''}}" data-modal-target="messageModal" data-modal-toggle="messageModal" onClick="window._.mbox.setMessageToId('{{$item['talkTo_id']}}', '{{$item['talkTo_firstname']}}', '{{$item['talkTo_lastname']}}', '{{$item['talkTo_img']}}')">
                                <!-- Profile Picture -->
                                @if($item['talkTo_img'] == null || $item['talkTo_img'] == '' || $item['talkTo_img'] == '/')
                                <img class="w-8 h-8 rounded-full mr-3" src="{{'https://ui-avatars.com/api/?name=' . $item['talkTo_firstname'] .' '.$item['talkTo_lastname'] . '&size=150'}}" alt="user photo">
                                @else
                                <img src="{{$item['talkTo_img']}}" alt="{{$item['talkTo_firstname'].' '.$item['talkTo_lastname']}} profile" class="w-8 h-8 rounded-full mr-3">
                                @endif
                                <!-- Message Content -->
                                <div class="container">
                                    <p class="text-gray-500"><strong>{{$item['talkTo_firstname'].' '.$item['talkTo_lastname']}}</strong></p>
                                    <p class="text-gray-400 truncate max-w-xs">
                                        {{$item['sender_id'] == session('user.furparentID') ? 'You' : $item['sender_firstname'].' '.$item['sender_lastname']}}: {{ $item['latestMessage'] }}
                                    </p>
                                </div>
                            </li>
                            
                            @endforeach   
                            @endif    
                            
                            @if(!isset($messages) 
                            || count($messages) == 0)
                            <li class="flex items-start">
                                No new messages.
                            </li>
                            @endif
                        </ul>                            
                    </div>
                </div>
            </div>

            <!-- Notification Icon -->
            <div class="relative">
                <button id="notificationDropdownButton" data-dropdown-toggle="notificationDropdown" class="flex items-center justify-center p-1 w-8 h-8 bg-gray-800 rounded-full focus:outline-none text-gray-400 hover:bg-gray-700" onclick="window._.notif.notificationTagRead()">
                    <svg class="w-6 h-6  text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 21">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C15 15.4 15 16 14.462 16H1.538C1 16 1 15.4 1 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 8 3.464ZM4.54 16a3.48 3.48 0 0 0 6.92 0H4.54Z"/>
                    </svg>
                    <!-- Badge -->
                    @if (isset($notificationUnreadCount) && $notificationUnreadCount > 0)
                    <span id="badge-notif" class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-1 text-[10px] font-bold leading-none text-red-100 bg-red-600 rounded-full">{{$notificationUnreadCount}}</span>
                    @endif
                </button> 
                
                <!-- Notification Dropdown menu -->
                <div id="notificationDropdown" class="z-20 hidden rounded-lg shadow-lg w-72 max-h-60 overflow-y-auto bg-gray-700">
                    <div class="p-4 text-sm  text-gray-300">
                        <p class="font-semibold  text-white">Notifications</p>
                        <ul class="mt-2 space-y-2">
                            
                            @if (isset($notifications))
                            @foreach ($notifications as $item)
                            <li class="{{$item['isread'] ? '' : 'new-notif'}} flex items-start">
                                <span class="block w-2.5 h-2.5 bg-blue-500 rounded-full mt-1.5"></span>
                                <p class="ml-2  text-gray-400 truncate max-w-xs">{!! $item['description'] !!}</p>
                            </li>  
                            @endforeach
                            @endif   
                            
                            @if(!isset($notifications) 
                            || count($notifications) == 0)
                            <li class="flex items-start">
                                No new notifications.
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- User Profile with Dropdown -->
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4  focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                @if(session('user.img') == null || session('user.img') == '' || session('user.img') == '/')
                <img class="w-8 h-8 rounded-full object-cover" src="{{'https://ui-avatars.com/api/?name=' . urlencode(session('user.firstname') .' '.session('user.lastname')) . '&size=150'}}" alt="user photo">
                @else
                <img class="w-8 h-8 rounded-full object-cover" src="{{session('user.img')}}" alt="user photo">
                @endif
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none  divide-y  rounded-lg shadow bg-gray-700 divide-gray-600" id="user-dropdown">
            <a href="{{"/profile"}}">
                <div class="px-4 py-3 hover:bg-gray-700">
                    <span class="block text-sm  text-white">{{ session('user.firstname'). ' ' . session('user.lastname')}}</span>
                    <span class="block text-sm  truncate text-gray-400">{{ session('user.email') }}</span>
                </div>
            </a>    
            @if(auth()->check() && auth()->user()->admin_access)
            <ul class="py-2" aria-labelledby="user-menu-button">
                <li>
                    <strong class="block px-4 py-2 text-sm text-green-500">Admin - Maintenance</strong>
                </li>
                <li>
                    <a href="/admin/furparents" class="block px-4 py-2 text-sm  hover:bg-green-600 text-green-200 hover:text-white">Furparents</a>
                </li>
                <li>
                    <a href="/admin/furbabies" class="block px-4 py-2 text-sm  hover:bg-green-600 text-green-200 hover:text-white">Furbabies</a>
                </li>
            </ul>
            @endif
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="/logout" class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>