@extends('layout')
@section('content_home')
<div class="product-details"><!--product-details-->
        @foreach($get_product as $key => $product)
        <div class="col-sm-5">
            <div class="view-product">
                <img src="/public/uploads/product/{{$product->product_img}}" alt="" width="1500px"/>
                <h3>ZOOM</h3>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                            <a href=""><img src="/public/uploads/product/{{$product->product_img}}" alt="" width="90px" height="150px"></a>
                        </div>
                        
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                    </a>
            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{$product->product_name}}</h2>
                <p>Web ID: {{$product->product_id}}</p>
                <img src="images/product-details/rating.png" alt="" />
                <span>
                    <span>{{number_format($product->product_price, 0, '', ',')}} VND</span>
                    <form>
                        @csrf
                        <input name="cart_product_id" id="cart_product_id" type="hidden" value="{{$product->product_id}}" />
                        <input name="cart_product_name" id="cart_product_name_{{$product->product_id}}" type="hidden" value="{{$product->product_name}}" />
                        <input name="cart_product_price" id="cart_product_price_{{$product->product_id}}" type="hidden" value="{{$product->product_price}}" />
                        <input name="cart_product_price" id="cart_product_img_{{$product->product_id}}" type="hidden" value="{{$product->product_img}}" />
                        <label for="quantity">Quantity:</label>
                        <input name="quantity" id="quantity" type="text" value="1" />
                        <button type="button" class="btn btn-fefault cart" id="cart_submit">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </form>
                    
                    

                </span>
                <p><b>Availability:</b> In Stock</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> E-SHOPPER</p>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </div>
        @endforeach
</div><!--/product-details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Details</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details" >
            <div class="col-sm-12">
                <div class="product-image-wrapper">
                    <p  style="padding-left:15px;padding-right:10px;">
                    <?php echo $get_product[0]->product_content ?>
                    </p>
                </div>
            </div>
        </div>
        
       
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <style type="text/css">
                    .style_comment {
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background: #F0F0E9;
                    }
                </style>
                <form>
                    @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$get_product[0]->product_id}}">
                    <div id="show_comment"></div>
                </form>  
                    <p style="padding-top: 10px;"><b>Viết bình luận của bạn</b></p>
                <form action="#">
                    <span>
                        <input name="comment_name" class="comment_name" type="text" placeholder="Họ tên"/>
                        <input name="comment_email" class="comment_email" type="email" placeholder="Email"/>
                    </span>
                    <textarea name="comment_content" class="comment_content" placeholder="Bình luận của bạn..." ></textarea>
                    <div id="notify_comment"></div>
                    <b>Rating: </b> 
                    <button type="button" class="btn btn-default pull-right send_comment">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	
                @foreach($related_product as $key => $related)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="/public/uploads/product/{{$related->product_img}}" alt="" />
                                <h2>{{number_format($related->product_price, 0, '', ',')}} VND</h2>
                                <p>{{$related->product_name}}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            </a>			
    </div>
</div><!--/recommended_items-->
@endsection