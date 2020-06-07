$(document).ready(function() {

    $('#form_alert').hide();

    // Prevent form from submitting
    $(".form").submit(function(e){
        e.preventDefault();
    });

    // Check form user input
    $('#login').click(function() {

        let email = $('#email').val();
        let password = $('#password').val();
        let data = {email: email, password: password};

        $.ajax({
            type: 'POST',
            url: '../api/user/check.php',
            data: data, 
            dataType: 'JSON',
            cache: false,
            beforeSend: function() {
                $('#login').val("Loading..");
            },
            success: function (result){

                if (result == true) {

                    window.location = "index.php";

                } else if (result == false){
                    $('#form_alert').show();
                 }
            }
        });
    });    
});