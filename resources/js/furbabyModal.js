window._ = window._ || {};

window._.furbabyModal = {
    id: null,
    editMode: null,
    deleteMedia: async function(id) {
        const name = document.getElementById('petprofile_name');
        var t = sessionStorage.getItem('t');
        await fetch(`/media/delete/${id}`, {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + t,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window._.csrf
            }
        })
        .then(response => response.json())
        .then(async data => { 
            const todeleteMedia = document.getElementById(`btn_media_id_${id}`);
            if(todeleteMedia){
                todeleteMedia.remove();
            }
            const media_section = document.getElementById('furbaby_media_section')
            if (media_section.innerHTML.trim()===''){
                media_section.innerHTML = `
                    <div class="bg-gray-800 text-gray-800 border border-gray-800 shadow-lg rounded-lg p-8 text-center max-w-md mx-auto">
                        <h2 class="text-xl font-semibold mb-4 text-white">No Media to display for <strong class="text-green-400">${name.innerHTML}</strong></h2>
                    </div>`;
                media_section.classList.remove("grid-cols-2");
                media_section.classList.remove("sm:grid-cols-2");
                media_section.classList.remove("lg:grid-cols-3");
                media_section.classList.add("grid-cols-1");
            }
        })
        .catch(error => {console.error(error)});
    },
    showMedias: async function() {
        const name = document.getElementById('petprofile_name');
        
        await fetch(`/furbaby/medias/${window._.furbabyModal.id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window._.csrf
            }
        })
        .then(response => response.json())
        .then(async data => { 
            const media_section = document.getElementById('furbaby_media_section');
            media_section.innerHTML = `
                            <div class="bg-gray-800 text-gray-800 border border-gray-800 shadow-lg rounded-lg p-8 text-center max-w-md mx-auto">
                                <h2 class="text-xl font-semibold mb-4 text-white">No Media to display for <strong class="text-green-400">${name.innerHTML}</strong></h2>
                            </div>`;
            media_section.classList.remove("grid-cols-2");
            media_section.classList.remove("sm:grid-cols-2");
            media_section.classList.remove("lg:grid-cols-3");
            media_section.classList.add("grid-cols-1");
            let withValue = false;
            for(const media of data.medias){
                if(!withValue) {
                    media_section.innerHTML = '';
                }
                withValue = true;
                if (window._.furbabyModal.editMode){
                    media_section.innerHTML += `
                    <div class="relative group" id="btn_media_id_${media.mediaID}">
                        <img class="w-full aspect-square object-cover" src="${media.img}" alt="${media.img} 1">
                        <button class="absolute top-2 right-2 bg-gray-600 hover:bg-gray-700 text-white rounded-full p-2 shadow-lg focus:outline-none" onclick="window._.furbabyModal.deleteMedia(${media.mediaID})">
                            <svg fill="white" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 30 30">
                                <path d="M 13 3 A 1.0001 1.0001 0 0 0 11.986328 4 L 6 4 A 1.0001 1.0001 0 1 0 6 6 L 24 6 A 1.0001 1.0001 0 1 0 24 4 L 18.013672 4 A 1.0001 1.0001 0 0 0 17 3 L 13 3 z M 6 8 L 6 24 C 6 25.105 6.895 26 8 26 L 22 26 C 23.105 26 24 25.105 24 24 L 24 8 L 6 8 z"></path>
                            </svg>
                        </button>
                    </div>`;
                }
                else {
                    media_section.innerHTML += `
                    <div class="relative group" id="btn_media_id_${media.mediaID}">
                        <img class="w-full aspect-square object-cover" src="${media.img}" alt="${media.img} 1">
                    </div>`;
                }
            }
            if(withValue) {
                media_section.classList.add("grid-cols-2");
                media_section.classList.add("sm:grid-cols-2");
                media_section.classList.add("lg:grid-cols-3");
                media_section.classList.remove("grid-cols-1");
            }
        })
        .catch(error => {console.error(error)});
    },
    tagDelete: function() {
        const name = document.getElementById('petprofile_name');
        var t = sessionStorage.getItem('t');
        if (confirm("Are you sure you want to delete " + name.innerHTML)){
            fetch(`/furbaby/delete/${window._.furbabyModal.id}`, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + t,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window._.csrf
                }
            })
            .then(response => response.json())
            .then(async data => { 
                document.getElementById('bigModal').classList.add('hidden');
                window.location.reload();
            })
            .catch(error => {console.error(error)});
        }
    },
    tagMissingOrFound: async function() {
        var t = sessionStorage.getItem('t');
        await fetch(`/furbaby/missingTag/${window._.furbabyModal.id}`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + t,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window._.csrf
            }
        })
        .then(response => response.json())
        .then(async data => { 
            const img = document.getElementById('petprofile_img');
            const name = document.getElementById('petprofile_name');
            const age = document.getElementById('petprofile_age');
            const qr = document.getElementById('petprofile_qr');
            const ismissing = document.getElementById('petprofile_ismissing');
            const ismissing_notif = document.getElementById('ismissing_notif');


            let img_value = data.furbaby.img || '/';
            if (img_value === '/'){
                img_value = '/img/paw.png';
            }
            img.src = img_value;
            name.innerHTML = data.furbaby.name;
            age.innerHTML = "Age: " + data.furbaby.age;

            if (data.furbaby.ismissing) {
                ismissing.innerHTML = "Untag as Missing";
            }
            else {
                ismissing.innerHTML = "Tag as Missing";
            }

            
            if (ismissing_notif) {
                if (data.furbaby.ismissing) {
                    ismissing_notif.classList.remove('hidden');
                }
                else {
                    ismissing_notif.classList.add('hidden');
                }
            }

            qr.src = "/qr?data="+window.location.origin+"?qrProfile="+data.furbaby.furbabyID;
            document.getElementById('bigModal').classList.remove('hidden');
        })
        .catch(error => {console.error(error)});
    },
    showModal: async function(id, isEdit = false) {
        window._.furbabyModal.editMode = isEdit;
        await fetch(`/furbaby/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window._.csrf
            }
        })
        .then(response => response.json())
        .then(async data => { 
            window._.furbabyModal.id = data.furbaby.furbabyID;
            const qr = document.getElementById('petprofile_qr');
            if (qr) {
                qr.src = "/qr?data="+window.location.origin+"?qrProfile="+data.furbaby.furbabyID;
            }
            const img = document.getElementById('petprofile_img');
            const name = document.getElementById('petprofile_name');
            const age = document.getElementById('petprofile_age');
            
            let img_value = data.furbaby.img || '/';
            if (img_value === '/'){
                img_value = '/img/paw.png';
            }
            img.src = img_value;
            name.innerHTML = data.furbaby.name;
            age.innerHTML = "Age: " + data.furbaby.age;
            await window._.furbabyModal.showMedias();

            const ismissing = document.getElementById('petprofile_ismissing');
            const isEditButton = document.getElementById('dropdownMenuIconButton');
            const ismissing_notif = document.getElementById('ismissing_notif');
            const petprofile_message_parent = document.getElementById('petprofile_message_parent');
            const petprofile_description = document.getElementById('petprofile_description');
            
            
            if(petprofile_description){
                petprofile_description.innerHTML = data.furbaby.description;
            }
            if (petprofile_message_parent) {
                petprofile_message_parent.href=`/profile/${data.furbaby.furparentID}?do=message`;
            }
            if (isEditButton){

                if (isEdit) {
                    qr.parentElement.classList.remove('hidden');
                    isEditButton.classList.remove('hidden');
                }
                else {
                    qr.parentElement.classList.add('hidden');
                    isEditButton.classList.add('hidden');
                }
            }
            
            if(ismissing){
                if (data.furbaby.ismissing) {
                    ismissing.innerHTML = "Untag as Missing";
                }
                else {
                    ismissing.innerHTML = "Tag as Missing";
                }
            }
            
            if (ismissing_notif) {
                if (data.furbaby.ismissing) {
                    ismissing_notif.classList.remove('hidden');
                }
                else {
                    ismissing_notif.classList.add('hidden');
                }
            }
            document.getElementById('bigModal').classList.remove('hidden');
        })
        .catch(error => {console.error(error)});
        
    }
}