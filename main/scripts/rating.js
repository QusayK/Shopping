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

    function user_rating(result) {

        let overall_r;
        overall_r = result.rating;

        $('#overall-rating').text('Your rating: ' + overall_r);
    }

    xhr1(user_rating, '../api/rating/read_single.php?pid='+pid);

    $("#rateYo").rateYo({
      rating: 3.6,
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
            data: data,
            url: '../api/rating/create.php',
            cache: false,
            dataType: 'JSON',
            success: function (result) {
                if (result == 0) {
                    alert('Something went wrong');
                }
            }
        });
   });
  });