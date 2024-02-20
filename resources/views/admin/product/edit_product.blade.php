@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa danh mục sản phẩm
                        </header>
                        <?php
                            use Illuminate\Support\Facades\Session;
                            $message = Session::get('message');
                            if($message)
                            {
                                echo '<span class="text-danger w-100 text-center">'. $message .'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                            @foreach($edit_product as $key => $product)
                                <form role="form" action="{{URL::to('/update-product/'.$product->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label for="name_product">Tên danh mục</label>
                                    <input type="text" class="form-control" name="name_product" id="name_product" value="{{ $product->product_name}}">
                                </div>

                                <div class="form-group">
                                    <label for="img_product">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="img_product" id="img_product" onchange="readURL(this);">
                                    <img id="blah" src="/public/uploads/product/{{$product->product_img}}" width="150px" height="200px">
                                </div>

                                <div class="form-group">
                                    <label for="price_product">Giá sản phẩm</label>
                                    <input type="number" class="form-control" name="price_product" id="price_product" value="{{ $product->product_price}}">
                                </div>

                                <div class="form-group">
                                    <label for="description_product">Tóm tắt sản phẩm</label>
                                    <input type="text" class="form-control" name="description_product" id="description_product" value="{{ $product->product_desc}}">
                                </div>

                                <div class="form-group">
                                    <label for="content_product">Nội dung</label>
                                    <textarea style="resize: none;" rows="7" name="content_product" class="form-control" id="content_product">{{ $product->product_content}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category_product">Danh mục</label>
                                    <select class="form-control input-sm- m-bot-15" name="category_product">
                                        @foreach($category_product as $key => $cate_pro)
                                            @if($cate_pro->category_id == $product->category_id)
                                            <option selected value="{{ $cate_pro->category_id}}">{{ $cate_pro->category_name}}</option>
                                            @else 
                                            <option value="{{ $cate_pro->category_id}}">{{ $cate_pro->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>                                 
                                </div>

                                <div class="form-group">
                                    <label for="brand_product">Thương hiệu</label>
                                    <select class="form-control input-sm- m-bot-15" name="brand_product">
                                        @foreach($brand as $key => $brand_pro)
                                            @if($brand_pro->brand_id == $product->brand_id)
                                            <option selected value="{{ $brand_pro->brand_id}}">{{ $brand_pro->brand_name}}</option>
                                            @else 
                                            <option value="{{ $brand_pro->brand_id}}">{{ $brand_pro->brand_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>                                 
                                </div>

                                <div class="form-group">
                                    <label for="hide_product">Ẩn/Hiện</label>
                                    <select class="form-control input-sm- m-bot-15" name="hide_product">
                                        <?php 
                                            if($product->product_status==0)
                                            {
                                            ?>
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                        <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        <?php

                                            }
                                        ?>
                                    </select>                                 
                                </div>
                                
                                <button type="submit" id="add_category" class="btn btn-info">Chỉnh sửa</button>
                            </form>
                            @endforeach
                            </div>
                        </div>
                    </section>
            </div>
</div>
<script>
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection