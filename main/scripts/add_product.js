$(document).ready(function () {
   
    // Prevent form from submitting
    $(".form").submit(function(e){
        e.preventDefault();
    });

    
    $("#add").click(function(){

        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);

        let type, price;

        type = $('#type').val();
        price = $('#price').val();

        fd.append('type', type);
        fd.append('price', price);

        console.log(fd);
        $.ajax({
            url: '../api/product/create.php',
            type: 'POST',
            data: fd,
            contentType: false,
            cache: false,
            success: function(result){
                if (result != 0){

                    $("#img").attr("src",result); 
                    $(".preview img").show();
                } else {

                    alert('file not uploaded');
                }
            },
        });
    });
});