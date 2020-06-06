<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        body{
            background-color: #F2F8FD;
        }
    </style>
</head>
<body>
    <div class="container-fluid row m-0 p-0">
        <nav class="navbar bg-secondary navbar-dark navbar-expand-lg col-md-2 rounded-right shadow">
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarToggler" aria-controls="navbarToggler" 
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav d-flex flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link 3</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="col-md-10 d-flex flex-wrap justify-content-center mb-5 p-0" id="root"></div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" i
        ntegrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" i
        ntegrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>

    <script>
        $(document).ready(function (){

            // AJAX function
            function xhr(xfunction, url) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'JSON',
                    success: function (result){
                        xfunction(result);
                    }
                });
            }

            // Display all products request
            function display(result) {

                let products = "";
                let id, type, price, image;
                let len = result['data'].length;

                for (let i = 0; i < len; i++) {
                    id = result['data'][i].id;
                    type = result['data'][i].type;
                    price = result['data'][i].price;
                    image = result['data'][i].image;
                    
                    products += `<div class="card col-6 col-sm-4 col-md-3 col-lg-2 p-0 mx-1 mt-1 shadow">
                                    <img src=" + '${image}' + " class="card-img-top" alt="Product image">
                                    <div class="card-body">
                                        <h5 class="card-title">${price}</h5>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>`;
                    }

                $('#root').html(products);
            }

            xhr(display, '../api/product/read.php');
        });
    </script>
</body>
</html>