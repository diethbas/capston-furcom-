@extends('layouts.authenticated.main')

@section('content')
<script>
    
</script>
<!-- Main Grid Content -->
<section class="flex-grow h-full bg-gray-900 overflow-auto">
    <div class="h-full">
        <!-- Image Cards Grid -->
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-0.5">
            @foreach ($furparents as $item)
                <!-- Single Image Card -->
                <div class="relative group w-100  h-100" >
                    {{-- Dynamic User Image with Avatar Fallback - --}}
                    @if($item['img'] == null || $item['img'] == '' || $item['img'] == '/')
                    <img class="w-full h-full object-cover" src="{{'https://ui-avatars.com/api/?name=' . urlencode($item['firstname'].' '.$item['lastname']) . '&size=150'}}" alt="Media Image 1">
                    @else
                    <img class="w-full h-full object-cover" src="{{$item['img']}}" alt="Media Image 1">
                    @endif

                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-70 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                        <!-- Centered Icons -->
                        <div class="flex space-x-1">
                            <button class="group" data-modal-target="messageModal" data-modal-toggle="messageModal" onClick="window._.mbox.setMessageToId('{{$item['id']}}', '{{$item['firstname']}}', '{{$item['lastname']}}', '{{$item['img']}}')">
                                <!-- First Icon -->
                                <svg class="group-hover:text-gray-500 transition-colors duration-200 group-hover:fill-current" width="35" height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 9H12M15 9H17M7 12H9M12 12H17M5 5H19C19.5523 5 20 5.44772 20 6V15C20 15.5523 19.5523 16 19 16H12.3837C12.1367 16 11.8984 16.0914 11.7148 16.2567L8.83448 18.849C8.51272 19.1386 8 18.9102 8 18.4773V17C8 16.4477 7.55228 16 7 16H5C4.44772 16 4 15.5523 4 15V6C4 5.44771 4.44772 5 5 5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            
                            <a href="/profile/{{$item['id']}}" class="group">
                                <!-- Second Icon -->
                                <svg class="group-hover:text-gray-500 transition-colors duration-200 group-hover:fill-current" width="35" height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 17V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V17C17 15.3431 15.6569 14 14 14H10C8.34315 14 7 15.3431 7 17Z" stroke="white" stroke-width="2"/>
                                    <path d="M15 8C15 9.65685 13.6569 11 12 11C10.3431 11 9 9.65685 9 8C9 6.34315 10.3431 5 12 5C13.6569 5 15 6.34315 15 8Z" stroke="white" stroke-width="2"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- Name Label  -->                   
                    <div class="absolute top-2 left-2 flex items-center space-x-1">
                        <!-- Green circle -->
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>                        
                        <span class="text-xs md:text-base lg:text-lg text-gray-100 font-semibold">{{$item['firstname']}}</span>
                    </div>                        
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection