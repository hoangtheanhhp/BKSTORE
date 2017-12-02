<?php

namespace App\Http\Controllers;

use function bcrypt;
use Illuminate\Http\Request;

use App\Admin_users;
use function redirect;

class Admin_usersController extends Controller
{
    public function getlist()
   {
   	$data = Admin_users::paginate(10);
    	return view('back-end.admin_mem.list',['data'=>$data]);
   }

   public function register(Request $request)
   {
       $admin = new Admin_users();
       $admin->name = $request->name;
       $admin->email = $request->email;
       $admin->password = bcrypt($request->password);
       $admin->level = 2;
       $admin->save();
       return redirect('admin/nhanvien')->with(['Create Staff Successfully!!']);
   }
    public function getdel($id)
   {
        Admin_users::find($id)->delete();
        return redirect()->action('Admin_usersController@getlist')
                ->with('success','Staff deleted successfully');
   }

   public function getEdit($id){
       $data = Admin_users::where('id',$id)->first();
       return view('back-end.users.edit',['data'=>$data]);
   }

   public function postEdit(Request $request, $id)
   {
        $admin = Admin_users::where('id','=',$id)->first();
        if($admin->level != 1)
            $admin->level = $request->level;
        else
            $admin->level = 1;
        $admin->name = $request->txtName;
        $admin->update();
        return redirect('admin/nhanvien')->with(['success' => 'Create Staff Successfully!!']);
   }
}
