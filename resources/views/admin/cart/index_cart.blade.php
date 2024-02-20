@extends('layout')
@section('content_home')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<?php

				if(session()->has('message'))
				{
					echo '<div class="alert alert-success">'. session()->get('message') .'</div>';
				}
			?>
			<div class="table-responsive cart_info">
			<form role="form" action="{{URL::to('/update-cart')}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<table id="table_cart" class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td>Action</td>
							<td></td>
						</tr>
					</thead>
					<tbody>							
							@if(Session::get('cart') == true)
								@foreach(Session::get('cart') as $key => $cart)
								<tr>
									<td class="cart_product">
										<a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}"><img src="/public/uploads/product/{{$cart['product_img']}}" alt="" width="50px"></a>
									</td>
									<td class="cart_description">
										<h4><a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}">{{$cart['product_name']}}</a></h4>
										<input name="order_product_id" class="order_product_id" type="hidden" value="{{$cart['product_id']}}" />
										<p>ID: {{$cart['product_id']}}</p>
									</td>
									<td class="cart_price">
										<p>{{number_format($cart['product_price'], 0, '', ',')}} VND</p>
									</td>
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<input class="cart_quantity_input" type="text" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['quantity']}}" autocomplete="off" size="2">
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price">{{number_format($cart['product_price'] * $cart['quantity'], 0, '', ',')}} VND</p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								@endforeach
							@endif
							<tr>
								<td>
									@if(Session::get('cart') == true || !empty(Session::get("cart")))
										<input type="submit" name="update_qty" class="btn btn-secondary btn-md" style="margin-bottom: 10px;" value="Cập nhật giỏ hàng"/>
									@endif
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									@if(Session::get('cart') == true || !empty(Session::get("cart")))
										<a href="{{URL::to('/order-product')}}" id="order" class="btn btn-success btn-md" style="margin-bottom: 10px;">Thanh toán</a>
									@endif
								</td>

							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
</section> <!--/#cart_items-->
@endsection