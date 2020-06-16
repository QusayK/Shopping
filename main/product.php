<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <style>
        body{
            background-color: #F2F8FD;
        }
        .card{
            height: 450px;
        }

        .card img{
            height: 50%;
        }
        </style>
    </head>
    <body>

        <div class="container-fluid row m-0 p-0">
            <div class="col-12 col-sm-6 col-md-3 col-lg-2 p-0 m-0">
                <div class="col-12 p-2" id="product-info"></div>
            </div>
            <div class="col-12 col-lg-10">
                <div class="row d-flex justify-content-between col-m-12 bg-white border rounded-bottom shadow p-4 mb-4">
                   <div>
                        <div id="rateYo"></div>
                        <span class="result ml-1 pl-2" id="result">0</span>
                        <input type="hidden" name="rating" id="rating">
                        <div class="ml-1 pl-2"><input type="submit" class="btn btn-info p-1" id="add" name="add" value="Rate"></div>
                    </div>    
                    <div>
                        <div class="overall-rating" id="overall-rating"></div>
                        <div class="number-of-votes" id="number-of-votes"></div>
                    </div>
                    <h2 class="text-secondary">ONLINE <small><sup><strong class="text-info">MARKET</strong></sup></small></h2>
                </div>
                <div class="col-md-12 d-flex flex-wrap justify-content-start mb-5 p-0 shadow" style="background-color: #FAFAFA">
                    <div class="text-danger col-12" id="error" style="display: none">Write a comment</div>
                    <div class="comment-section p-3">
                        <div class="p-2" id="comments"></div>
                        <textarea name="comment" class="form-control mb-1" id="comment" cols="30" rows="1"></textarea>
                        <input type="submit" class="btn btn-info p-1" id="create_comment">
                    </div>
                </div>
            </div>
        </div>

        <script src="scripts/product.js"></script>
        <script src="scripts/rating.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>