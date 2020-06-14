$(document).ready(function (){
    var ids = [];

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
            ids.push(id);
            type = result['data'][i].type;
            price = result['data'][i].price;
            image = result['data'][i].image;
            let url = `../images/${image}`;
            
            products += `<script src="scripts/comment.js"></script><div class="card col-9 col-sm-6 col-md-5 col-lg-3 p-0 mr-1 mt-1 shadow">
                            <img src=${url} class="card-img-top img-fluid" alt="Product image">
                            <div class="card-body">
                                <h5 class="card-title">${price}₪</h5>
                                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#reviewsModal">
                                    Reviews
                                </button>
                                <div class="modal fade" id="reviewsModal" tabindex="-1" role="dialog" aria-labelledby="reviewsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reviewsModalLabel">Product reviews</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Comments</h6>
                                                <div id="comment"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="d-block m-1">Add to favorites</a>
                                <a href="#" class="d-block m-1">Add to basket</a>
                                <a href="#" class="btn btn-info">Buy</a>
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

            products += `<div class="card col-7 col-sm-5 col-md-4 col-lg-3 p-0 mx-1 mt-1 shadow">
                            <img src='${url}' class="card-img-top img-fluid" alt="Product image">
                            <div class="card-body">
                                <h5 class="card-title">${price}₪</h5>
                                <button type="button" class="btn btn-outline-secondary data-toggle="modal" data-target="#reviewsModal">Reviews</button>
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