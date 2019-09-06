$(document).ready(function () {
    $('#upload_img').on('change', function () {
        var fd = new FormData();
        fd.append('file', $(this)[0].files[0]);

        console.log(fd);

        $.ajax({
            url: '/custom/upload-img',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                var response = JSON.parse(response);
                if(response.success){
                    $('#upload_img_tag').attr('src', '/upload/tmp/' + response.success)
                }
                else{
                    alert(response.error);
                }
            },
        });
    });
});