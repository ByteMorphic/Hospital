document.addEventListener('DOMContentLoaded', function() {
    // Find the alert message element
    var alertMessage = document.getElementById('alert-message');

    // Check if the alert message element exists
    if (alertMessage) {
            // Set a timeout to hide the alert message after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            alertMessage.style.opacity = 0;
            alertMessage.style.transition = 'opacity 0.4s'; // Optional: fade out effect
        }, 4000);
    }

});
