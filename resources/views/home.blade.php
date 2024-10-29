@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-tr from-gray-900 via-gray-900 to-purple-900">
        <div class="container px-6 py-16 mx-auto text-center">
            <div class="max-w-lg mx-auto">
                <h1 class="text-3xl font-semibold text-gray-800 dark:text-white lg:text-4xl">Build Stronger Bonds with Furparent Using Our Pawsome Community</h1>
                <p class="mt-6 text-gray-500 dark:text-gray-300">Join a community where pet parents connect, share, and support each other in their journey of pet parenting.</p><br>
                <a href="{{url('signup')}}" class="px-5 py-2 mt-6 text-sm font-medium leading-5 text-center text-white capitalize bg-blue-600 rounded-lg hover:bg-blue-500 lg:mx-0 lg:w-auto focus:outline-none">Register Your Furbabies Now</a>
                <p class="mt-3 text-sm text-gray-400">No payments required</p>
            </div>
            <div class="flex justify-center mt-10">
                <img class="object-cover w-full h-96 rounded-xl lg:w-4/5" src="/img/hero.png" alt="Hero Image" />
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="pb-12 dark:bg-gray-800">
        <div class="container px-4 py-8 mx-auto">
            <div class="mt-4 md:flex md:items-center md:justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-gray-800 capitalize lg:text-2xl dark:text-white">What Furparents are saying</h1>
                    <div class="flex mx-auto mt-4">
                        <span class="inline-block w-28 h-1 bg-blue-500 rounded-full"></span>
                        <span class="inline-block w-2 h-1 mx-1 bg-blue-500 rounded-full"></span>
                        <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
                    </div>
                </div>
            </div>

            <section class="grid grid-cols-1 gap-6 mt-6 xl:mt-10 lg:grid-cols-2 xl:grid-cols-3">
                <div class="p-6 border rounded-lg dark:border-gray-700">
                    <p class="leading-loose text-sm text-gray-500 dark:text-gray-400">“Natulungan talga ako ng Furcom, nung gumawa ako ng sariling profile para sa aking furbaby naging masaya ako na makilala ang iba pang mga pet owners at makipagpalitan ng mga stories about sa aming buhay.”</p>
                    <div class="flex items-center mt-6 -mx-2">
                        <img class="object-cover mx-2 rounded-full w-10 shrink-0 h-10 ring-4 ring-gray-300 dark:ring-gray-700" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&auto=format&fit=crop&w=880&q=80" alt="Testimonial 1" />
                        <div class="mx-2">
                            <h1 class="text-sm font-semibold text-gray-800 dark:text-white">Robert</h1>
                            <span class="text-xs text-gray-500 dark:text-gray-400">PhirstPark Tanza Homeowner</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-blue-500 border border-transparent rounded-lg dark:bg-blue-600">
                    <p class="leading-loose text-sm text-white">“Naging maginhawa ang pagkakaroon ng profile para sa aking pusa sa website na ito. Madali akong nakakahanap ng mga friends at nasisiyahan akong ibahagi ang kanyang mga kwento at karanasan sa komunidad ng mga pet lovers.”</p>
                    <div class="flex items-center mt-6 -mx-2">
                        <img class="object-cover mx-2 rounded-full w-10 shrink-0 h-10 ring-4 ring-blue-200" src="https://images.unsplash.com/photo-1531590878845-12627191e687?ixlib=rb-1.2.1&auto=format&fit=crop&w=764&q=80" alt="Testimonial 2" />
                        <div class="mx-2">
                            <h1 class="text-sm font-semibold text-white">Lovella</h1>
                            <span class="text-xs text-blue-200">Student</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 border rounded-lg dark:border-gray-700">
                    <p class="leading-loose text-sm text-gray-500 dark:text-gray-400">“Ang profile para sa aking furbaby sa website ay talagang enjoy. Nagbibigay ito ng pagkakataon na ipakita ang kanyang personalidad at kumonekta sa iba pang mga pet owners na may katulad na hilig at interes.”</p>
                    <div class="flex items-center mt-6 -mx-2">
                        <img class="object-cover mx-2 rounded-full w-10 shrink-0 h-10 ring-4 ring-gray-300 dark:ring-gray-700" src="https://images.unsplash.com/photo-1488508872907-592763824245?ixlib=rb-1.2.1&auto=format&fit=crop&w=1470&q=80" alt="Testimonial 3" />
                        <div class="mx-2">
                            <h1 class="text-sm font-semibold text-gray-800 dark:text-white">Neil</h1>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Vendor</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <!-- Website Features Section -->
    <section class="py-8 bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">explore <br> what we can <span class="text-blue-500">Offer</span></h1>
            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
                <div class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </span>
                    <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Furparents Profile</h1>
                    <p class="text-gray-500 dark:text-gray-300">Furparents can create personalized profiles for their pets, providing detailed information to connect with other pet lovers and enhance their experience.</p>
                </div>
                <div class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h4v4H4V4zm0 8h4v4H4v-4zm8-8h4v4h-4V4zm0 8h4v2h-2v2h-2v-4zm6-6h2v2h-2V6zM6 6h2v2H6V6zm12 12v2h-2v-2h-2v-2h2v-2h2v2h2v2h-2zm-6 0h2v2h-2v-2zm2-8h2v2h-2v-2z" />
                        </svg>
                    </span>
                    <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">QR Codes</h1>
                    <p class="text-gray-500 dark:text-gray-300">The website offers a feature to generate unique QR codes for pets, allowing easy access to essential pet information when scanned by others.</p>
                </div>
                <div class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </span>
                    <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Connect</h1>
                    <p class="text-gray-500 dark:text-gray-300">Users can create detailed profiles for their furbabies, showcasing important information and connecting with other pet enthusiasts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Script to trigger modal based on URL -->
    <!-- Modal Structure for Furbabies Tab -->
    @if(request()->has('qrProfile'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize the modal (if using a specific library like Flowbite)
                const modal = new Modal(document.getElementById('bigModal'));
                const modal2 = new Modal(document.getElementById('messageModal'));
                modal.show();
            });
        </script>
    @endif
    <div id="bigModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto bg-black bg-opacity-50">
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

                    <!-- Message Furparent Icon Button -->
                    <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-transparent rounded-lg hover:text-white focus:outline-none" data-modal-toggle="messageModal">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h9M5 9h5m8-8H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4l3.5 4 3.5-4h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                        </svg>
                        <span class="ml-2 text-gray-300">Message Furparent</span>
                    </button>
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

    <!-- Modal for Sending Messages -->
    <div id="messageModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto bg-black bg-opacity-50 flex justify-center items-center">
        <div class="relative w-full max-w-md mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">

            <!-- Modal Content -->
            <div class="bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300 dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-lg shadow-lg">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 bg-blue-600 dark:bg-blue-700 rounded-t-lg">
                    <h3 class="text-lg font-semibold text-white">
                        Message Furparent
                    </h3>
                    <!-- Close Button for Message Modal -->
                    <button type="button" class="text-white bg-transparent hover:bg-blue-500 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="messageModal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body with Form -->
                <div class="p-6 space-y-4">
                    <!-- Form with Floating Labels -->
                    <form class="max-w-md mx-auto">
                        <!-- Contact Information -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="floating_contact" id="floating_contact" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_contact" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your Contact Information (Phone or Email)</label>
                        </div>

                        <!-- Subject -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="floating_subject" id="floating_subject" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_subject" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Subject</label>
                        </div>

                        <!-- Message -->
                        <div class="relative z-0 w-full mb-5 group">
                            <textarea name="floating_message" id="floating_message" rows="4" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required></textarea>
                            <label for="floating_message" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Message</label>
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection