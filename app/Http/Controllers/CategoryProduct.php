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
        $all_category_product = DB::table('tbl_category_product')->get();
        return view('admin.category_product.add_category_product')->with(compact('all_category_product'));
    }
    public function convert_meta($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }
    public function all_category_product()
    {
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.category_product.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.category_product.all_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request)
    {
        
        $meta = str_replace(" ","-",strtolower($this->convert_meta($request->name_category)));
        $data = array();
        $data['category_name'] = $request->name_category;
        $data['category_desc'] = $request->description_category;
        $data['category_status'] = $request->hide_category;
        $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
        $data['category_id_parent'] =  $request->category_id_parent;
        $data['meta'] = $meta;

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
        $meta = str_replace(" ","-",strtolower($this->convert_meta($request->name_category)));
        $data = array();
        $data['category_name'] = $request->name_category;
        $data['category_desc'] = $request->description_category;
        $data['category_status'] = $request->hide_category;
        $data['meta'] = $meta;
        $data['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
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
