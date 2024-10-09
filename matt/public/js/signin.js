

function handleSignUpRedirect() {
    location.href = "signup.php"
}

// JavaScript to handle the countdown
let countdownElement = document.getElementById('countdown');
let timeRemaining = parseInt(countdownElement.innerHTML);

// Update the countdown every second
let countdownInterval = setInterval(function() {
    timeRemaining--;
    countdownElement.innerHTML = timeRemaining;

    // Stop the countdown when it reaches zero
    if (timeRemaining <= 0) {
        clearInterval(countdownInterval);
        countdownElement.innerHTML = "0"; // Display 0 when countdown ends
        // Optionally, you can reload the page or unlock the form here
        location.reload(); // Reloads the page when countdown finishes
    }
}, 1000); 