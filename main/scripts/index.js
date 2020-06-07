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
        console.log(result);
        for (let i = 0; i < len; i++) {
            id = result['data'][i].id;
            type = result['data'][i].type;
            price = result['data'][i].price;
            image = result['data'][i].image;
            
            products += `<div class="card col-6 col-sm-4 col-md-3 col-lg-2 p-0 mx-1 mt-1 shadow">
                            <img src=" + '${image}' + " class="card-img-top" alt="Product image">
                            <div class="card-body">
                                <h5 class="card-title">${price}₪</h5>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>`;
            }

        $('#root').html(products);
    }

    xhr(display, '../api/product/read.php');
});