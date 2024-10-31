<!-- Reply Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var btn = document.getElementById('sendMessage-btn');
        var modal = document.getElementById('messageModal');
        async function getThread(){
            var t = sessionStorage.getItem('t');
            var to = document.getElementById('messageModal').dataset.idTo;
            var content = document.getElementById('sendMessage-content').value;
            await fetch('/api/messages/thread/'+ to + '/find', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + t,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.thread.threadID){
                    document.getElementById('messageModal').dataset.threadID = data.thread.threadID;
                }
                else {
                    document.getElementById('messageModal').dataset.threadID = data.thread.id;
                }
            })
            .catch(error => {});
        }
        async function getMessages(){
            var t = sessionStorage.getItem('t');
            var threadID = document.getElementById('messageModal').dataset.threadID;
            var content = document.getElementById('sendMessage-content').value;

            const response = await fetch('/api/messages/get/'+ threadID, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + t,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            const data = await response.json();
            const messageBodyView = document.getElementById('sendMessage-bodyview');
            
            messageBodyView.innerHTML = "";
            for (const msgObj of data.messages) {
                // Generate the message template with actual content
                var furparent = await getFurparent(msgObj.senderID);

                // Use timeAgo function to get "1 minute ago" format
                const timeAgoString = timeAgo(msgObj.created_at);
                const messageHTML = getMessageTemplate(furparent.img, msgObj.message, furparent.firstname, timeAgoString);

                // Append the generated HTML as a new message
                messageBodyView.innerHTML += messageHTML;
            }
        }
        
        function timeAgo(date) {
            const messageDate = new Date(Date.parse(date));
            const now = new Date();
            const diffInSeconds = Math.floor((now - messageDate) / 1000);

            let interval = Math.floor(diffInSeconds / 31536000); // Years
            if (interval >= 1) return interval === 1 ? '1 year ago' : `${interval} years ago`;

            interval = Math.floor(diffInSeconds / 2592000); // Months
            if (interval >= 1) return interval === 1 ? '1 month ago' : `${interval} months ago`;

            interval = Math.floor(diffInSeconds / 86400); // Days
            if (interval >= 1) return interval === 1 ? '1 day ago' : `${interval} days ago`;

            interval = Math.floor(diffInSeconds / 3600); // Hours
            if (interval >= 1) return interval === 1 ? '1 hour ago' : `${interval} hours ago`;

            interval = Math.floor(diffInSeconds / 60); // Minutes
            if (interval >= 1) return interval === 1 ? '1 minute ago' : `${interval} minutes ago`;

            return diffInSeconds <= 1 ? 'just now' : `${diffInSeconds} seconds ago`;
        }
        async function getFurparent(id){
            var t = sessionStorage.getItem('t');
            var returnValue = null;
            await fetch('/api/furparent/get/' + id, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + t,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                returnValue = data.furparent;
            })
            .catch(error => {});

            return returnValue;
        }
        modal.addEventListener('threadShow', async function(e){
            await getThread();
            await getMessages();
        });


        function getMessageTemplate(img, message, fullname, timestamp) {
            const encodefullname = encodeURI(fullname);
            if (img == null || img == '' || img == '/'){
                img = 'https://ui-avatars.com/api/?name=' + encodefullname + '&size=150';
            }
            return `
                <div class="flex items-start mb-4">
                    <img class="w-8 h-8 rounded-full object-cover mr-3" src="${img}" alt="John Doe">
                    <div>
                        <p class="text-sm text-gray-300"><strong class="text-gray-800 dark:text-white">${fullname}:</strong> ${message}</p>
                        <span class="text-xs text-gray-500 dark:text-gray-400">${timestamp}</span>
                    </div>
                </div>
            `;
        }
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            var t = sessionStorage.getItem('t');
            var to = document.getElementById('messageModal').dataset.idTo;
            var content = document.getElementById('sendMessage-content').value;
            
            fetch('/api/messages/send', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + t,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    sendTo: to,
                    message: content
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('sendMessage-content').value = '';
                getMessages();
            })
            .catch(error => {});
        });
    });
</script>

<div id="messageModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center md:justify-end md:items-end bg-black bg-opacity-50">
    <div class="relative w-full md:max-w-xs  bg-opacity-90 rounded-lg shadow bg-gray-800 md:mr-10 md:mb-10 h-96 flex flex-col">
        <div class="p-4 border-b border-gray-600">
            <h3 class="text-lg font-semibold  text-white">Message to <span id="sendMessage-ToName">#test</span></h3>
            <button type="button" class="absolute top-3 right-3 text-gray-400  bg-transparent  hover:bg-gray-600 hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="messageModal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Scrollable Messages Section -->
        <div id="sendMessage-bodyview" class="p-4 overflow-y-auto flex-grow">
        </div>

        <!-- Reply Input -->
        <div class="p-4 border-t dark:border-gray-600">
            <div class="relative">
                <input id="sendMessage-content" type="text" class="block w-full py-2 px-4   rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-gray-700 text-white placeholder-gray-400" placeholder="Type your message...">
                <button id="sendMessage-btn" class="absolute right-3 top-2.5 text-blue-500 hover:text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="CurrentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>