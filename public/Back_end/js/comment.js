$(document).ready(function(){
    load_comment();
    function load_comment()
    {
        var product_id = $('.comment_product_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/load-comment",
            method: "POST",
            data: {product_id: product_id, _token:_token},
            success: function(data)
            {
                $('#show_comment').html(data);
                $("<button id='reply_comment' type='button'>Save</button><div id='comments'></div>").insertAfter('#end_comment');
            },
        });
    }
    $('.send_comment').click(function(){
        var product_id = $('.comment_product_id').val();
        var comment_name = $('.comment_name').val();
        var comment_content = $('.comment_content').val();
        var comment_email = $('.comment_email').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/send-comment",
            method: "POST",
            data: {product_id: product_id, comment_name:comment_name,comment_email:comment_email,comment_content:comment_content,_token:_token},
            success: function(data)
            {
                load_comment();
                $('.comment_name').val('');
                $('.comment_content').val('');
                $('.comment_email').val('');
                $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công</span>')
                $('#notify_comment').fadeOut(5000);
            },
        });

    });
    
});