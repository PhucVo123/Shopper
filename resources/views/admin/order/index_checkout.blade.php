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
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					@if(Session::get('username') == false && Session::get('cart') == true)
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
										<input class="cart_quantity_input" type="text" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['quantity']}}" autocomplete="off" size="2" disabled>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{number_format($cart['product_price'] * $cart['quantity'], 0, '', ',')}} VND</p>
                                    <?php $sum = $sum + ($cart['product_price'] * $cart['quantity']) ?>
                                </td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
                        @endforeach
					@else
						@foreach($cart_checkout as $cart)
							<tr>
								<td class="cart_product">
									<a href="{{URL::to('/chi-tiet-san-pham/'.$cart->product_img)}}"><img src="/public/uploads/product/{{$cart->product_img}}" alt="" width="50px"></a>
								</td>
								<td class="cart_description">
									<h4><a href="{{URL::to('/chi-tiet-san-pham/'.$cart->product_id)}}">{{$cart->product_name}}</a></h4>
									<input name="order_product_id[]" class="order_product_id" type="hidden" value="{{$cart->product_id}}" />
									<p>ID: {{$cart->product_id}}</p>
								</td>
								<td class="cart_price">
									<p>{{number_format($cart->product_price, 0, '', ',')}} VND</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" name="cart_qty[]" value="{{$cart->quantity}}" autocomplete="off" size="2" disabled>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{number_format($cart->product_price * $cart->quantity, 0, '', ',')}} VND</p>
									<?php $sum = $sum + ($cart->product_price * $cart->quantity ) ?>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$cart->cart_id)}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
						@endforeach
					@endif
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>{{number_format($sum, 0, '', ',')}} VND</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>{{number_format($sum, 0, '', ',')}} VND</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
            <div class="shopper-informations">
				<div class="row">
					<div class="col-sm-5">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form role="form" action="{{URL::to('/checkout-product')}}" method="post">
                                {{ csrf_field() }}
								<input name="username" type="text" placeholder="Tên của bạn">
								<input name="address" type="text" placeholder="Địa chỉ">
								<input name="phone" type="number" placeholder="Số điện thoại">
								<input name="email" type="email" placeholder="Email">
								<input name="_user" type="hidden" value="{{ $idUser }}">
                                <textarea name="message"  placeholder="Bạn có yêu cầu gì thêm không?" rows="6"></textarea>
                                <input name="total" type="hidden" value="{{$sum}}">
                                <button class="btn btn-primary" type="submit">Thanh toán</button>
							</form>
							
						</div>
					</div>				
				</div>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
			</div>
		</div>
</section> <!--/#cart_items-->
@endsection