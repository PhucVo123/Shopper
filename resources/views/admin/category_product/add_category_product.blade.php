@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name_category">Tên danh mục</label>
                                    <input type="text" class="form-control" name="name_category" id="name_category" placeholder="Danh mục sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="description_category">Mô tả</label>
                                    <textarea style="resize: none;" rows="7" name="description_category" class="form-control" id="description_category"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="hide_category">Ẩn/Hiện</label>
                                    <select class="form-control input-sm- m-bot-15" name="hide_category">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>                                 
                                </div>
                                <button type="submit" id="add_category" class="btn btn-info">Thêm</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
</div>
@endsection