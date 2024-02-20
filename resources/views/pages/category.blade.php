@extends('layout')
@section('category')

@foreach($all_category_product as $key => $cat_pro)
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a href="{{URL::to('/danh-muc-san-pham/'.$cat_pro->category_id)}}">
                {{$cat_pro->category_name}}
            </a>
        </h4>
    </div>
</div>
@endforeach
@endsection