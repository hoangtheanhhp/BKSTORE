<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Products;
use App\Category;
use App\Pro_details;
use App\News;
use App\Oders;
use App\Slide;
use App\Oders_detail;
use App\Detail_img;
use DB,Cart,Datetime;
use App\User;
class PagesController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        $phones = Products::latest()->paginate(5);
        return view('front-end.home',['slides'=>$slides, 'phones'=>$phones])->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function addcart($id, Request $request)
    {
        $pro = Products::find($id);
          Cart::add(['id' => $pro->id, 'name' => $pro->name, 'qty' => $request->qty, 'price' => $pro->price,'options' => ['img' => $pro->imagestext]]);

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
        $cart = Cart::content();
        return view ('front-end.modules.cart',['cart'=>$cart]);
    }
    public function getoder()
    {
        $cart = Cart::content();
        return view ('front-end.modules.checkout',['cart'=>$cart]);
    }
    public function postoder(Request $request)
    {
        $u = User::where('email',$request->email)->first();
        if (is_null($u)) {
          $user = new User();
          $user->name = $request->name;
          $user->email = $request->email;
          $user->phone = $request->phone;
          $user->address = $request->address;
          $user->save();
        }
        $oder = new Oders();
        $total =0;
        foreach (Cart::content() as $row) {
            $total = $total + ( $row->qty * $row->price);
        }
        $oder->c_id = $user->id;
        $oder->qty = Cart::count();
        $oder->sub_total = floatval($total);
        $oder->total =  floatval($total);
        $oder->status = 0;
        $oder->type = $request->payment_method;
        $oder->save();
        $o_id =$oder->id;
        foreach (Cart::content() as $row) {
            $detail = new Oders_detail();
            $detail->pro_id = $row->id;
            $detail->qty = $row->qty;
            $detail->o_id = $o_id;
            $detail->save();
        }
        Cart::destroy();
        return redirect()->route('getcart')
            ->with(['flash_level'=>'result_msg','flash_massage'=>' Đơn hàng của bạn đã được gửi đi !']);
    }

    public function getNews() {
      $news = News::join('admin_users','news.user_id','=','admin_users.id')->select('news.*','admin_users.name')->orderBy('created_at','desc')->paginate(3);
      return view('front-end.modules.blog',['news'=>$news]);
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
        $products = Products::latest()->paginate(10);
        return view('front-end.modules.shop',['products'=>$products]);
    }
    public function getDetail($id) {
        $phone = Products::find($id);
        $phone_detail = DB::table('detail_img')->where('pro_id',$id)->get();
        $phone_info = Pro_details::find($id);
        return view('front-end.modules.detail',['phone'=>$phone,
                                                      'phone_detail'=>$phone_detail,
                                                      'phone_info' => $phone_info
        ]);
    }
}
