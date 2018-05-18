<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin_users;
use App\Http\Requests;
use DB;

class AdminController extends Controller
{
   public function home()
   {
   	echo "home";
   }

   public function create(Request $request)
    {

        DB::table('admin_users')->insert(
        		array(
        					'name' => $request->name,
        					'email' => $request->email,
        					'password' => $request->password,
        					'level' => '2'
        		)
        	);
        return view('back-end.auth.login')
                        ->with('success','Staff created successfully');
    }
}
