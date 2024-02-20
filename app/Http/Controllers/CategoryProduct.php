<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryProduct extends Controller
{
    //
    public function add_category_product()
    {
        return view('admin.category_product.add_category_product');
    }
    public function all_category_product()
    {
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.category_product.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.category_product.all_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->name_category;
        $data['category_desc'] = $request->description_category;
        $data['category_status'] = $request->hide_category;
        $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString()    ;
        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm danh mục thành công');
        return Redirect::to('add-category-product');
    }
    public function active_category_product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message',"Hide success");
        return Redirect::to('all-category-product');
    }
    public function unactive_category_product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message',"Present success");
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.category_product.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.category_product.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id)
    {
        $data = array();
        $data['category_name'] = $request->name_category;
        $data['category_desc'] = $request->description_category;
        $data['category_status'] = $request->hide_category;
        $data['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString()    ;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message', 'Chỉnh sửa danh mục thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message', 'Xóa danh mục thành công');
        return Redirect::to('all-category-product');
    }
}
