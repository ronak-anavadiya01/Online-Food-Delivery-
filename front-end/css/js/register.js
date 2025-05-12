$(document).on('submit', '#registrationForm', function(e) { 
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "userregister.php",
        data: $(this).serialize(),
        success: function(data) {
            if (data.trim() === 'success') {
                location.reload();
            } else {
                $('#msg').html(data);
                $('#registrationForm').find('input').val('')
            }

        }
    });
});