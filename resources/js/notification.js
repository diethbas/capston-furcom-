window._ = window._ || {};

window._.notif = {
    notificationTagRead: async function() {
        var t = sessionStorage.getItem('t');
        await fetch(`/notif/tag/read`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + t,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window._.csrf
            }
        })
        .then(response => response.json())
        .then(async data => { 
            setTimeout(() => {
                const nodes = document.querySelectorAll('#notificationDropdown .new-notif');
                for(const node of nodes){
                    node.classList.remove('new-notif');
                }
                const badge = document.getElementById('badge-notif');
                if (badge){
                    badge.classList.add('hidden');
                }
            }, 2000);
        })
        .catch(error => {console.error(error)});
    },
    msgNotifTagRead: async function() {
        var t = sessionStorage.getItem('t');
        await fetch(`/message/tag/read`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + t,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window._.csrf
            }
        })
        .then(response => response.json())
        .then(async data => {  
            setTimeout(() => {
                const nodes = document.querySelectorAll('#chatDropdown .new-notif');
                for(const node of nodes){
                    node.classList.remove('new-notif');
                }
                const badge = document.getElementById('badge-msg');
                if (badge){
                    badge.classList.add('hidden');
                }
            }, 2000);
        })
        .catch(error => {console.error(error)});
    },
}