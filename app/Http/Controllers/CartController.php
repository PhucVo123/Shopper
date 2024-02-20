<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keyword = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();

        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand = DB::table('tbl_brand')->get();

        return view("admin.cart.index_cart")->with('all_category_product',$all_category_product)->with('all_brand',$all_brand)
                                            ->with('meta_desc',$meta_desc)->with('meta_keyword',$meta_keyword)->with('meta_title',$meta_title)
                                            ->with('url_canonical',$url_canonical);
    }
    public function add_cart(Request $request)
    {
       $data = $request->all();
       $session_id = substr(md5(microtime()),rand(0,10),5);
       $cart = Session::get("cart");
       if($cart == true)
       {
            $valiable = 0;
            foreach($cart as $key => $val)
            {
                if($val['product_id'] == $data['product_id'])
                {
                    $valiable++;
                    
                }
            }
            if($valiable == 0)
            {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data["product_name"],
                    'product_price' => $data["product_price"],
                    'product_img' => $data["product_img"],
                    'quantity' => $data["quantity"],
                    'product_id' => $data["product_id"],
                );
                Session::put('cart', $cart);
            }
       }
       else
       {
        $cart[] = array(
            'session_id' => $session_id,
            'product_name' => $data["product_name"],
            'product_price' => $data["product_price"],
            'product_img' => $data["product_img"],
            'quantity' => $data["quantity"],
            'product_id' => $data["product_id"],
        );
       }
       Session::put('cart', $cart);
       Session::save();

    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get("cart");
       if($cart == true)
       {
            foreach($data['cart_qty'] as $key => $qty)
            {
                foreach($cart as $session => $val)
                {
                    if($val['session_id'] == $key)
                    {
                        $cart[$session]['quantity'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
        }
        return redirect()->back()->with('message','Cập nhật số lượng sản phẩm thành công');
    }
    public function delete_cart($session_id)
    {
        $cart = Session::get("cart");
        
        foreach($cart as $key => $val)
        {
            if($val['session_id'] == $session_id)
            {
                unset($cart[$key]);
            }
        }
        Session::put("cart",$cart);
        return redirect()->back()->with('message','Xóa sản phẩm thành công');
    }

    public function order()
    {
        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand = DB::table('tbl_brand')->get();
        return view("admin.order.index_checkout")->with('all_category_product',$all_category_product)->with('all_brand',$all_brand);
    }
}
