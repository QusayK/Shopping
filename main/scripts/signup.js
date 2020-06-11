$(document).ready(function() {

    $('#form_alert').hide();

    // Prevent form from submitting
    $(".form").submit(function(e){
        e.preventDefault();
    });

    // Check form user input
    $('#signup').click(function() {

        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let data = {name: name, email: email, password: password};
        
        $.ajax({
            type: 'POST',
            url: '../api/user/create.php',
            data: data, 
            dataType: 'JSON',
            cache: false,
            beforeSend: function() {
                $('#signup').val("Loading..");
            },
            success: function (result) {
                
                if (result == true) {

                    $('#form_alert').hide();
                    window.location = "index.php";

                } else if (result == false) {

                    $('#form_alert').show();
                 }
            }
        });
    });    
});