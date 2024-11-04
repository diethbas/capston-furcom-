

<div id="successMessage" class="hidden bg-green-500 text-white p-4 mb-10 m-2 rounded-md shadow-md transform scale-100 opacity-100">
    {{session()->has('successMessage') ? session('successMessage') : 'Your profile has been updated successfully!'}}
</div>
<script>
    function showSuccessMessage() {
        const successMessage = document.getElementById('successMessage');
        
        // Show the message at full opacity and scale
        successMessage.classList.remove('hidden');
        successMessage.classList.add('opacity-100', 'scale-100');

        // After 3 seconds, apply the shrinking and fading animation
        setTimeout(function() {
            successMessage.classList.add('transition', 'duration-1000', 'opacity-0', 'scale-0');
        }, 1000);

        // After the animation (1 second), hide the message
        setTimeout(function() {
            successMessage.classList.add('hidden');
            successMessage.classList.remove('opacity-0', 'scale-0');
        }, 2000); // 3 seconds delay + 1 second shrink/fade duration
    }

    // Call this function wherever necessary (e.g., after form submission)
    showSuccessMessage();
</script>