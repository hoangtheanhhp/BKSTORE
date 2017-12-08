<?php
namespace App\Http\Controllers;
use App\message;
use App\Review;
use function bcrypt;
use function hasItem;
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
use Illuminate\Support\Facades\Mail;
use function is_array;
use function str_random;

class PagesController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        $phones = Products::latest()->paginate(15);
        $category = Category::all();
        $cart = Cart::content();
        $phone_sell = Products::orderBy('sell_number','desc')->get();
        $phone_view = Products::orderBy('viewed_number','desc')->get();
        return view('front-end.home',['slides'=>$slides,
            'phones'=>$phones,
            'category' => $category,
            'cart' => $cart,
            'phone_views' => $phone_view,
            'phone_sells' => $phone_sell,
        ])
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }
    public function addcart($id, Request $request)
    {
        $pro = Products::find($id);
        if($pro->promo1 != '') $pro->price = $pro->price - $pro->promo1/100 * $pro->price;
        if($request->qty == null) $request->qty = 1;
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
        $cart = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        return view ('front-end.modules.cart',['cart'=>$cart,'total'=>$total,'subtotal'=>$subtotal]);
    }
    public function getoder(Request $request)
    {
        $cart = Cart::content();
        if(count($request->all()) > 1)
            foreach($cart as $c)
               {
                   $id = $c->id;
                   Cart::update($c->rowId, $request[$id]);
               }
        foreach($cart as $c)
            {
                $products = Products::where('id','=',$c->id)->first();
               if($c->qty > $products->number)
                   return redirect()->action('PagesController@getcart')->withErrors($products->name.' not enough quantity for your oder!! Please input again!!');
            };
        if($cart->count() == 0)
            return redirect()->action('PagesController@getProducts', ['id' => 'all'])->withErrors('Please buy any things before checkout!!');

        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view ('front-end.modules.checkout',['cart'=>$cart,'total'=>$total,'subtotal'=>$subtotal]);
    }
    public function postoder(Request $request)
    {
        $cart = Cart::content();
        $u = User::where('email','=',$request->billing_email)->first();
        if (is_null($u)) {
          $user = new User();
          $user->name = $request->billing_last_name;
          $user->email = $request->billing_email;
          $user->phone = $request->billing_phone;
          $user->address = $request->billing_address_1;
          $user->status = 0;
          $user->password = bcrypt('123456');
          $user->save();
        }
        $oder = new Oders();
        $total =0;

        foreach (Cart::content() as $row) {
            $total = $total + ( $row->qty * $row->price);
        }
        if(is_null($u)) {
            $oder->c_id = $user->id;
        }
        else {
            $oder->c_id = $u->id;
        }
        $oder->qty = Cart::count();
        $oder->sub_total = floatval($total);
        $oder->total =  floatval($total);
        $oder->status = 0;
        $oder->note = '';
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
      $cart = Cart::content();
      return view('front-end.modules.blog',['news'=>$news, 'cart' => $cart]);
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
    public function getProducts($id = null) {
        $products1 = Products::latest()->paginate(20);
        $cart = Cart::content();
        $cat= Category::all();
        if ($id != 'null' && $id != 'all') {
            $products = Products::where('cat_id','=',$id)->orderby('id')->paginate(20);
            if($products->count() == 0)
                return view('front-end.modules.shop',['products'=>$products1, 'cart' => $cart, 'loai' => 'all', 'cat' => $cat])
                    ->withErrors('Category Not Exists!!');

            return view('front-end.modules.shop',['products'=> $products,'cart' =>$cart, 'cat'=>$cat,'loai'=>$id]);
        }
        return view('front-end.modules.shop',['products'=>$products1, 'cart' => $cart, 'loai' => 'all', 'cat' => $cat]);
    }

    public function searchProducts(Request $request) {
        $products = Products::where('name','like','%'.$request->search.'%')->paginate(20);
        $cart = Cart::content();
        $cat = Category::all();
        return view('front-end.modules.shop',['products'=>$products, 'cart' => $cart,'loai' => 'all', 'cat' => $cat]);
    }
    public function getDetail($id) {
        $phone = Products::find($id);
        $phone->viewed_number += 1;
        $phone->save();
        $phone_detail = DB::table('detail_img')->where('pro_id','=',$id)->get();
        $phone_info = Pro_details::where('pro_id','=',$id)->first();
        $cart = Cart::content();
        $phoneIphone = Products::find($id)->where('cat_id', '=', $phone->cat_id)->orderBy('price')->get();
        $phone_recently = Products::latest()->paginate(5);
        $review = Review::where('status','>',1)->orderBy('created_at')->paginate(5);
        return view('front-end.modules.detail',[
            'phone'=>$phone,
            'phone_detail'=>$phone_detail,
            'phone_info' => $phone_info,
            'phoneIphone' => $phoneIphone,
            'cart' => $cart,
            'phone_recently' => $phone_recently,
            'reviews' => $review
        ]);
    }

    public function message($id, Request $request)
    {
        if(!isset($request->rating))
             return back()->withErrors('Please rating for us!!');
        $review = new Review();
        $review->customer_name = $request->name;
        $review->customer_email = $request->email;
        $review->review = $request->review;
        $review->customer_rating = $request->rating;
        $review->pro_id = $id;
        $review->token = str_random(30);
        $review->save();
        Mail::send('emails.review',['review' => $review], function($m) use ($review) {
            $m->to($review->customer_email)->subject('Accept your review!!');
        });
        return back()->with(['success' => 'We have been received your review. We will check and active it as soon!! ']);
    }

    public function activeReview($id, $review_id, $token){
        $review = Review::where('id', '=', $review_id)->first();

        if($token == $review->token)
        {
            if($review->status == 0);
                $review->status = 1;
            $review->save();
            return redirect()->action('PagesController@getDetail',['id' => $id])->with(['success' => 'Active review Successfully!!']);
        }
        else return redirect()->action('PagesController@getDetail',['id' => $id])->withErrors('Can not active review!!');
    }
}
