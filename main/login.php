<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        body{
            background-color: #F2F8FD;
        }

        .container-fluid{
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container-fluid row d-flex m-0">
        <form class="col-7 col-md-5 m-auto">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck">
                <label class="form-check-label" for="exampleCheck">Check me out</label>
            </div>
            <button type="submit" id="login" class="btn btn-primary">Log in</button>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" i
    ntegrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" i
    ntegrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            // AJAX function
            function xhr(xfunction, url, data) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data, 
                        dataType: 'JSON',
                        success: function (result){
                            xfunction(result);
                        }
                    });
                }

            // Check form user input
            $('#login').click(function() {

                function check_user(result) {
                    if (result == true) {
                        window.location.replace("../main/index.php");
                    } else if (result == false){
                        alert('You fucked up in something');
                    }
                }

                let email = $('#email').val();
                let password = $('#password').val();
                let data = ["email":`${email}`, "password": `${password}`];
                data = JSON.parse(data);
                
                xhr(check_user, '../api/user/check.php', data)
            });
        });
    </script>
</body>
</html>