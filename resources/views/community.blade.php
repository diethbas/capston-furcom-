@extends('layouts.authenticated.main')

@section('content')
{{-- {{dd(session()->all())}} --}}
<script>
    function setMessageToId(id, firstname, lastname, img){
        var dataEvent = new CustomEvent('threadShow', {});
        document.getElementById('sendMessage-ToName').innerHTML = firstname + ' ' + lastname;
        document.getElementById('messageModal').dataset.idTo = id;
        document.getElementById('messageModal').dispatchEvent(dataEvent);
    }
    
</script>
<!-- Main Grid Content -->
<section class="flex-grow h-full bg-gray-900 overflow-auto">
    <div class="h-full">
        <!-- Image Cards Grid -->
        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-6 gap-0.5">
            @foreach ($furparents as $item)
                <!-- Single Image Card -->
                <div class="relative group" data-modal-target="messageModal" data-modal-toggle="messageModal" onClick="setMessageToId('{{$item['id']}}', '{{$item['firstname']}}', '{{$item['lastname']}}', '{{$item['img']}}')">
                    @if($item['img'] == null || $item['img'] == '' || $item['img'] == '/')
                    <img class="w-full h-full object-cover" src="{{'https://ui-avatars.com/api/?name=' . urlencode($item['firstname'].' '.$item['lastname']) . '&size=150'}}" alt="Media Image 1">
                    @else
                    <img class="w-full h-full object-cover" src="{{$item['img']}}" alt="Media Image 1">
                    @endif
                    <!-- Name Label with Green Circle -->
                    <div class="absolute top-2 left-2 flex items-center space-x-1">
                        <!-- Green Circle -->
                        <div class="w-2.5 h-2.5 bg-green-500 rounded-full"></div>
                        <!-- Name Label -->
                        <span class="text-white text-s font-semibold">{{$item['firstname']}}</span>
                    </div>

                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300"></div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection