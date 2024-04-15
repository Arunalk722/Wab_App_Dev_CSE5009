document.addEventListener('DOMContentLoaded', function() {
    const queryForm = document.getElementById('query-form');
    const confirmationDialog = document.getElementById('confirmation-dialog');
    const closeButton = confirmationDialog.querySelector('.close');
    const confirmationMessage = document.getElementById('confirmation-message');

    queryForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Display the confirmation dialog
        confirmationDialog.style.display = 'block';
        confirmationMessage.textContent = 'Your query has been submitted successfully!';
    });

    // Close the confirmation dialog when the close button is clicked
    closeButton.addEventListener('click', function() {
        confirmationDialog.style.display = 'none';
    });

    // Close the confirmation dialog when the user clicks outside of it
    window.addEventListener('click', function(event) {
        if (event.target === confirmationDialog) {
            confirmationDialog.style.display = 'none';
        }
    });
});


