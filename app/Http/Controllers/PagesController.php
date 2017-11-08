<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Products;
use App\Category;
use App\Pro_detail;
use App\News;
use App\Oders;
use App\Slide;
use App\Oders_detail;
use DB,Cart,Datetime;
class PagesController extends Controller
{
    public function index()
    {
        // mobile
        // $mobile = DB::table('products')
        //         ->join('category', 'products.cat_id', '=', 'category.id')
        //         ->join('pro_details', 'pro_details.pro_id', '=', 'products.id')
        //         ->where('category.parent_id','=','1')
        //         ->select('products.*','pro_details.cpu','pro_details.ram','pro_details.screen','pro_details.vga','pro_details.storage','pro_details.exten_memmory','pro_details.cam1','pro_details.cam2','pro_details.sim','pro_details.connect','pro_details.pin','pro_details.os','pro_details.note')
        //         ->paginate(9);
        // $lap = DB::table('products')
        //         ->join('category', 'products.cat_id', '=', 'category.id')
        //         ->join('pro_details', 'pro_details.pro_id', '=', 'products.id')
        //         ->where('category.parent_id','=','2')
        //         ->select('products.*','pro_details.cpu','pro_details.ram','pro_details.screen','pro_details.vga','pro_details.storage','pro_details.exten_memmory','pro_details.cam1','pro_details.cam2','pro_details.sim','pro_details.connect','pro_details.pin','pro_details.os','pro_details.note')
        //         ->paginate(6);
        // $pc = DB::table('products')
        //         ->join('category', 'products.cat_id', '=', 'category.id')
        //         ->join('pro_details', 'pro_details.pro_id', '=', 'products.id')
        //         ->where('category.parent_id','=','19')
        //         ->select('products.*','pro_details.cpu','pro_details.ram','pro_details.screen','pro_details.vga','pro_details.storage','pro_details.exten_memmory','pro_details.cam1','pro_details.cam2','pro_details.sim','pro_details.connect','pro_details.pin','pro_details.os','pro_details.note')
        //         ->paginate(4);
        $slides = Slide::all();
        $phones = Products::all();
        return view('front-end.home',['slides'=>$slides, 'phones'=>$phones]);
    }
    public function addcart($id, Request $request)
    {
        $pro = Products::where('id',$id)->first();
        Cart::add(['id' => $pro->id, 'name' => $pro->name, 'qty' => $request->qty, 'price' => $pro->price,'options' => ['img' => $pro->images]]);
        return redirect()->route('getcart');
    }
    public function getupdatecart($id,Request $request)
    {
        if ($dk=='up') {
            $qt = $qty+1;
            Cart::update($id, $qt);
            return redirect()->route('getcart');
        } elseif ($dk=='down') {
            $qt = $qty-1;
            Cart::update($id, $qt);
            return redirect()->route('getcart');
        } else {
            return redirect()->route('getcart');
        }
    }
    public function getdeletecart($id)
    {
        Cart::remove($id);
        return redirect()->route('getcart');
    }
    public function xoa()
    {
        Cart::destroy();
        return redirect()->route('index');
    }
    public function getcart()
    {
        return view ('front-end.modules.cart');
    }
    public function getoder()
    {
        return view ('front-end.modules.checkout');
    }
    public function postoder(Request $rq)
    {
        $oder = new Oders();
        $total =0;
        foreach (Cart::content() as $row) {
            $total = $total + ( $row->qty * $row->price);
        }
        $oder->c_id = Auth::user()->id;
        $oder->qty = Cart::count();
        $oder->sub_total = floatval($total);
        $oder->total =  floatval($total);
        $oder->note = $rq->txtnote;
        $oder->status = 0;
        $oder->type = 'cod';
        $oder->created_at = new datetime;
        $oder->save();
        $o_id =$oder->id;
        foreach (Cart::content() as $row) {
            $detail = new Oders_detail();
            $detail->pro_id = $row->id;
            $detail->qty = $row->qty;
            $detail->o_id = $o_id;
            $detail->created_at = new datetime;
            $detail->save();
        }
        Cart::destroy();
        return redirect()->route('getcart')
            ->with(['flash_level'=>'result_msg','flash_massage'=>' Đơn hàng của bạn đã được gửi đi !']);
    }
    public function getcate($cat)
    {
        if ($cat == 'mobile') {
            // mobile
            $mobile = DB::table('products')
                ->join('category', 'products.cat_id', '=', 'category.id')
                ->join('pro_details', 'pro_details.pro_id', '=', 'products.id')
                ->where('category.parent_id','=','1')
                ->select('products.*','pro_details.cpu','pro_details.ram','pro_details.screen','pro_details.vga','pro_details.storage','pro_details.exten_memmory','pro_details.cam1','pro_details.cam2','pro_details.sim','pro_details.connect','pro_details.pin','pro_details.os','pro_details.note')
                ->paginate(12);
            return view('category.mobile',['data'=>$mobile]);
        }
        elseif ($cat == 'laptop') {
            // mobile
            $lap = DB::table('products')
                ->join('category', 'products.cat_id', '=', 'category.id')
                ->join('pro_details', 'pro_details.pro_id', '=', 'products.id')
                ->where('category.parent_id','=','2')
                ->select('products.*','pro_details.cpu','pro_details.ram','pro_details.screen','pro_details.vga','pro_details.storage','pro_details.exten_memmory','pro_details.cam1','pro_details.cam2','pro_details.sim','pro_details.connect','pro_details.pin','pro_details.os','pro_details.note')
                ->paginate(12);
            return view('category.laptop',['data'=>$lap]);
        }
        elseif ($cat == 'pc') {
            // mobile
            $pc = DB::table('products')
                ->join('category', 'products.cat_id', '=', 'category.id')
                ->join('pro_details', 'pro_details.pro_id', '=', 'products.id')
                ->where('category.parent_id','=','19')
                ->select('products.*','pro_details.cpu','pro_details.ram','pro_details.screen','pro_details.vga','pro_details.storage','pro_details.exten_memmory','pro_details.cam1','pro_details.cam2','pro_details.sim','pro_details.connect','pro_details.pin','pro_details.os','pro_details.note')
                ->paginate(8);
            return view('category.pc',['data'=>$pc]);
        }
        elseif ($cat == 'tin-tuc') {
            $new =  DB::table('news')
                ->orderBy('created_at', 'desc')
                ->paginate(3);
            $top1 = $new->shift();
            $all =  DB::table('news')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
            return view('category.news',['data'=>$new,'hot1'=>$top1,'all'=>$all]);
        }
        // else{
        //     return redirect()->route('index');
        // }
    }
    public function detail($cat,$id,$slug)
    {
        if ($cat =='tin-tuc') {
            $new = News::where('id',$id)->first();
            return view('detail.news',['data'=>$new,'slug'=>$slug]);
        } elseif ($cat =='mobile') {
            $mobile = Products::where('id',$id)->first();
            if (empty($mobile)) {
                return view ('errors.503');
            } else {
                return view ('detail.mobile',['data'=>$mobile,'slug'=>$slug]);
            }
        }
        elseif ($cat =='laptop') {
            $lap = Products::where('id',$id)->first();
            if (empty($lap)) {
                return redirect()->route('index');
            } else {
                return view ('detail.laptop',['data'=>$lap,'slug'=>$slug]);
            }
        }
        elseif ($cat =='pc') {
            $pc = Products::where('id',$id)->first();
            if (empty($pc)) {
                return redirect()->route('index');
            } else {
                return view ('detail.pc',['data'=>$pc,'slug'=>$slug]);
            }
        } else {
            return redirect()->route('index');
        }
    }
    public function getProducts() {
        $products = Products::paginate(10);
        return view('front-end.modules.shop',['products'=>$products]);
    }
    public function getDetail($id) {
        $phone = Products::find($id);
        return view('front-end.modules.detail',['phone'=>$phone]);
    }
}
