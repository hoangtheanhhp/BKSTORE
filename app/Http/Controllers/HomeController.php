<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Oders;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oder = DB::table('oders')->where('c_id','=',Auth::user()->id)->get();
        // print_r($oder); exit();
        return view('member.user',['data'=>$oder]);
    }
    public function edit()
   {
        $id = Auth::user()->id;
        $data = User::where('id',$id)->first();
        return view('member.edit',['data'=>$data]);
   }
}
