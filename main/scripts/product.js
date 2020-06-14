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

    var id = getUrlVars()['id'];

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

    function display_comment(result) {

        let comments = '';
        let len = result['data'].length;   
        
        for (let i = 0; i < len; i++) {

            comments += result['data'][i].comment;
        }

        $('#comments').html(comments);
    }

    xhr1(display_comment, '../api/comments/read.php?id='+id)

   $('#create_comment').on('click', function() {
       let comment = $('#comment').val();
        let data = {comment: comment, product_id: id}
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
            xhr1(display_comment, '../api/comments/read.php?id='+id);
            $('#comment').val('');
           }
        }
    });
   });
});