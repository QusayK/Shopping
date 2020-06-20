$(document).ready(function() {

    function remove_from_favorites (id) {

        $.ajax({
            type: 'GET',
            url: '../api/classification/remove_from_favorites.php?id='+id,
            dataType: 'JSON',
            success: function (result)  {
               
                if (result) {

                    window.location = "index.php";
                }
            }
        });
    }

    function display_all() {
        $.ajax({
            type: 'GET',
            url: '../api/product/read_favorite.php',
            dataType: 'JSON',
            cache: false,
            beforeSend: function() {
                $('#root').val("Loading..");
            },
            success: function (result){
    
                let products = "";
                let id, type, price, image;
                let len = result.length;
                
                for (let i = 0; i < len; i++) {
                    id = result[i].id;
                    type = result[i].type;
                    price = result[i].price;
                    image = result[i].image;
                    let url = `../images/${image}`;
    
                    products +=  `<div class="card col-9 col-sm-6 col-md-5 col-lg-3 p-0 mr-1 mt-1 shadow">
                                    <img src=${url} class="card-img-top img-fluid" alt="Product image">
                                    <div class="card-body">
                                        <h5 class="card-title">${price}₪</h5>
                                        <button type="button" class="btn btn-outline-secondary">
                                            <a href="product.php?id=${id}" target="_blank">Review</a>
                                        </button>
                                        <a href="#" onclick= class="d-block m-1">Remove from favorites</a>
                                        <a href="#"  class="d-block m-1">Add to basket</a>
                                        <a href="#"  class="btn btn-info">Buy</a>
                                    </div> 
                                </div>`;
                    }
    
                $('#root').html(products);
            }
        });
    }

    display_all();

    function check_type(data) {

        $.ajax({
            type: 'POST',
            data: data,
            url: '../api/product/read_type_favorite.php',
            dataType: 'JSON',
            cache: false,
            beforeSend: function() {
                $('#root').val("Loading..");
            },
            success: function (result) {
    
                let products = "";
                let id, type, price, image;
                let len = result.length;
                
                for (let i = 0; i < len; i++) {
                    id = result[i].id;
                    type = result[i].type;
                    price = result[i].price;
                    image = result[i].image;
                    let url = `../images/${image}`;
    
                    products += `<div class="card col-7 col-sm-5 col-md-4 col-lg-3 p-0 mx-1 mt-1 shadow">
                                    <img src='${url}' class="card-img-top" alt="Product image">
                                    <div class="card-body">
                                        <h5 class="card-title">${price}₪</h5>
                                        <a href="#" class="btn btn-info">Go somewhere</a>
                                    </div>
                                </div>`;
                    }
    
                $('#root').html(products);
            }
        });
    }

    $('#type_filter').on('change', function() {

        let type = $(this).val();
        let data = {type: type};

        if (type == "none") {
            display_all();
        } else {
            check_type(data);
        }
    });
    
});    