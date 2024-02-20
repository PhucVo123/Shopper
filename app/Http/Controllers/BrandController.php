<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function add_brand()
    {
        return view('admin.brand.add_brand');
    }
    public function all_brand()
    {
        $all_brand = DB::table('tbl_brand')->get();
        $manager_brand = view('admin.brand.all_brand')->with('all_brand',$all_brand);
        return view('admin_layout')->with('admin.brand.all_brand', $manager_brand);
    }
    public function save_brand(Request $request)
    {
        $data = array();
        $data['brand_name'] = $request->name_brand;
        $data['brand_desc'] = $request->description_brand;
        $data['brand_status'] = $request->hide_brand;
        $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString()    ;
        DB::table('tbl_brand')->insert($data);
        Session::put('message', 'Thêm thương hiệu thành công');
        return Redirect::to('add-brand');
    }
    public function active_brand($brand_id)
    {
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
        Session::put('message',"Hide success");
        return Redirect::to('all-brand');
    }
    public function unactive_brand($brand_id)
    {
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
        Session::put('message',"Present success");
        return Redirect::to('all-brand');
    }
    public function edit_brand($brand_id)
    {
        $edit_brand = DB::table('tbl_brand')->where('brand_id',$brand_id)->get();
        $manager_brand = view('admin.brand.edit_brand')->with('edit_brand',$edit_brand);
        return view('admin_layout')->with('admin.brand.edit_brand', $manager_brand);
    }
    public function update_brand(Request $request, $brand_id)
    {
        $data = array();
        $data['brand_name'] = $request->name_brand;
        $data['brand_desc'] = $request->description_brand;
        $data['brand_status'] = $request->hide_brand;
        $data['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString()    ;
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update($data);
        Session::put('message', 'Chỉnh sửa thương hiệu thành công');
        return Redirect::to('all-brand');
    }
    public function delete_brand($brand_id)
    {
        DB::table('tbl_brand')->where('brand_id',$brand_id)->delete();
        Session::put('message', 'Xóa thương hiệu thành công');
        return Redirect::to('all-brand');
    }
}
