<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin_login');
    }
    public function home_admin()
    {
        return view('admin_layout');
    }
    public function insert_account(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        
        $check_account = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($check_account)
        {
            Session::put('admin_name', $check_account->admin_name);
            Session::put('admin_id', $check_account->admin_id);
            
            return Redirect::to('/dasboard');
        }
        else
        {
            Session::put('message','Email or Password is not correct');
            return Redirect::to('/admin');
        }
        
        // DB::table('tbl_admin')->insert(
        //     ['admin_email' => $admin_email, 'admin_password' => $admin_password, 'admin_name' => $admin_name, 'admin_phone' => $admin_phone]
        // );
        
    }
    public function logout()
    {
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
