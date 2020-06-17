$(document).ready(function () {

    function getUrlVars()
        {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }

    var pid = getUrlVars()['id'];

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

    function display_comment(result) {

        let comments = '';
        let len = result['data'].length;   
        let user_id, comment;

        for (let i = 0; i < len; i++) {

            user_id = result['data'][i].user_id;
            
            $.ajax({
                type: 'GET',
                url: '../api/user/read_single.php? id='+user_id,
                dataType: 'JSON',
                async: false,
                success: function (result)  {
                    name = result.name;
                }
            });

            comment = result['data'][i].comment;
            comments += `<span class="text-info">${name}: </span><div class="d-inline" id="comment_text" style="cursor: pointer">${comment}</div><br>
                <div class="d-flex justify-content-center invisible" id="edit_delete">
                    <input class="btn btn-info p-0" onclick="edit()" type="submit" value="Edit">
                    <input class="btn btn-info p-0 ml-1" onclick="delete()" type="submit" value="Delete">
                </div>`;
        }

        $('#comments').html(comments);
    }

    xhr1(display_comment, '../api/comments/read.php?id='+pid);

   $('#create_comment').on('click', function() {
       let comment = $('#comment').val();
        let data = {comment: comment, product_id: pid}
       $.ajax({
        type: 'POST',
        data: data,
        url: '../api/comments/create.php',
        cache: false,
        dataType: 'JSON',
        success: function (result) {

           if (result == 0) {
               $('#error').show(700);
           } else {

            $('#error').hide(700);
            xhr1(display_comment, '../api/comments/read.php?id='+pid);
            $('#comment').val('');
           }
        }
    });
   });

   function display_product(result) {

        let product = "";
        let id, type, price, image;

        id = result.id;
        type = result.type;
        price = result.price;
        image = result.image;
        let url = `../images/${image}`;

        product = `<div class="card col-12 p-0 mr-1 mt-1" style="background: lightgray">
                    <img src=${url} class="card-img-top img-fluid" alt="Product image">
                    <div class="card-body">
                        <div id="rateYo_product"></div>
                        <h5 class="card-title">${price}₪</h5>
                        <a href="#" class="btn btn-info">Buy</a>
                    </div>
                </div>`;

        $('#product-info').html(product);
   }

   xhr1(display_product, '../api/product/read_single.php?id='+pid);
});