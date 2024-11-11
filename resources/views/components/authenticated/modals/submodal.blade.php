@php

$_id = session('user.furparentID');
$_firstname = session('user.firstname');
$_lastname = session('user.lastname');
$_email = session('user.email');
$_mobile_number = session('user.mobile_number');
$_city = session('user.city');
$_province = session('user.province');
$_password = '********';
$_confirm_password = '********';

@endphp

<!-- Modals for Adding New Furbaby -->
<div id="furbabyModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto bg-black bg-opacity-50 flex justify-center items-center">
    <div class="relative w-full max-w-md mx-auto  rounded-lg shadow-md bg-gray-800">
        <div class="bg-gradient-to-r    from-gray-700 via-gray-800 to-gray-900 rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4  bg-blue-700 rounded-t-lg">
                <h3 class="text-lg font-semibold text-white">
                    Add New Furbaby
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-blue-500 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="furbabyModal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body with Form -->
            <div class="p-6 space-y-4">
                <form id="form_submit_newPet" class="max-w-md mx-auto" action="{{route('furbaby.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Furbaby Name -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="furbaby_name" id="furbaby_name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="furbaby_name" class="absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Furbaby Name</label>
                    </div>

                    <!-- Furbaby Age -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number" name="furbaby_age" id="furbaby_age" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " min="0" required />
                        <label for="furbaby_age" class="absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Furbaby Age</label>
                    </div>

                    <!-- Furbaby Description -->
                    <div class="relative z-0 w-full mb-5 group">
                        <textarea name="furbaby_description" id="furbaby_description" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required></textarea>
                        <label for="furbaby_description" class="absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">General Description</label>
                    </div>

                    <!-- Profile Picture -->
                    <div class="pt-4 relative z-0 w-full mb-5 group">
                        <input type="file" name="furbaby_profile_pic" id="furbaby_profile_pic" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                        <label for="furbaby_profile_pic" class="absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Profile Picture</label>
                    </div>

                    <!-- Submit Button -->
                    <button id="btn_submit_newPet" type="submit" class="text-white   focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" onclick="document.getElementById('btn_submit_newPet').disabled=true; document.getElementById('form_submit_newPet').submit();">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Profile -->
<div id="editProfileModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto bg-black bg-opacity-50 flex justify-center items-center">
    <div class="relative w-full max-w-md mx-auto  rounded-lg shadow-md bg-gray-800">
        <div class="bg-gradient-to-r    from-gray-700 via-gray-800 to-gray-900 rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4  bg-blue-700 rounded-t-lg">
                <h3 class="text-lg font-semibold text-white">
                    Edit Profile
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-blue-500 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="editProfileModal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body with Form -->
            <div class="p-6 space-y-4">
                <form id="edit_profile_form" class="max-w-md mx-auto" action={{ route('profile.update') }} method="POST">
                    @csrf
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="firstname" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ $_firstname }}" required />
                            <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="lastname" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ $_lastname }}" required />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ $_email }}" required />
                        <label for="floating_email" class="peer-focus:font-medium absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="tel" name="mobile_number" id="floating_phone" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ $_mobile_number }}" required />
                        <label for="floating_phone" class="peer-focus:font-medium absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number </label>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ $_password }}" required />
                            <label for="floating_password" class="peer-focus:font-medium absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                        </div>                        
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="password_confirmation" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ $_confirm_password }}" required />
                            <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
                        </div>
                    </div>
                    <div id="passwordConfirmationError" class="hidden items-center p-4 mt-4 mb-4 text-sm  rounded-lg  bg-gray-800 text-red-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div>
                            <span class="font-medium">Passwords do not match.</span>
                        </div>
                    </div>
                    <button type="submit" class="text-white   focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Submit</button>
                </form>
                {{-- Validate the password fields in the profile edit form --}}
                <script>
                    document.getElementById('edit_profile_form').addEventListener('submit', function(event) {
                        event.preventDefault();
                        
                        let isValid = true;
                    
                        // Validate password
                        const password = document.getElementById('floating_password').value;
                        const passwordConfirmation = document.getElementById('floating_repeat_password').value;
                        if (password !== passwordConfirmation) {
                            document.getElementById('passwordConfirmationError').classList.remove('hidden');
                            document.getElementById('passwordConfirmationError').classList.add('flex');
                            isValid = false;
                        }
                    
                        // If valid, submit the form
                        if (isValid) {
                            this.submit();
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Large Modal for Furbaby Profile -->
<div id="bigModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto">
    <div class="relative w-full max-w-7xl mx-auto h-full">
        <div class="relative bg-gray-800 rounded-lg shadow-lg flex flex-col md:flex-row h-full overflow-hidden">
            <button type="button" class="absolute top-4 right-3 text-gray-400 hover:text-white" data-modal-hide="bigModal">
                <svg aria-hidden="true" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="w-full md:w-[30%] bg-gray-700 p-8 flex flex-col items-center justify-start relative">
                <div class="absolute top-4 left-3 flex justify-start">
                    <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownMenu" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-transparent rounded-lg hover:text-white focus:outline-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1.707 2.707 5.586 5.586a1 1 0 0 0 1.414 0l5.586-5.586A1 1 0 0 0 13.586 1H2.414a1 1 0 0 0-.707 1.707Z"/>
                        </svg>
                    </button>
                    <div id="dropdownMenu" class="z-10 hidden  divide-y  rounded-lg shadow w-44 bg-black divide-gray-600">
                        <ul class="py-2 text-sm  text-gray-200" aria-labelledby="dropdownMenuIconButton">  
                            <li><label class="block px-4 py-2  hover:bg-gray-600 hover:text-white" for="upload-media-image">Add Image</label>
                                
                    <!-- Image Input -->
                    <input type="file" id="upload-media-image" class="hidden" accept="image/*" />
                    {{-- Uploads a media file (image) for a selected "furbaby" --}}
                    <script>

                        var mediaInput = document.getElementById('upload-media-image');

                        // Attach a change event listener to the input
                        mediaInput.addEventListener('change', function() {
                            // Create a FormData object
                            var formData = new FormData();
                            formData.append('image', mediaInput.files[0]);
                            formData.append('furbabyID', window._.furbabyModal.id);

                            // Get CSRF token from meta tag
                            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            // Use fetch to send the file upload request
                            fetch('{{ route('media.upload') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken // Set the CSRF token in the headers
                                },
                                body: formData // Send the form data
                            })
                            // Parse the response JSO
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json(); N
                            })
                            // Updating the Media View
                            .then(data => {
                                window._.furbabyModal.showMedias();
                            })
                            // Error Handling
                            .catch(error => {
                                console.log('Error:', error);
                            });
                        });
                    </script></li>
                            <li><a id="petprofile_ismissing" href="#" class="block px-4 py-2  hover:bg-gray-600 hover:text-white" onclick="event.preventDefault(); window._.furbabyModal.tagMissingOrFound();">Tag as Missing</a></li>
                            <li><a href="#" class="block px-4 py-2  hover:bg-gray-600 hover:text-white" onclick="event.preventDefault(); window._.furbabyModal.tagDelete();">Delete</a></li>
                        </ul>
                    </div>
                    {{-- options within a dropdown list --}}
                </div>
                {{-- Furbabies Profile --}}
                <div class="relative group w-40 h-40 bg-gray-500 rounded-full flex items-center justify-center mb-4 mt-8">
                    <label for="upload-image-furbaby">
                        <img id="petprofile_img" src="/img/pet.png" alt="Profile Picture" class="w-40 h-40 rounded-full object-cover hover:opacity-90">
                        <!-- Edit Icon (Visible on hover) -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>                   
                    </label>
                    <!-- Image Input -->
                    <input type="file" id="upload-image-furbaby" class="hidden" accept="image/*" />
                    {{-- Upload Image --}}
                    <script>
                        var imageInputPet = document.getElementById('upload-image-furbaby');

                        // Attach a change event listener to the input
                        imageInputPet.addEventListener('change', function() {
                            // Create a FormData object
                            
                            document.getElementById('loadingModal').classList.remove('hidden');
                            var formData = new FormData();
                            formData.append('img', imageInputPet.files[0]); 
                            formData.append('id', window._.furbabyModal.id); 

                            // Get CSRF token from meta tag
                            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            var t = sessionStorage.getItem('t');
                            // Use fetch to send the file upload request
                            fetch('{{ route('image.upload.pet') }}', {
                                method: 'POST',
                                headers: {
                                    'Authorization': 'Bearer ' + t,
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
                                const srcImg = document.getElementById('petprofile_img').src;
                                const url = new URL(srcImg);

                                const imgs = document.querySelectorAll(`img[src="${url.pathname}"]`);

                                if(imgs) {
                                    if (imgs.length === 1) {
                                        imgs[0].src = data.image_url; // Directly update the single image
                                    }
                                    if (imgs.length > 1) {
                                        imgs.forEach(img => {
                                            img.src = data.image_url;
                                        });
                                    }
                                }
                                // Optionally, update the src of the original image
                                document.getElementById('petprofile_img').src = data.image_url;
                                document.getElementById('loadingModal').classList.add('hidden');
                            })
                            .catch(error => {
                                console.log('Error:', error);
                            });
                        });
                    </script>
                </div>
                <p id="petprofile_name" class="text-white text-lg font-bold mb-2">Name</p>
                <p id="petprofile_age" class="text-gray-300 text-sm mb-2">Age:</p>
                <div class="flex justify-center">
                    <p id="petprofile_description" class="text-gray-300 text-sm mb-4">
                        Description
                    </p>
                </div>
                
                <div id="ismissing_notif" class="hidden mb-4 text-center justify-center bottom-4 right-4 bg-red-800 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-lg">
                    <strong>Missing</strong> <br/> <p>I am lost, please help me find my home!</p>
                </div>
                <div class="w-48 h-48 bg-white flex items-center justify-center">
                    <img id="petprofile_qr" src="/img/qr.png" alt="QR Code" class="w-full h-full object-contain">
                </div>
            </div>
            <div class="w-full md:w-[70%] bg-black p-16 overflow-auto no-scrollbar">
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-1" id="furbaby_media_section">
                    <div class="relative group">
                        <img class="w-full aspect-square object-cover" src="/img/pet 2.png" alt="Image 1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Search Modal --}}
<div id="searchModal" aria-hidden="true" class="hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]" onclick="this.classList.add('hidden')" >
    <div class="w-full max-w-lg bg-gray-800 shadow-lg rounded-3xl px-8 py-6 relative" onclick="event.stopPropagation()">
        <div class="flex items-start">
            <div class="flex-1">
                <h3 class="text-white text-2xl font-bold">Furparents</h3>
            </div>
            <button data-modal-hide="searchModal">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500" viewBox="0 0 320.591 320.591">
                    <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z" data-original="#000000"></path>
                    <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z" data-original="#000000"></path>
                </svg>
            </button>
        </div>

        <div class="flex flex-wrap gap-4 mt-6">
            <div class="flex flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-gray-400 mr-4">
                    <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                    </path>
                </svg>
                <input type="text" id="searchText" placeholder="Search name" class="w-full outline-none bg-transparent text-gray-500 text-sm">
            </div>
        
            <button type="button" class="px-5 py-2.5 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700" onclick="window._.searchbox.findFurparent()">Search</button>
        </div>
        

        <div id="searchbox-display" class="mt-6 divide-y">
            
        </div>
    </div>
</div>