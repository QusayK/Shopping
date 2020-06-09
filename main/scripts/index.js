$(document).ready(function (){

    // AJAX function
    function xhr1(xfunction, url) {
        $.ajax({
            type: 'GET',
            url: url,
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
            
            products += `<div class="card col-6 col-sm-4 col-md-3 col-lg-2 p-0 mx-1 mt-1 shadow">
                            <img src=${url} class="card-img-top img-fluid" alt="Product image">
                            <div class="card-body">
                                <h5 class="card-title">${price}₪</h5>
                                <a href="#" class="btn btn-info">Go somewhere</a>
                            </div>
                        </div>`;
            }

        $('#root').html(products);
    }

    xhr1(display, '../api/product/read.php');

    $('#type_filter').on('change', function() {
        let type = $(this).val();
        let data = {type: type};

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

                products += `<div class="card col-6 col-sm-4 col-md-3 col-lg-2 p-0 mx-1 mt-1 shadow">
                                <img src='${url}' class="card-img-top img-fluid" alt="Product image">
                                <div class="card-body">
                                    <h5 class="card-title">${price}₪</h5>
                                    <a href="#" class="btn btn-info">Go somewhere</a>
                                </div>
                            </div>`;
                }
    
            $('#root').html(products);
        }

        if (type == "none") {
            xhr1(display, '../api/product/read.php');
        } else {
            xhr2(check_type, '../api/product/read_type.php', data)
        }
    });
});