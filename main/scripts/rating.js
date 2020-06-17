$(function () {
 
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

    function overall_rating(result) {
        
        if (result['data'][0].rating > 0) {

            let overall_r, ratings_num;
            overall_r = result['data'][0].rating;
            ratings_num = result['data'][0].ratings_num;

            $('#overall-rating').html(overall_r);
            $('#number-of-votes').html(ratings_num);
        } else {

            $('#overall-rating').html(0);
            $('#number-of-votes').html(0);
        }
    };
    
    xhr1(overall_rating, '../api/rating/read.php?id=' + pid);

    function user_rating(result) {

        if (result.rating > 0) {

            let your_r;
            your_r = result.rating;

            $('#your-rating').html(your_r);
        } else {

            $('#your-rating').html(0);
        }
    }

    xhr1(user_rating, '../api/rating/read_single.php?pid='+pid);

    function product_rating_stars(result) {
        
        let rating, r;
        r = result['data'][0].rating;
        if (r > 0) {

            rating = r;
        } else {

            rating = 0;
        }

        $("#rateYo_product").rateYo({
            rating: rating,
            readOnly: true,
            halfStar: true
          });
    }

    xhr1(product_rating_stars, '../api/rating/read.php?id='+pid);

    $("#rateYo").rateYo({
        rating: 0,
        halfStar: true
      });

   $('#rateYo').rateYo().on('rateyo.change', function (e, data) {

        var rating = data.rating;
        $(this).parent().find('.score').text('score: ' + $(this).attr('data-rateyo-score'));
        $(this).parent().find('.result').text('rating: ' + rating);
        $(this).parent().find('input[name=rating]').val(rating);
   });

   $('#add').on('click', function (e) {
        e.preventDefault();

        let rating, data;

        rating = $('#rating').val();
        data = {rating: rating, product_id: pid};
        
        $.ajax({
            type: 'POST',
            url: '../api/rating/read_single.php?pid='+pid,
            cache: false,
            dataType: 'JSON',
            success: function (result) {
 
                if (result.rating > 0) {
                    
                    $.ajax({
                        type: 'POST',
                        data: data ,
                        url: '../api/rating/update.php',
                        cache: false,
                        dataType: 'JSON',
                        success: function(result) {
                            xhr1(overall_rating, '../api/rating/read.php?id=' + pid);
                            xhr1(user_rating, '../api/rating/read_single.php?pid='+pid);
                            xhr1(product_rating_stars, '../api/rating/read.php?id='+pid);
                        }
                });
            
                } else {

                    $.ajax({
                        type: 'POST',
                        data: data,
                        url: '../api/rating/create.php',
                        cache: false,
                        dataType: 'JSON',
                        success: function(result) {
                            xhr1(overall_rating, '../api/rating/read.php?id=' + pid);
                            xhr1(user_rating, '../api/rating/read_single.php?pid='+pid);
                            xhr1(product_rating_stars, '../api/rating/read.php?id='+pid);
                        }
                    });
                }
            } 
        });
   });
  });