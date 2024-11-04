window._ = window._ || {};

window._.searchbox = {
    findFurparent: async function() {
        var keyword = document.getElementById('searchText').value || '';
        var t = sessionStorage.getItem('t');
        await fetch(`/furparent/search/${keyword}`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + t,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window._.csrf
            }
        })
        .then(response => response.json())
        .then(async data => { 
            const display = document.getElementById('searchbox-display');
            display.innerHTML = '';

            for(const item of data){
                display.innerHTML += this.getTemplate(item.id, item.img, item.firstname, item.lastname, item.email);
            }
        })
        .catch(error => {console.error(error)});
    },
    getTemplate: function(id, img, firstname, lastname, email) {
        return `<a class="flex flex-wrap items-center gap-4 py-3 cursor-pointer" href="/profile/${id}">
                <img src="${img}" class="w-11 h-11 rounded-full">
                <div>
                    <p class="text-sm text-white font-bold">${firstname} ${lastname}</p>
                    <p class="text-xs text-white mt-0.5">${email}</p>
                </div>
            </a>`;
    }
};