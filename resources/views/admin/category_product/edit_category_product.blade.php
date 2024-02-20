@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa sản phẩm
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
                            @foreach($edit_category_product as $key => $cate_pro)
                                <form role="form" action="{{URL::to('/update-category-product/'.$cate_pro->category_id)}}" method="post">
                                    {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label for="name_category">Tên danh mục</label>
                                    <input type="text" class="form-control" name="name_category" id="name_category" value="{{ $cate_pro->category_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="description_category">Mô tả</label>
                                    <textarea style="resize: none;" rows="7" name="description_category" class="form-control" id="description_category">{{$cate_pro->category_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="hide_category">Ẩn/Hiện</label>
                                    <select class="form-control input-sm- m-bot-15" name="hide_category">
                                        <?php 
                                            if($cate_pro->category_status==0)
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
                                
                                <button type="submit" id="add_category" class="btn btn-info">Thêm</button>
                            </form>
                            @endforeach
                            </div>
                        </div>
                    </section>
            </div>
</div>
@endsection