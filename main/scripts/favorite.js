$(document).ready(function() {

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
            console.log(result);
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
});    