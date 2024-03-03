$(document).on('click','.btn_confirm_shipping',function()
{
    var order_id = $(this).data('index');
    $.ajax({
        url: "/confirm-shipping",
        method: "POST",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {orderdetail_id: order_id},
        success: function(data)
        {
            alert('Cập nhật trạng thái giao hàng thành công');
            location.reload();
        },
        error:function(data)
        {
           alert(JSON.stringify(data));
        },
    });

});
$(document).on('click','.btn_delete_order',function()
{
    var order_id = $(this).data('index');
    $.ajax({
        url: "/delete-order",
        method: "POST",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {orderdetail_id: order_id},
        success: function(data)
        {
            alert('Xóa đơn hàng thành công');
            location.reload();
        },
        error:function(data)
        {
           alert(JSON.stringify(data));
        },
    });

});