<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Comment;
class ProductController extends Controller
{
    public function add_product()
    {
        $category_product = DB::table('tbl_category_product')->orderBy("category_id","desc")->get();
        $brand = DB::table('tbl_brand')->orderBy("brand_id","desc")->get();

        return view('admin.product.add_product')->with('category_product',$category_product)->with('brand',$brand);
    }
    public function all_product()
    {
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderBy('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.product.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.product.all_product', $manager_product);
    }
    public function save_product(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->name_product;
        $data['product_content'] = $request->content_product;
        $data['product_price'] = $request->price_product;
        $data['product_desc'] = $request->description_product;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->hide_product;
        $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
        $get_image = $request->file('img_product');

        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.'_'.date('Ymd_His').'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_img'] = $new_image;
        }
        else
        {
            $data['product_img'] = '';
        }
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm thương hiệu thành công');
        return Redirect::to('add-product');
    }
    public function active_product($product_id)
    {
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message',"Hide success");
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id)
    {
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message',"Present success");
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $category_product = DB::table('tbl_category_product')->orderBy("category_id","desc")->get();
        $brand = DB::table('tbl_brand')->orderBy("brand_id","desc")->get();
        $manager_product = view('admin.product.edit_product')->with('edit_product',$edit_product)->with('category_product',$category_product)->with('brand',$brand);
        return view('admin_layout')->with('admin.product.edit_product', $manager_product);
    }
    public function update_product(Request $request, $product_id)
    {
        $data = array();
        $data['product_name'] = $request->name_product;
        $data['product_content'] = $request->content_product;
        $data['product_price'] = $request->price_product;
        $data['product_desc'] = $request->description_product;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->hide_product;
        $data['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
        $get_image = $request->file('img_product');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.'_'.date('Ymd_His').'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_img'] = $new_image;
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Chỉnh sửa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id)
    {
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function detail_product($product_id)
    {
        $get_product = DB::table('tbl_product')
        ->where('tbl_product.product_id',$product_id)->get();

        $cate_id = $get_product[0]->category_id;

        $all_category_product = DB::table('tbl_category_product')->get();

        $all_brand = DB::table('tbl_brand')->get();

        $related_product = DB::table('tbl_product')
        ->where('tbl_product.category_id',$cate_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        
        $rating = DB::table('tbl_order_detail')->where('orderdetail_id_product',$product_id)
        ->join('tbl_rating','tbl_rating.orderdetail_id','=','tbl_order_detail.orderdetail_id')->get();
        $rating_star = DB::table('tbl_order_detail')->where('orderdetail_id_product',$product_id)
        ->join('tbl_rating','tbl_rating.orderdetail_id','=','tbl_order_detail.orderdetail_id')->avg('rating_star');

        $rating_star = round($rating_star);

        return view('admin.product.detail_product')->with('all_category_product',$all_category_product)->with('all_brand',$all_brand)->with('get_product',$get_product)->with('related_product',$related_product)
        ->with('rating',$rating)->with('rating_star',$rating_star);
    }

    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = DB::table('tbl_comment')->where('product_id',$product_id)->where('comment_status',1)->where('comment_id_reply',null)->get();
        $comment_by_admin = DB::table('tbl_comment')->where('comment_id_reply','!=',null)->get();
        $output = '';
        foreach($comment as $key => $comm)
        {
            
            $output.='
            <div class="row style_comment" style="margin-bottom:10px">
                <div class="col-md-2">
                    <img width="100%" src="https://nhanhoa.com/uploads/news/no-avatar.png" class="img img-responsive img-thumbnail" width="100px">
                </div>
                <div class="col-md-10">
                    <p style="color:green;">'.$comm->comment_name.'</p>
                    <p style="color:black;">'.$comm->comment_date.'</p>
                    <p>'.$comm->comment_content.'</p>
                </div>
            </div>';
            foreach($comment_by_admin as $key => $admin)    
            {
                if($comm->comment_id == $admin->comment_id_reply)
                {
                    $output.='
                    <div class="row style_comment" style="margin-bottom:10px">
                        <div class="col-md-2">
                            <img width="100%" src="https://nhanhoa.com/uploads/news/no-avatar.png" class="img img-responsive img-thumbnail" width="100px">
                        </div>
                        <div class="col-md-10">
                            <p style="color:green;">'.$admin->comment_name.'</p>
                            <p style="color:black;">'.$admin->comment_date.'</p>
                            <p>'.$admin->comment_content.'</p>
                        </div>
                    </div>';
                }
            }
            
        }
        echo $output;
    }
    public function send_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment_email = $request->comment_email;
        $comment = new Comment();
        $comment->comment_name = $comment_name;
        $comment->comment_email = $comment_email;
        $comment->comment_content = $comment_content;
        $comment->product_id = $product_id;
        $comment->save();    
    }
    public function all_comment()
    {
        $all_comment = DB::table('tbl_comment')
        ->join('tbl_product','tbl_comment.product_id','=','tbl_product.product_id')->where('comment_id_reply',null)
        ->orderBy('tbl_comment.comment_id','desc')->get();
        $comment_by_admin = DB::table('tbl_comment')->where('comment_id_reply','!=',null)->get();
        $manager_comment = view('admin.comment.all_comment')->with('all_comment',$all_comment)->with('comment_admin',$comment_by_admin);
        return view('admin_layout')->with('admin.comment.all_comment', $manager_comment);
    }
    public function confirm_comment(Request $request)
    {
        $confirm_id = $request->comment_id;
        $confirm_status = $request->comment_status;
        $comment = Comment::find($confirm_id);
        $comment->comment_status = $confirm_status;
        $comment->save();
    }
    public function reply_comment(Request $request)
    {
        $comment_id = $request->comment_id;
        $product_id = $request->product_id;
        $comment_content= $request->comment_content;
        $comment = new Comment();
        $comment->comment_name = "ADMIN";
        $comment->comment_content = $comment_content;
        $comment->product_id = $product_id;
        $comment->comment_status= 1;
        $comment->comment_id_reply = $comment_id;
        $comment->save();
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $url = '/result-search'.'/'.$search;
        return Redirect::to($url);

    }
    public function result_search($keyword)
    {
        $pro = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand = DB::table('tbl_brand')->get();
        return view("admin.product.search")->with("all_product",$pro)->with('all_category_product',$all_category_product)->with('all_brand',$all_brand);
    }
}
