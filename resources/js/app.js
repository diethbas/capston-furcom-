import './bootstrap';
import './searchModal';
import './notification';
import './furbabyModal';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

const userId = (window.Laravel && window.Laravel.userId) || null;

if (userId){
    window.Laravel.showModal= function(id, firstname, lastname) {
        if (window.Modal){
            document.getElementById('messageModal').classList.remove('hidden');
            document.getElementById('messageModal').classList.add('flex');
            var dataEvent = new CustomEvent('threadShow', {});
            
            document.getElementById('sendMessage-ToName').innerHTML = firstname + ' ' + lastname;
            document.getElementById('messageModal').dataset.idTo = id;
            document.getElementById('messageModal').dispatchEvent(dataEvent);
    
        }
    }
    
    Pusher.logToConsole = true;
    
    var pusher = new Pusher(`${import.meta.env.VITE_PUSHER_APP_KEY}`, {
        cluster: `${import.meta.env.VITE_PUSHER_APP_CLUSTER}`,
        authEndpoint: '/pusher/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    });
    
    var channel = pusher.subscribe(`private-chat.${userId}`);
    channel.bind('pusher:subscription_succeeded', () => {
        console.log('Successfully subscribed to private-chat.4');
    });
    
    channel.bind('pusher:subscription_error', (status) => {
        console.error('Subscription failed:', status);
    });
    
    channel.bind('App\\Events\\MessageSent', function(data) {
        console.log(`Message sent`);
        window.Laravel.showModal(data.senderID, data.firstname, data.lastname);
        console.log(`Message from ${data.senderID}: ${data.message}`);
    });
}