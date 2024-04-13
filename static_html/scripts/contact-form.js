document.getElementById('contct-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    // Get form data
    const formData = new FormData(this);

    // Send form data to PHP script using Fetch API
    fetch('backend/contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Display message based on server response
        const messageElement = document.getElementById('contact-message');
        if (data.trim() === 'success') {
            messageElement.textContent = 'Your message has been sent successfully.';
        } else {
            messageElement.textContent = 'Failed to send your message. Please try again later.';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Display error message if fetch operation fails
        const messageElement = document.getElementById('contact-message');
        messageElement.textContent = 'An error occurred. Please try again later.';
    });
});
