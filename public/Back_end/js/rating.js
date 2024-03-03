var index = 5;
localStorage.count = index;
$(document).on('click','.rating',function()
{
    index = $(this).data('index');
    localStorage.count = index;
    if($('#product_'+index).css('color') == 'rgb(255, 204, 0)')
    {
        for(var i = index + 1; i<=5; i++)
        {
            $('#product_'+i).css('color','#ccc');
        }

    }
    else
    {
        for(var i = 1; i<=index; i++)
        {
            $('#product_'+i).css('color','#ffcc00');
        }
    }
});

$(document).on('click','.send_rating',function()
{
    var rating_content = $('.rating_content').val();
    var rating_name = $('input[name="username_order"]').val();
    var rating = localStorage.count;
    var _token = $('input[name="_token"]').val();
    var order_id = $('input[name="orderdetail_id"]').val();
    $.ajax({
        url: "/send-rating",
        method: "POST",
        data: {orderdetail_id: order_id, rating_name: rating_name,rating: rating,rating_content:rating_content,_token:_token},
        success: function(data)
        {
            Swal.fire({
                title: "Bạn đã đánh giá sản phẩm thành công",
                text: "Bạn có muốn tiếp tục đánh giá không?",
                icon: "success",
                showCancelButton: true,
                cancelButtonText: "Không, tôi chưa cần",
                cancelButtonColor: "#d33",
                confirmButtonColor: "#7CFC00",
                confirmButtonText: "Vâng, chuyển tôi đến!"
                
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/order-status";
                }
                else
                {
                    window.location.href = "/trang_chu";
                }
              });
        }
    });
});