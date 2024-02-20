<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
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
        $data["order_status"] = 1;
        $cart = Session::get("cart");
        if($cart == true)
        {
            DB::table('tbl_order')->insert($data);
            foreach($cart as $key => $val)
            {
                $order_detail["orderdetail_id_product"] = $val['product_id'];
                $order_detail["orderdetail_id_order"] = DB::table('tbl_order')->max("order_id");
                $order_detail["orderdetail_status"] = 1;
                $order_detail["orderdetail_quantity"] = $val['quantity'];
                DB::table('tbl_order_detail')->insert($order_detail);
            }
            
        }
        Session::forget('cart');
        return redirect("/trang_chu");
    }
}
