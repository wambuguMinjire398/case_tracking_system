 // Wait for the document to be fully loaded
 document.addEventListener('DOMContentLoaded', function() {
    // Get all delete buttons
    var deleteButtons = document.querySelectorAll('.delete-record');

    // Loop through each delete button
    deleteButtons.forEach(function(button) {
        // Add click event listener
        button.addEventListener('click', function(event) {
            // Prevent the default behavior of the link (navigating to another page)
            event.preventDefault();

            // Get the record ID from the data-record-id attribute
            var recordId = this.getAttribute('data-record-id');

            // Confirmation prompt before deleting
            if (confirm('Are you sure you want to delete this record?')) {
                // Make an AJAX request to delete the record
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '../include/add_filing/deleteRecords.php?delete=' + recordId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Check if deletion was successful
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // If successful, remove the corresponding row from the table
                            var rowToRemove = button.closest('tr');
                            rowToRemove.parentNode.removeChild(rowToRemove);
                        } else {
                            // If deletion failed, display an error message
                            alert('Error: ' + response.message);
                        }
                    }
                };
                xhr.send();
            }
        });
    });
});