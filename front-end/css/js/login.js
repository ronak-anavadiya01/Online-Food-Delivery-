$(document).on('submit', '#loginForm', function(e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "userLogin.php",
        data: $(this).serialize(),
        success: function(data) {
            if (data.trim() === 'success') {
                location.reload();
            } else {
                $('#loginMsg').html(data);
                $('#loginForm').find('input').val('')
            }

        }
    });
});