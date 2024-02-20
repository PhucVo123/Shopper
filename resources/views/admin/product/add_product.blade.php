@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name_product">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name_product" id="name_product" placeholder="Tên sản phẩm">
                                </div>

                                <div class="form-group">
                                    <label for="img_product">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="img_product" id="img_product">
                                </div>
                
                                <div class="form-group">
                                    <label for="price_product">Giá sản phẩm</label>
                                    <input type="number" class="form-control" name="price_product" id="price_product" placeholder="Giá sản phẩm">
                                </div>

                                <div class="form-group">
                                    <label for="description_product">Tóm tắt sản phẩm</label>
                                    <input type="text" class="form-control" name="description_product" id="description_product" placeholder="Tóm tắt sản phẩm">
                                </div>

                                <div class="form-group">
                                    <label for="content_product">Nội dung</label>
                                    <textarea style="resize: none;" rows="7" name="content_product" class="form-control" id="content_product"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category_product">Danh mục</label>
                                    <select class="form-control input-sm- m-bot-15" name="category_product">
                                        @foreach($category_product as $key => $cate_pro)
                                            <option value="{{ $cate_pro->category_id}}">{{ $cate_pro->category_name}}</option>
                                        @endforeach
                                    </select>                                 
                                </div>

                                <div class="form-group">
                                    <label for="brand_product">Thương hiệu</label>
                                    <select class="form-control input-sm- m-bot-15" name="brand_product">
                                        @foreach($brand as $key => $brand_pro)
                                            <option value="{{ $brand_pro->brand_id}}">{{ $brand_pro->brand_name}}</option>
                                        @endforeach
                                    </select>                                 
                                </div>

                                <div class="form-group">
                                    <label for="hide_product">Ẩn/Hiện</label>
                                    <select class="form-control input-sm- m-bot-15" name="hide_product">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>                                 
                                </div>
                                <button type="submit" id="add_product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
</div>
@endsection