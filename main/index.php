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
    <title>Shopping</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        body{
            background-color: #F2F8FD;
        }

        .card{
            height: 400px;
        }

        .card img{
            height: 60%;
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
                            <a class="nav-link" href="add_products.php">Add products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="favorite.php">Favorites</a>
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
        <div class="col-md-10">
            <div class="row d-flex col-m-12 bg-white border rounded-bottom shadow p-4 mb-4">
                <select class="browser-default custom-select col-7 col-sm-5 col-md-3"  name="type_filter" id="type_filter">
                    <option value="none" selected>- Filter products</option>
                    <option value="clothes">Clothes</option>
                    <option value="electronics">Electronics</option>
                </select>
            </div>
            <div class="col-md-12 d-flex flex-wrap justify-content-center mb-5 p-0" id="root"></div>
        </div>
    </div>

    <script src="scripts/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" i
    ntegrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>