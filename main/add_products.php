<?php
    session_start();

    if (!isset($_SESSION['login'])) {

        header("Location: login.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add products</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        body{
            background-color: #F2F8FD;
        }

        .form{
            background-color: #ECF0F1;
        }

        .preview{
            max-width: 150px;
            min-height: 100px;
            border: 1px solid black;
            margin: 0 auto;
            background: white;
        }

        .preview img{
            width: 150px;
            height: 100px;
            display: none;
        }
    </style>
</head>
<body>
<div class="container-fluid row m-0 p-0">
        <div class="col-md-2" style="max-height: 400px">
            <nav class="navbar bg-secondary navbar-dark rounded-bottom navbar-expand-lg shadow mh-100">
                <button class="navbar-toggler" type="button" data-toggle="collapse" 
                    data-target="#navbarToggler" aria-controls="navbarToggler" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav d-flex flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="favorite.php">Favorites</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_products.php">Add products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="basket.php">Basket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchases.php">Purchases</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <form class="form col-7 col-md-5 col-lg-4 mx-auto my-5 border shadow p-4" id="form" method="POST" enctype="multipart/form-data">
            <h3 class="text-secondary py-2">Add product to sell</h3>
            <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                <strong>Invalid!</strong> Make sure to fill the data correctly.
            </div>
            <div class='preview'>
                <img src="" class="img-fluid" id="img">
            </div>
            <div class="custom-file m-1" >
                <input type="file" class="custom-file-input" name="file" id="file">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <select class="browser-default custom-select m-1" id="type">
                    <option value="none" selected>- Select type</option>
                    <option value="clothes">Clothes</option>
                    <option value="electronics">Electronics</option>
            </select>
            <div class="form-group m-1">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="₪">
            </div>
            <button type="submit" id="add" class="btn btn-info m-1">Add</button>
        </form>
    </div>

    <script src="scripts/add_product.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>