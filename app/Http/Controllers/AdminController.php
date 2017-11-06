<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin_users;
use App\Http\Requests;

class AdminController extends Controller
{
   public function home()
   {
   	echo "home";
   }

   public function create(Request $request)
    {
    	$request->level = 10;
        Admin_users::create($request->all());
        return redirect()->route('admin.login')
                        ->with('success','Student created successfully');
    }
}
