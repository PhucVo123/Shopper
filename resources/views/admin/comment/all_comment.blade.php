@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh mục sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
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
            <th>Tên</th>
            <th>Email</th>
            <th>Bình luận </th>
            <th>Sản phẩm</th>
            <th>Ngày</th>
            <th>Duyệt</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php $count = 0 ; ?>
          
          @foreach($all_comment as $key => $comment)

          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $comment->comment_name}}</td>
            <td>{{ $comment->comment_email}}</td>
            <td>{{ $comment->comment_content}}
            <br>
            <ol>
            <?php 
                foreach($comment_admin as $key => $admin)
                {
                  if($admin->comment_id_reply == $comment->comment_id)
                  {
                    echo "<li>".$admin->comment_content."</li>";
                  }
                }
            ?>
            </ol> 
            <textarea class="form-control reply_comment{{ $comment->comment_id}}" rows="5"></textarea> 
            <br> 
            <button class="btn btn-default btn-xs btn-reply-comment" data-index="{{ $comment->comment_id}}" data-product="{{ $comment->product_id}}">Trả lời</button>
            </td>
            
            <td><a href="{{URL::to('/chi-tiet-san-pham/'.$comment->product_id)}}">{{ $comment->product_name}}</a></td>
            <td>{{ $comment->comment_date}}</td>
            <td>
                <?php
                if($comment->comment_status == 1)
                {
                    echo '<button class="btn btn-danger btn_confirm" data-status="0" data-index="'.$comment->comment_id.'">Bỏ duyệt</button>';
                }
                else
                {
                    echo '<button class="btn btn-success btn_confirm" data-status="1" data-index="'.$comment->comment_id.'">Duyệt</button>';
                }
                 ?>
            </td>
            <td>
              <a href="{{URL::to('/edit-product/'.$comment->comment_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a href="{{URL::to('/delete-comment/'.$comment->comment_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure?')">
                <i class="fa fa-times text-danger text" ></i>
                <?php Session::put('id', $comment->product_id); ?>
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