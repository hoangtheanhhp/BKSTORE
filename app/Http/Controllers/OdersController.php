<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Oders;
use App\Oders_detail;
use DB;
use App\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;
class OdersController extends Controller
{
    public function getlist()
    {
    	$data = DB::table('oders')->orderby('status')->paginate(10);
    	$data = Oders::latest()->paginate(10);
    	return view('back-end.oders.list',['data'=>$data]);
    }

    public function getdetail($id)
    {
    	$oder = Oders::where('id',$id)->first();
    	$data = DB::table('oders_detail')
    			 	->join('products', 'products.id', '=', 'oders_detail.pro_id')
    			 	->where('o_id',$id)
    			 	->get();
    	return view('back-end.oders.detail',['data'=>$data,'oder'=>$oder]);
    }
    public function postdetail($id)
    {
    	$oder = Oders::find($id);
    	if($oder->status == 1) return back()->withErrors('Đơn hàng này đã được xác nhận rồi!!');
        $oderDetail = Oders_detail::where('o_id','=',$id)->get();
        $admin = Auth::guard('admin')->user();
        Mail::send('emails.active', ['oder' => $oder, 'oderDetail' => $oderDetail], function ($m) use ($oder)
        {
            $m->to($oder->user->email)->subject('Accept your Order!!');
        });
        $oder->admin_id = $admin->id;
        $oder->status = 1;
        $oder->save();
        foreach($oderDetail as $od)
        {
            $pro = Products::find($od->pro_id);
            $pro->number = $pro->number - $od->qty;
            $pro->sell_number += $od->qty;
            if($pro->number == 0) $pro->status = 0;
            $pro->save();
        }

    	return redirect('admin/donhang')
      	->with(['flash_level'=>'result_msg','flash_massage'=>' Đã xác nhận đơn hàng thành công !']);    	

    }
     public function getdel($id)
    {       
    	$oder = Oders::where('id',$id)->first();
    	if ($oder->status ==1) {
    		return redirect()->back()->withErrors('Không thể hủy được vì đơn hàng đã được xác nhận!!');
    	} else {
    		$oder = Oders::find($id);
        	$oder->delete();
        	return redirect('admin/donhang')
         	->with(['flash_level'=>'result_msg','flash_massage'=>'Đã hủy bỏ đơn hàng số:  '.$id.' !']);
     	}
    }
}
