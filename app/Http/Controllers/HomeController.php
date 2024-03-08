<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderBy('tbl_product.product_id','desc')->get();

        $all_category_product = DB::table('tbl_category_product')->where('category_id_parent',null)->get();

        $all_brand = DB::table('tbl_brand')->get();
        
        return view('pages.homes')->with('all_category_product',$all_category_product)
        ->with('all_brand',$all_brand)->with('all_product',$all_product);
    }
    public function category($category_meta , $category_id)
    {
        $all_product_cate = DB::table('tbl_product')
        ->where('tbl_product.category_id',$category_id)->get();

        $all_category_product = DB::table('tbl_category_product')->where('category_id_parent',null)->get();
        $all_brand = DB::table('tbl_brand')->get();
        $name_category = DB::table('tbl_category_product')->where('category_id',$category_id)->value('category_name');

        return view('pages.get_category')->with(compact('all_product_cate','name_category','all_category_product','all_brand'));

    }
    public function login()
    {
        return view('login.login');
    }
    public function save_login(Request $request)
    {

        $username = $request->username;
        $get_user = DB::table('users')->where('name',$username)->count();
            
        if($get_user > 0)
        {
            $password = $request->pwd;
            $check_user = DB::table('users')->where('password',md5($password))->count();
            if($check_user > 0)
            {
                Session::put('username', $username);
                $all_category_product = DB::table('tbl_category_product')->where('category_id_parent',null)->get();
                $all_brand = DB::table('tbl_brand')->get();
                return redirect("trang_chu")->with(compact('all_category_product','all_brand'));
            }
            else
            {
                $message = "Username or password was wrong";
                Session::put('message_login', $message);
                return redirect()->back();
            }
        }
        else
        {
            $message = "Username or password was wrong";
            Session::put('message_login', $message);
            return redirect()->back();
        }

    }
    public function save_logup(Request $request)
    {
        $username = $request->username;
        $get_user = DB::table('users')->where('name',$username)->count();
            
        if($get_user > 0)
        {
            $message = "Account is existed";
            Session::put('message_logup', $message);
        }
        else
        {
            $data = array();
            $data["name"] = $username;
            $data["password"] = md5($request->pwd);
            $data["email"] = $request->email;
            DB::table('users')->insert($data);
            Session::put('username', $data["name"]);
        }
        return redirect()->back();
    }
    public function logout()
    {
        Session::forget('username');
        $all_category_product = DB::table('tbl_category_product')->where('category_id_parent',null)->get();
        $all_brand = DB::table('tbl_brand')->get();
        return redirect("trang_chu")->with('all_category_product',$all_category_product)->with('all_brand',$all_brand);
    }


}
