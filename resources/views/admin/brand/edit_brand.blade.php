@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa thương hiệu sản phẩm
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
                            @foreach($edit_brand as $key => $brand)
                                <form role="form" action="{{URL::to('/update-brand/'.$brand->brand_id)}}" method="post">
                                    {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label for="name_brand">Tên thương hiệu</label>
                                    <input type="text" class="form-control" name="name_brand" id="name_brand" value="{{ $brand->brand_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="description_brand">Mô tả</label>
                                    <textarea style="resize: none;" rows="7" name="description_brand" class="form-control" id="description_brand">{{$brand->brand_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="hide_brand">Ẩn/Hiện</label>
                                    <select class="form-control input-sm- m-bot-15" name="hide_brand">
                                        <?php 
                                            if($brand->brand_status==0)
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
                                
                                <button type="submit" id="add_brand" class="btn btn-info">Chỉnh sửa</button>
                            </form>
                            @endforeach
                            </div>
                        </div>
                    </section>
            </div>
</div>
@endsection