$(document).ready(function(){
    $("#cart_submit").click(function(){
        var id = $("#cart_product_id").val();
        var name = $("#cart_product_name_" + id).val();
        var price = $("#cart_product_price_" + id).val();
        var img = $("#cart_product_img_" + id).val();
        var quantity = $("#quantity").val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/add-cart",
            method: "POST",
            data: {product_id: id,product_name: name ,product_price: price,product_img: img
                ,quantity: quantity,_token:_token},
            success: function(data)
            {
                Swal.fire({
                    title: "Bạn đã thêm đơn hàng thành công",
                    text: "Bạn có muốn chuyển sang Giỏ hàng của bạn không?",
                    icon: "success",
                    showCancelButton: true,
                    cancelButtonText: "Không, tôi chưa cần",
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#7CFC00",
                    confirmButtonText: "Vâng, chuyển tôi đến!"
                    
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/cart";
                    }
                  });
               

            },
        });
    });
});