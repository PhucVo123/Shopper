$(document).ready(function(){
    $('.btn_confirm').click(function(){
    var comment_status = $(this).data('status');
    var comment_id = $(this).data('index');
    $.ajax({
        url: "/confirm-comment",
        method: "POST",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {comment_id: comment_id, comment_status: comment_status},
        success: function(data)
        {
            location.reload();
        },
        error:function(data)
        {
           alert(JSON.stringify(data));
        },
    });

    });
    $('.btn-reply-comment').click(function(){     
        var comment_id = $(this).data('index');
        var comment_content = $('.reply_comment'+comment_id).val();
        var comment_product_id = $(this).data('product');
        $.ajax({
            url: "/reply-comment",
            method: "POST",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {comment_id: comment_id, comment_content: comment_content,product_id: comment_product_id},
            success: function(data)
            {
                location.reload();
            },
            error:function(data)
            {
               alert(JSON.stringify(data));
            },
        });
    
        });
});