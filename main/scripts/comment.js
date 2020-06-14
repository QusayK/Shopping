$(document).ready(function () {

    $.getScript("scripts/index.js", function() {
        console.log(ids);
     });

    console.log(ids);
    function xhr(xfunction, url) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'JSON',
            success: function(result) {
                xfunction(result);
            }
        });
    }


});