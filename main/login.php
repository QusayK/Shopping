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

        .form{
            background-color: #f6f6f6;
        }
    </style>
</head>
<body>
    <div class="container-fluid row d-flex m-0">
        <form class="form col-7 col-md-5 m-auto border shadow p-3">
            <h2 class="py-2">Log in and start your journey with us</h2>
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
            <button type="submit" id="login" class="btn btn-info m-1">Log in</button>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" i
    ntegrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" i
    ntegrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            // Check form user input
            $('#login').click(function() {

                let email = $('#email').val();
                let password = $('#password').val();
                let data = {"email": email, "password": password};

                $.ajax({
                    type: 'POST',
                    url: '../api/user/check.php',
                    data: data, 
                    dataType: 'JSON',
                    cache: false,
                    beforeSend: function() {
                        $('login').val("Loading..");
                    },
                    success: function (result){
                        console.log(result);
                        if (result == true) {

                            window.open("index.php");

                        } else {
                            alert('You fucked up in something');
                         }
                    }
                });
            });    
        });
    </script>
</body>
</html>