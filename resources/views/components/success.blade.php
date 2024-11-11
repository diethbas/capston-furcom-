{{-- Notification box --}}
<div id="successMessage" class="hidden bg-green-500 text-white p-4 mb-10 m-2 rounded-md shadow-md transform scale-100 opacity-100">
    {{session()->has('successMessage') ? session('successMessage') : 'You have successfully registered!'}}
</div>
<script>
    function showSuccessMessage() {
        const successMessage = document.getElementById('successMessage');
        
        // Show the message
        successMessage.classList.remove('hidden');
        successMessage.classList.add('opacity-100', 'scale-100');

        // After 3 seconds animation
        setTimeout(function() {
            successMessage.classList.add('transition', 'duration-1000', 'opacity-0', 'scale-0');
        }, 1000);

        // After the animation hide the message
        setTimeout(function() {
            successMessage.classList.add('hidden');
            successMessage.classList.remove('opacity-0', 'scale-0');
        }, 2000);
    }

    // Call this function wherever necessary
    showSuccessMessage();
</script>