@extends('layout')
@section('content_home')
<p style="padding-top: 10px;"><b>Viết bình luận của bạn</b></p>
<form action="#">
    <textarea name="rating_content" class="rating_content" placeholder="Bình luận của bạn..." ></textarea>
    <div id="notify_comment"></div>
    <div style="margin-top: 20px;"><b>Rating: </b></div>
    <ul class="list-inline" title="rating">
        @for($count = 1; $count <=5; $count++)
            @php
                $color = 'color: #ffcc00' 
            @endphp
        <li id="product_{{$count}}" data-index="{{$count}}" data-rating="" class="rating" style="cursor:pointer; {{$color}}; font-size:30px">
            &#9733;
        </li>
        @endfor
    </ul>
    <input name="orderdetail_id" type="hidden" value="{{$pro_id}}" /> 
    <input name="username_order" type="hidden" value="{{Session::get('username')}}" /> 
    <button type="button" class="btn btn-success pull-right send_rating">
        Send
    </button>
</form>
@endsection