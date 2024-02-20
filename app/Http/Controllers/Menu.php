<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Menu extends Controller
{
    //
    public function menu()
    {
        return view('admin.menu.menu');
    }

    public function add_menu()
    {
        return view('admin.menu.add_menu');
    }
    public function add_sub_menu()
    {
        return view('admin.menu.add_sub_menu');
    }
}
