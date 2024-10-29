import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';


// window.Pusher = Pusher;
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: `${import.meta.env.VITE_PUSHER_APP_KEY}`,
//     cluster: `${import.meta.env.VITE_PUSHER_APP_CLUSTER}`,
//     encrypted: true,
//     logToConsole: true ,
//     auth: {
//         headers: {
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         }
//     }
// });

const userId = window.Laravel.userId;

window.Laravel.showModal= function(id, firstname, lastname) {
    if (window.Modal){
        const modal2 = new window.Modal(document.getElementById('messageModal'));
        modal2.show();
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
console.log(channel);
channel.bind('App\\Events\\MessageSent', function(data) {
    console.log(`Message sent`);
    window.Laravel.showModal(data.senderID, data.firstname, data.lastname);
    console.log(`Message from ${data.senderID}: ${data.message}`);
});


// window.Echo.private(`chat.${userId}`)
// .listen('App\\Events\\MessageSent', (e) => {
//     console.log(`Message sent`);
//     window.Laravel.showModal(e.senderID);
// });
// //import '@hotwired/turbo';