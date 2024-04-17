src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js";

$(document).ready(function() {
    $('.upload-btn').click(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = $(this).closest('form'); // Get the closest form
        var formData = new FormData(form[0]); // Create FormData object from the form

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                alert(response); // Example: alert the response
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('Error: ' + error); // Example: alert the error message
            }
        });
    });
});

