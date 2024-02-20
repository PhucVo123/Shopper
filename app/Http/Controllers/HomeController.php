<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderBy('tbl_product.product_id','desc')->get();

        $all_category_product = DB::table('tbl_category_product')->get();

        $all_brand = DB::table('tbl_brand')->get();
        
        return view('pages.homes')->with('all_category_product',$all_category_product)->with('all_brand',$all_brand)->with('all_product',$all_product);
    }
    public function category($category_name , $category_id)
    {
        $all_product_cate = DB::table('tbl_product')
        ->where('tbl_product.category_id',$category_id)->get();

        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand = DB::table('tbl_brand')->get();
        return view('pages.get_category')->with('all_product_cate',$all_product_cate)->with('name_category',$category_name)->with('all_brand',$all_brand)->with('all_category_product',$all_category_product);
    }

}
