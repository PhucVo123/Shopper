@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh mục các đơn hàng
    </div>
    <div class="row w3-res-tb">
      <?php
          use Illuminate\Support\Facades\Session;
          $message = Session::get('message');
          if($message)
          {
            echo "<script type='text/javascript'>alert('$message');</script>";
              Session::put('message',null);
          }
      ?>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tài khoản</th>
            <th>Tên</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ </th>
            <th>Email</th>
            <th>Sản phẩm</th>
            <th>Yêu cầu thêm</th>
            <th>Đã giao hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php $count = 0 ; ?>
          
          @foreach($all_order as $key => $order)

          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>@php echo DB::table('users')->where('id',$order->order_id_user)->value('name'); @endphp</td>
            <td>{{ $order->order_username}}</td>
            <td>{{ $order->order_phone}}</td>
            <td>{{ $order->order_address}}</td>
            <td>{{ $order->order_email}}</td>
            <td><a href="{{URL::to('/chi-tiet-san-pham/'.$order->product_id)}}">{{ $order->product_name}}</a></td>
            <td>{{ $order->order_message}}</td>
            <td>
                <?php
                if($order->orderdetail_status == 0)
                {
                    echo '<button class="d-inline btn btn-success btn_confirm_shipping" style="margin-bottom:5px;" data-status="1" data-index="'.$order->orderdetail_id.'">Thành công</button>
       
                    <button class=" d-inline btn btn-danger  btn_delete_order" data-status="0" data-index="'.$order->orderdetail_id.'">Hủy đơn hàng</button> ';
                }
                else
                {
                    echo 'Đã giao thành công';
                }
                 ?>
            </td>
            <td>
              <a href="{{URL::to('/edit-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure?')">
                <i class="fa fa-times text-danger text" ></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection