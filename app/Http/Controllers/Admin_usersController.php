<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Admin_users;

class Admin_usersController extends Controller
{
    public function getlist()
   {
   	$data = Admin_users::paginate(10);
    	return view('back-end.admin_mem.list',['data'=>$data]);

   }

    public function getdel($id)
   {
        Admin_users::find($id)->delete();
        return redirect()->action('Admin_usersController@getlist')
                ->with('success','Staff deleted successfully');
   }

   
}
