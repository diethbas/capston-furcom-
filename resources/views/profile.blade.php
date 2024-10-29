@extends('layouts.authenticated.main')
@section('content')
    <!-- Profile Section -->
    <section class="flex-grow py-8">
        @if(session()->has('success'))
        @include('components.authenticated.success')
        @endif
        <div class="flex justify-center items-center">
            <div class="bg-gray-800 p-6 rounded-lg max-w-screen-lg flex flex-col md:flex-row items-center md:items-center space-y-6 md:space-y-0 md:space-x-6 shadow-lg">
                <!-- Profile Picture Section -->
                <div class="relative group w-40 h-40">
                    <label for="upload-image">
                        <!-- Profile Picture -->
                        @if(session('user.img') == null || session('user.img') == '' || session('user.img') == '/')
                        <img id="profile-uploaded-image" class="w-40 h-40 rounded-full object-cover border-4 border-gray-600 cursor-pointer hover:opacity-90 transition duration-200"  src="{{'https://ui-avatars.com/api/?name=' . urlencode(session('user.firstname') .' '.session('user.lastname')) . '&size=150'}}" alt="Profile Picture">
                        @else
                        <img id="profile-uploaded-image" class="w-40 h-40 rounded-full object-cover border-4 border-gray-600 cursor-pointer hover:opacity-90 transition duration-200" id="profile-uploaded-image" class="w-40 h-40 rounded-full object-cover border-4 border-gray-600 cursor-pointer hover:opacity-90 transition duration-200" src="{{session('user.img')}}" alt="Profile Picture">
                        @endif
                        <!-- Edit Icon (Visible on hover) -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </label>
                    <!-- Image Input -->
                    <input type="file" id="upload-image" class="hidden" accept="image/*" />

                    <script>
                        var imageInput = document.getElementById('upload-image');

                        // Attach a change event listener to the input
                        imageInput.addEventListener('change', function() {
                            // Create a FormData object
                            var formData = new FormData();
                            formData.append('image', imageInput.files[0]); // Get the selected file

                            // Get CSRF token from meta tag
                            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            // Use fetch to send the file upload request
                            fetch('{{ route('image.upload') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken // Set the CSRF token in the headers
                                },
                                body: formData // Send the form data
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json(); // Parse the response JSON
                            })
                            .then(data => {
                                window.location.reload();
                            })
                            .catch(error => {
                                console.log('Error:', error);
                            });
                        });
                    </script>
                </div>
                
                <!-- Name and Email Section -->
                <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-2">
                    <h2 class="text-white text-4xl font-bold">{{ $firstname }} {{ $lastname }}</h2>
                    <p class="text-gray-400 text-lg">{{ $email }}</p>
                </div>

                <!-- Buttons Section -->
                <div class="flex space-x-3 mt-4 md:mt-0 md:ml-auto">
                    <button data-modal-target="furbabyModal" data-modal-toggle="furbabyModal" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none rounded-md shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Furbaby
                    </button>

                    <button data-modal-target="editProfileModal" data-modal-toggle="editProfileModal" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none rounded-md shadow-md">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab Content -->
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

        <div id="myTabContent" class="max-w-screen-lg mx-auto">
            <!-- Furbabies Content -->
            <div class="p-4" id="furbabies" role="tabpanel" aria-labelledby="furbabies-tab">
                <section class="py-8">
                    <div class="max-w-screen-lg mx-auto px-4">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="relative group">
                                <img class="w-full aspect-square object-cover" src="/img/pet.png" alt="Furbaby Image 1">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                                    <button data-modal-target="bigModal" data-modal-toggle="bigModal" class="text-white font-semibold cursor-pointer">Name</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <!-- Media Content -->
            <div class="hidden p-4" id="media" role="tabpanel" aria-labelledby="media-tab">
                <section class="py-8"> <!-- Add bg-opacity class here -->
                    <div class="max-w-screen-lg mx-auto px-4">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="relative group">
                                <img class="w-full aspect-square object-cover" src="/img/pet 2.png" alt="Media Image 1">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="relative group">
                                <img class="w-full aspect-square object-cover" src="/img/pet.png" alt="Media Image 2">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Troop Content -->
            <div class="hidden p-4" id="pack" role="tabpanel" aria-labelledby="pack-tab">
                <section class="py-8"> <!-- Add bg-opacity class here -->
                    <div class="max-w-screen-lg mx-auto px-4">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="relative group">
                                <img class="w-full aspect-square object-cover" src="/img/user2.png" alt="Pack Image 1">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection