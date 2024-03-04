@extends('layout')
@section('content_home')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('trang_chu')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->

            <?php $sum = 0 ?>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>
			<div class="table-responsive cart_info">
					<?php
						if(session()->has('message'))
						{
							echo '<div class="alert alert-danger">'. session()->get('message') .'</div>';
						}
					?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
                            <td></td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td class="action">Action</td>
                            
						</tr>
					</thead>
					<tbody>
                    
                        @for($i = 0; $i < count($ordered); $i+=5)
                            
                            @foreach($ordered[$i] as $val)
                            
                                <tr>
                                    <td class="cart_product">
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$val->product_img)}}"><img src="/public/uploads/product/{{$val->product_img}}" alt="" width="50px"></a>
                                    </td>
                                    <td></td>
                                    <td class="cart_description">
                                        <h4><a href="{{URL::to('/chi-tiet-san-pham/'.$val->product_id)}}">{{$val->product_name}}</a></h4>
                                        <input name="order_product_id[]" class="order_product_id" type="hidden" value="{{$val->product_id}}" />
                                        <p>ID: {{$val->product_id}}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{number_format($val->product_price, 0, '', ',')}} VND</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                        <input class="cart_quantity_input" type="text" name="cart_qty[]" value="{{$ordered[$i+1]}}" autocomplete="off" size="2" disabled>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">{{number_format($ordered[$i+4] * $ordered[$i+1], 0, '', ',')}} VND</p>
                                        <?php $sum = $sum + ($val->product_price * $ordered[$i+1] ) ?>
                                    </td>
                                    <td class="cart_total">
                                        @if($ordered[$i+2] == 0)
                                        <p>Shipping to the buyer</p>
                                        @elseif($ordered[$i+2] == 1)
                                        <a class="btn btn-success" href="{{URL::to('/completed-order/'.$ordered[$i+3])}}" role="button" style="display: inline;">Completed</a>
                                        @else
										<p style="display: inline;">Completed</p>
										<a class="btn btn-success" href="{{URL::to('/rating/'.$ordered[$i+3])}}" role="button" style="display: inline;">Rating</a>
										@endif
                                    </td>
                                </tr>
                            
                            @endforeach
                        
                        @endfor
					</tbody>
				</table>
			</div>
</section> <!--/#cart_items-->
@endsection