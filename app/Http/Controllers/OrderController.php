<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function checkout(Request $request) 
    {
        $data["order_username"] = $request->username;
        $data["order_address"] = $request->address;
        $data["order_phone"] = $request->phone;
        $data["order_email"] = $request->email;
        $data["order_message"] = $request->message;
        $data["order_total"] = $request->total;
        $data["order_time"] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
        $data["order_status"] = 0;
        $data["order_id_user"] = $request->_user;
        if(!empty(Session::get("username")))
        {
            $check_order = DB::table('tbl_cart')->where('cart_user',Session::get("username"))->count();
            if($check_order > 0)
            {
                $order = DB::table('tbl_cart')->where('cart_user',Session::get("username"))->get();
                DB::table('tbl_order')->insert($data);
                foreach($order as $key => $val)
                {
                    $order_detail["orderdetail_id_product"] = $val->cart_id_product;
                    $order_detail["orderdetail_id_order"] = DB::table('tbl_order')->max("order_id");
                    $order_detail["orderdetail_status"] = 0;
                    $order_detail["orderdetail_price"] = DB::table('tbl_product')->where('product_id',$val->cart_id_product)->value('product_price');
                    $order_detail["orderdetail_quantity"] = $val->quantity;
                    DB::table('tbl_order_detail')->insert($order_detail);
                }
                $order = DB::table('tbl_cart')->where('cart_user',Session::get("username"))->delete();
            }
            else
            {
                return redirect()->back()->with('message','Không có sản phẩm để thanh toán');
            }
            
            
        }
        else
        {
            $cart = Session::get("cart");
            if($cart == true)
            {
                DB::table('tbl_order')->insert($data);
                foreach($cart as $key => $val)
                {
                    $order_detail["orderdetail_id_product"] = $val['product_id'];
                    $order_detail["orderdetail_id_order"] = DB::table('tbl_order')->max("order_id");
                    $order_detail["orderdetail_status"] = 0;
                    $order_detail["orderdetail_quantity"] = $val['quantity'];
                    DB::table('tbl_order_detail')->insert($order_detail);
                }
                Session::forget('cart');
            }
            else
            {
                return redirect()->back()->with('message','Không có sản phẩm để thanh toán');
            }
            
        }
        return redirect("/trang_chu");
    }
    public function order_status()
    {
        $id = DB::table('users')->where('name',Session::get("username"))->value('id');
        $idOrder = DB::table('tbl_order')->where('order_id_user',$id)->get();
        $ordered = array();
        foreach($idOrder as $key => $val)
        {
           $order = DB::table('tbl_order_detail')->where('orderdetail_id_order',$val->order_id)->where('orderdetail_status_rating','!=','1')->get();
           foreach($order as $idPro=>$pro)
           {
                $product = DB::table('tbl_product')->where('product_id',$pro->orderdetail_id_product)->get();
                array_push($ordered, $product,$pro->orderdetail_quantity,$pro->orderdetail_status,$pro->orderdetail_id,$pro->orderdetail_price);
           }
        }
        //echo ($idOrder);
        // foreach($ordered[0] as $check)
        // {
        //     echo $check->product_name;
        // }
        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand = DB::table('tbl_brand')->get();
        return view("admin.orderStatus.index_orderStatus")->with('ordered',$ordered)
                                                            ->with('all_category_product',$all_category_product)
                                                            ->with('all_brand',$all_brand);
    }
    public function complete_order($pro_id)
    {
        DB::table('tbl_order_detail')->where('orderdetail_id',$pro_id)->update(['orderdetail_status'=>2]);
        return redirect()->back();
    }
    public function rating($pro_id)
    {
        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand = DB::table('tbl_brand')->get();
        return view("admin.orderStatus.index_rating")->with('all_category_product',$all_category_product)
        ->with('all_brand',$all_brand)->with('pro_id',$pro_id);
    }
    public function send_rating(Request $request)
    {
        $data = array();
        $data['rating_user'] = $request->rating_name;
        $data['rating_star'] = $request->rating;
        $data['rating_content'] = $request->rating_content;
        $data['orderdetail_id'] = $request->orderdetail_id;
        $data['order'] = DB::table('tbl_rating')->where('rating_user',$request->rating_name)->max('order')+1;
        $data['datebegin'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
        $data['rating_status'] = 1;
        DB::table('tbl_order_detail')->where('orderdetail_id',$request->orderdetail_id)->update(['orderdetail_status_rating'=>1]);
        DB::table('tbl_rating')->insert($data);

    }
    public function all_order()
    {
        $all_order = DB::table('tbl_order_detail')
                    ->join('tbl_order','tbl_order.order_id','=','tbl_order_detail.orderdetail_id_order')
                    ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.orderdetail_id_product')
                    ->orderBy('orderdetail_id','desc')
                    ->get();
        // echo $all_order;
        return view('admin.order.all_order')->with('all_order',$all_order);
    }
    public function confirm_shipping(Request $request)
    {
        $id = $request->orderdetail_id;
        DB::table('tbl_order_detail')->where('orderdetail_id',$id)->update(['orderdetail_status'=>1]);
    }
    public function delete_order(Request $request)
    {
        $id = $request->orderdetail_id;
        $order = DB::table('tbl_order_detail')->where('orderdetail_id',$id)->get();
        
        foreach($order as $key)
        {
            $check_order = $key->orderdetail_id_order;
            $quantity = $key->orderdetail_quantity;
            $id_pro = $key->orderdetail_id_product;
        }
        $num_order = DB::table('tbl_order_detail')->where('orderdetail_id_order',$check_order)->count();
        $price = DB::table('tbl_product')->where('product_id',$id_pro)->value('product_price');
        $total = DB::table('tbl_order')->where('order_id',$check_order)->value('order_total');
        if($num_order > 1)
        {
            DB::table('tbl_order_detail')->where('orderdetail_id',$id)->delete();
            DB::table('tbl_order')->where('order_id',$check_order)->update(['order_total' => $total - ($price * $quantity)]);
        }
        else
        {
            DB::table('tbl_order_detail')->where('orderdetail_id',$id)->delete();
            DB::table('tbl_order')->where('order_id',$check_order)->delete();
        }



    }
}
