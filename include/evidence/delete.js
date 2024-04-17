// Function to handle deletion of records
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-record').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Get the record ID from the data attribute
            const recordId = this.getAttribute('data-record-id');

            // Send an AJAX request to delete the record
            fetch(`../include/evidence/deleteEvidence.php?delete=${recordId}`)
                .then(response => response.json())
                .then(data => {
                    // Display success or error message
                    if (data.success) {
                        alert(data.message); // You can use a modal or toast for better UI
                        // Optionally, remove the deleted record from the UI
                        this.closest('tr').remove();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the record.');
                });
        });
    });
});