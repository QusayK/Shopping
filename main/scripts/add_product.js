$(document).ready(function () {

    $('#alert').hide();
    
    $("#add").on('click', function(e){
        e.preventDefault();
        e.stopPropagation();

        var thisBtn = $(this);
        var thisForm = thisBtn.closest("form");
        var formData = new FormData(thisForm[0]);

        var files = $('#file')[0].files[0];
        formData.append('file', files);

        let type, price;

        type = $('#type').val();
        price = $('#price').val();

        formData.append('type', type);
        formData.append('price', price);

        $.ajax({
            url: '../api/product/create.php',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                
                if (result != 0) {
                    $("#img").attr("src", result.location);
                    $(".preview img").show();
                    $('#alert').hide();

                } else if (result == 0) {

                    $('#alert').show();
                }
            }
        });
    });
});