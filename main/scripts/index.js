$(document).ready(function (){

    // AJAX function
    function xhr1(xfunction, url) {
        $.ajax({
            type: 'GET',
            url: url,
            cahce: false,
            dataType: 'JSON',
            success: function (result)  {
                xfunction(result);
            }
        });
    }

    // AJAX function
    function xhr2(xfunction, url, data) {
        $.ajax({
            type: 'POST',
            data: data,
            url: url,
            cache: false,
            dataType: 'JSON',
            success: function (result) {
                xfunction(result);
            }
        });
    }

    function add_to_favorites (id) {

        $.ajax({
            type: 'GET',
            url: '../api/classification/add_to_favorites.php?id='+id,
            dataType: 'JSON',
            success: function (result)  {
               
                if (result) {

                    window.location = "favorite.php";
                }
            }
        });
    }

    function add_to_basket (id) {

        $.ajax({
            type: 'GET',
            url: '../api/classification/add_to_basket.php?id='+id,
            dataType: 'JSON',
            success: function (result)  {
               
                if (result) {

                    window.location = "favorite.php";
                }
            }
        });
    }

    function buy (id) {

        $.ajax({
            type: 'GET',
            url: '../api/classification/buy.php?id='+id,
            dataType: 'JSON',
            success: function (result)  {
               
                if (result) {

                    window.location = "favorite.php";
                }
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
            let url = `../images/${image}`;
            
            products += `<div class="card col-9 col-sm-6 col-md-5 col-lg-3 p-0 mr-1 mt-1 shadow">
                            <img src=${url} class="card-img-top img-fluid" alt="Product image">
                            <div class="card-body">
                                <h5 class="card-title">${price}₪</h5>
                                <button type="button" class="btn btn-outline-secondary">
                                    <a href="product.php?id=${id}" target="_blank">Review</a>
                                </button>
                                <a href="#" id="add_to_favorites" onclick="add_to_favorites(id)" class="d-block m-1">Add to favorites</a>
                                <a href="#"  class="d-block m-1">Add to basket</a>
                                <a href="#"  class="btn btn-info">Buy</a>
                            </div> 
                        </div>`;
        }
        
        $('#root').html(products);
    }

    xhr1(display, '../api/product/read.php');

    function check_type(result) {

        let products = "";
        let id, type, price, image;
        let len = result['data'].length;

        for (let i = 0; i < len; i++) {
            id = result['data'][i].id;
            type = result['data'][i].type;
            price = result['data'][i].price;
            image = result['data'][i].image;
            let url = `../images/${image}`;

            products += `<div class="card col-9 col-sm-6 col-md-5 col-lg-3 p-0 mr-1 mt-1 shadow">
                            <img src=${url} class="card-img-top img-fluid" alt="Product image">
                            <div class="card-body">
                                <h5 class="card-title">${price}₪</h5>
                                <button type="button" class="btn btn-outline-secondary">
                                    <a href="product.php?id=${id}" target="_blank">Review</a>
                                </button>
                                <a href="#" class="d-block m-1">Add to favorites</a>
                                <a href="#" class="d-block m-1">Add to basket</a>
                                <a href="#" class="btn btn-info">Buy</a>
                            </div>
                        </div>`;
        }

        $('#root').html(products);
    }

    $('#type_filter').on('change', function() {
        
        let type = $(this).val();
        let data = {type: type};

        if (type == "none") {
            xhr1(display, '../api/product/read.php');
        } else {
            xhr2(check_type, '../api/product/read_type.php', data)
        }
    });

    
});