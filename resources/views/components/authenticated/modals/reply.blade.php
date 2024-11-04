<!-- Reply Modal -->
<div id="replyModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center md:justify-end md:items-end bg-black bg-opacity-50">
    <div class="relative w-full md:max-w-xs  bg-opacity-90 rounded-lg shadow bg-gray-800 md:mr-10 md:mb-10 h-96 flex flex-col">
        <div class="p-4 border-b border-gray-600">
            <h3 class="text-lg font-semibold  text-white">Reply to Message</h3>
            <button type="button" class="absolute top-3 right-3 text-gray-400  bg-transparent  hover:bg-gray-600 hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="replyModal">
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
                    <p class="text-sm  text-gray-300"><strong class="text-white">Diether:</strong> Hello! How are you?</p>
                    <span class="text-xs  text-gray-400">5 minutes ago</span>
                </div>
            </div>
        </div>

        <!-- Reply Input -->
        <div class="p-4 border-t border-gray-600">
            <div class="relative">
                <input type="text" class="block w-full py-2 px-4   rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-gray-700 text-white " placeholder="Type your message...">
                <button class="absolute right-3 top-2.5 text-blue-500 hover:text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="CurrentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>