{{-- Audio Elements for Sounds --}}
<audio id="notificationSound" src="/sounds/messageBubble.mp3" preload="auto" allow="autoplay"></audio>
<audio id="onclick" src="/sounds/click.mp3" preload="auto" allow="autoplay"></audio>
<script>
    //Global Object Initialization
    window._ = window._ || {};
    //  Main Messaging Object
    window._.mbox = {
        // Holds info for "me" and "to" (the other user)
        me: {
            id: null,
            furparent: {
                firstname: null,
                lastname: null,
                img: null,
            }
        },
        to: {
            id: null,
            furparent: {
                firstname: null,
                lastname: null,
                img: null,
            }
        },

        // Future Placeholders
        showBubbleMsg: function() {
            // Function implementation goes here
        },
        showThreadMessage: function() {
            // Function implementation goes here
        },
        showThreadMessage: function() {
            // Function implementation goes here
        },

        // Plays a notification sound
        notifSound: function (name = 'notificationSound') {
            var promise = document.getElementById(name).play();

            if (promise !== undefined) {
            promise.then(_ => {
                console.error("Notify");
            }).catch(error => {
                console.error("Error playing sound:", error);
            });
            }
        },

        // Message Organization
        messageOrganize: function(classDiv) {
            const divs = document.querySelectorAll('.'+classDiv);
            console.log(divs);
            let inConsecutiveSequence = false;

            for (let i = 0; i < divs.length; i++) {
                const currentDiv = divs[i];
                const nextSibling = currentDiv.nextElementSibling;

                if (nextSibling && nextSibling.classList.contains(classDiv)) {
                    inConsecutiveSequence = true;
                    currentDiv.classList.add('hide-details');
                } else {
                    inConsecutiveSequence = false;
                }
            }
        },

        // Sets message recipient information and triggers the modal
        setMessageToId: function (id, firstname, lastname, img){
            var dataEvent = new CustomEvent('threadShow', {});
            document.getElementById('sendMessage-ToName').innerHTML = firstname + ' ' + lastname;

            if (id !== document.getElementById('messageModal').dataset.idTo) {
                const messageBodyView = document.getElementById('sendMessage-bodyview');
                messageBodyView.innerHTML = '';
            }
            document.getElementById('messageModal').dataset.idTo = id;
            document.getElementById('messageModal').dispatchEvent(dataEvent);
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        window._.mbox.notifSound('onclick'); //Event Listener on DOM Load
        // Selecting Button and Modal Elements
        var btn = document.getElementById('sendMessage-btn');
        var modal = document.getElementById('messageModal');
        // Fetches and displays message thread data based on the recipient ID.
        async function getThread(){
            var t = sessionStorage.getItem('t');
            var to = document.getElementById('messageModal').dataset.idTo;
            var content = document.getElementById('sendMessage-content').value;
            // Fetching the Thread Data
            await fetch('/api/messages/thread/'+ to + '/find', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + t,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window._.csrf
                }
            })
            // Processing the Response
            .then(response => response.json())
            .then(async data => {
                if (data.thread.threadID){
                    document.getElementById('messageModal').dataset.threadID = data.thread.threadID;
                }
                else {
                    document.getElementById('messageModal').dataset.threadID = data.thread.id;
                }
                // Determines which user in the thread
                if (data.thread.recipientID1 == window.Laravel.userId) {
                    window._.mbox.me.id = data.thread.recipientID1;
                    window._.mbox.to.id = data.thread.recipientID2;
                }
                else {
                    window._.mbox.me.id = data.thread.recipientID2;
                    window._.mbox.to.id = data.thread.recipientID1;
                }
                // Fetching User Information with getFurparent
                var me = await getFurparent(window._.mbox.me.id);
                var to = await getFurparent(window._.mbox.to.id);
                window._.mbox.me.furparent.firstname = me.firstname;
                window._.mbox.me.furparent.lastname = me.lastname;
                window._.mbox.me.furparent.img = me.img;

                window._.mbox.to.furparent.firstname = to.firstname;
                window._.mbox.to.furparent.lastname = to.lastname;
                window._.mbox.to.furparent.img = to.img;
            })
            //  Error Handling
            .catch(error => {});
        }
        // Retrieves messages for a specific thread and updates the message view in the modal
        async function getMessages(){
            var t = sessionStorage.getItem('t');
            var threadID = document.getElementById('messageModal').dataset.threadID;
            var content = document.getElementById('sendMessage-content').value;

            const response = await fetch('/api/messages/get/'+ threadID, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + t,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window._.csrf
                }
            })
            const data = await response.json();
            const messageBodyView = document.getElementById('sendMessage-bodyview');
            
            messageBodyView.innerHTML = "";
            for (const msgObj of data.messages) {
                // Generate the message template with actual content
                var furparent = msgObj.senderID == window._.mbox.me.id ? window._.mbox.me.furparent : window._.mbox.to.furparent;
                var isMe = msgObj.senderID == window._.mbox.me.id;

                // Use timeAgo function to get "1 minute ago" format
                const timeAgoString = timeAgo(msgObj.created_at);
                const messageHTML = getMessageTemplate(furparent.img, msgObj.message, furparent.firstname, timeAgoString, !isMe);

                // Append the generated HTML as a new message
                messageBodyView.innerHTML = messageHTML + messageBodyView.innerHTML;
                messageBodyView.scrollTop = messageBodyView.scrollHeight;
                window._.mbox.messageOrganize('msg-from-notme');
                window._.mbox.messageOrganize('msg-from-me');
            }
            
        }
        // Formats a timestamp into a relative time string
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
        // Fetches the details of a "furparent" user by ID.
        async function getFurparent(id){
            var t = sessionStorage.getItem('t');
            var returnValue = null;
            await fetch('/api/furparent/get/' + id, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + t,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window._.csrf
                }
            })
            .then(response => response.json())
            .then(data => {
                returnValue = data.furparent;
            })
            .catch(error => {});

            return returnValue;
        }
        // Show a message thread and play a notification sound.
        modal.addEventListener('threadShow', async function(e){
            const loadingMsg = document.getElementById('sendMessage-loadingmsg');
            loadingMsg.classList.remove('hidden');
            await getThread();
            await getMessages();
            loadingMsg.classList.add('hidden');
            window._.mbox.notifSound();
        });
        // Generates HTML for each message
        function getMessageTemplate(img, message, fullname, timestamp, isNotMe = true) {
            const encodefullname = encodeURI(fullname);
            if (img == null || img == '' || img == '/'){
                img = 'https://ui-avatars.com/api/?name=' + encodefullname + '&size=150';
            }
            let msg = '';
            if (isNotMe){
                msg = `
                    <div class="flex flex-col leading-1.5 p-2 border-gray-200 bg-gray-100 rounded-xl rounded-bl-none dark:bg-gray-700 msgbox-message">
                        <p class="text-sm font-normal text-gray-900 dark:text-white">${message}</p>
                    </div>`;
            }
            else {
                msg = `
                    <div class="flex flex-col leading-1.5 p-3 border-blue-200 bg-blue-100 rounded-xl dark:bg-gray-700 msgbox-message">
                        <p class="text-sm font-normal text-gray-900 dark:text-white">${message}</p>
                    </div>`;                
            }

            let from = '' 
            if (isNotMe){
                from = `<span class="text-sm font-semibold text-white">${fullname}</span>`;
            }
            else {
                from = `<span class="text-sm font-semibold text-gray-500">You</span>`;
            }
            return `<div class="flex gap-2.5 items-end ${isNotMe ? 'msg-from-notme' : 'msg-from-me'}">
                <img class="w-8 h-8 rounded-full msgbox-img" src="${img}" alt="${fullname}">
                <div class="flex flex-col gap-1 w-full max-w-[320px]">
                    ${msg}
                    <div class="flex space-x-2 rtl:space-x-reverse msgbox-details ${isNotMe ? 'items-center' : 'justify-end'}">
                        ${from}
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">${timestamp}</span>
                    </div>
                </div>
            </div>
            `;
        }
        // Send a message by pressing the Enter key.
        document.getElementById('sendMessage-content').addEventListener('keydown', function(event) {
            // Check if the Enter key was pressed
            if (event.key === 'Enter') {
                var btn = document.getElementById('sendMessage-btn');
                btn.click();
            }
        });
        // Handles sending a message and updating the UI to show the new message.
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            var t = sessionStorage.getItem('t');
            var to = document.getElementById('messageModal').dataset.idTo;
            var content = document.getElementById('sendMessage-content').value;
            var icon = document.getElementById('msgButton-icon');
            var icon_sending = document.getElementById('msgButton-icon-sending');
            icon.classList.add('hidden');
            icon_sending.classList.remove('hidden');
            if (content !== null && content.trim() !== ""){
                var btn = document.getElementById('sendMessage-btn');
                btn.disabled = true;
                fetch('/api/messages/send', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + t,
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window._.csrf
                    },
                    body: JSON.stringify({
                        sendTo: to,
                        message: content
                    })
                })
                .then(response => response.json())
                .then(data => {
                    window._.mbox.notifSound();
                    var furparent = data.message.senderID == window._.mbox.me.id ? window._.mbox.me.furparent : window._.mbox.to.furparent;
                    const messageBodyView = document.getElementById('sendMessage-bodyview');
                    var isMe = data.message.senderID == window._.mbox.me.id;
                    const timeAgoString = timeAgo(data.message.created_at);
                    const messageHTML = getMessageTemplate(furparent.img, data.message.message, furparent.firstname, timeAgoString, !isMe);

                    // Append the generated HTML as a new message
                    messageBodyView.innerHTML = messageBodyView.innerHTML + messageHTML;
                    messageBodyView.scrollTop = messageBodyView.scrollHeight;
                    window._.mbox.messageOrganize('msg-from-notme');
                    window._.mbox.messageOrganize('msg-from-me');
                    document.getElementById('sendMessage-content').value = null;
                    document.getElementById('sendMessage-btn').disabled = false;
                    icon.classList.remove('hidden');
                    icon_sending.classList.add('hidden');
                })
                .catch(error => { console.log(error)});
            }

            
        });
    });
</script>

<div id="messageModal" tabindex="-1" aria-hidden="true"  class="hidden fixed inset-0 z-50 flex justify-center md:justify-end md:items-end bg-black bg-opacity-50">
    <div class="relative w-full md:max-w-xs  bg-opacity-90 rounded-lg shadow bg-gray-800 md:mr-10 md:mb-10 h-96 flex flex-col">
        <div class="p-4 border-b border-gray-600">
            <h3 class="text-lg font-semibold  text-white"><span id="sendMessage-ToName">#test</span></h3>
            <button type="button" class="absolute top-3 right-3 text-gray-400  bg-transparent  hover:bg-gray-600 hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="messageModal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Scrollable Messages Section -->
        <div id="sendMessage-loadingmsg" class="text-white bg-blue-400 text-center hidden">Loading message...</div>
        <div id="sendMessage-bodyview" class="p-4 overflow-y-auto flex-grow custom-scrollbar">
        </div>

        <!-- Reply Input -->
        <div class="p-4 border-t border-gray-600">
            <div class="relative">
                <input id="sendMessage-content" type="text" class="block w-full py-2 px-4   rounded-lg focus:ring-blue-500 focus:border-blue-900 bg-gray-700 text-white placeholder-gray-400" placeholder="Type your message..." autocomplete="off">
                <button id="sendMessage-btn" class="absolute right-3 top-2.5 text-blue-400 hover:text-blue-900">
                    <span id="msgButton-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 20V4L22 12L3 20ZM5 17L16.85 12L5 7V10.5L11 12L5 13.5V17ZM5 17V12V7V10.5V13.5V17Z" fill="#3F83F8"/>
                        </svg>
                    </span>
                    <span id="msgButton-icon-sending" class="hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path stroke="currentColor" stroke-width="4" d="M4 12a8 8 0 0116 0" />
                        </svg>
                    </span>
                </button>                
            </div>
        </div>
    </div>
</div>