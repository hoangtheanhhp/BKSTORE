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
        $phones = Products::Join('pro_details','products.id','=',
        'pro_details.pro_id')->
        select('products.*','pro_details.screen as screen',
        'pro_details.os as os','pro_details.cpu as cpu',
        'pro_details.cam1 as cam1',
        'pro_details.cam2 as cam2',
        'pro_details.storage as rom',
        'pro_details.pin as pin',
        'pro_details.sim as sim')->distinct()->paginate(15);
        $category = Category::all();
        $phone_sell =Products::Join('pro_details','products.id','=',
        'pro_details.pro_id')->
        select('products.*','pro_details.screen as screen',
        'pro_details.os as os','pro_details.cpu as cpu',
        'pro_details.cam1 as cam1',
        'pro_details.cam2 as cam2',
        'pro_details.storage as rom',
        'pro_details.pin as pin',
        'pro_details.sim as sim')->orderBy('sell_number','desc')->distinct()->get();
        $phone_view = Products::orderBy('viewed_number','desc')->get();
        $news = News::orderBy('created_at','desc')->paginate(3);
        return view('front-end.home',['slides'=>$slides,
            'phones'=>$phones,
            'category' => $category,
            'phone_views' => $phone_view,
            'phone_sells' => $phone_sell,
            'news' => $news
        ])
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }
    public function addcart($id, Request $request)
    {
        $pro = Products::find($id);
        if($request->qty == null) $request->qty = 1;
          Cart::add(['id' => $pro->id, 'name' => $pro->name, 'qty' => $request->qty, 'price' => $pro->price,'options' => ['img' => $pro->images]]);
        return redirect()->route('getcart');
    }
    public function getupdatecart(Request $request)
    {
        $updateItems = json_decode($request->items);
        $cart = Cart::content();
        $index = 0;
        foreach ($cart as $item) {
            Cart::update($item->rowId, intval($updateItems[$index]->quantity));
            $index++;
        }
        $data = $this->infoCart();
        return response()->json($data);
    }
    public function getdeletecart(Request $request)
    {
        Cart::remove($request->id);
        $data = $this->infoCart();
        return response()->json($data);
    }
    public function getcart()
    {
        $phone_relate = array();
        $cart = Cart::content();
        foreach($cart as $c) {
            array_push($phone_relate,Products::Join('pro_details','products.id','=','pro_details.pro_id')->select('products.*','pro_details.screen as screen','pro_details.os as os','pro_details.cpu as cpu')->find($c->id));    
        }
        $total = Cart::subtotal();
        $subtotal = Cart::subtotal();
        return view ('front-end.modules.cart',['phone'=>$phone_relate,'cart'=>$cart,'total'=>$total,'subtotal'=>$subtotal]);
    }

    public function infoCart()
    {
        $data = array(
            'subtotal' => Cart::subtotal(),
            'tax' => Cart::tax(),
            'total' => Cart::total(),
            'count' => Cart::count()
        );
        return $data;
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

        $total = Cart::subtotal();
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
        return redirect()->route('home')
            ->with(['flash_level'=>'result_msg','flash_massage'=>' Đơn hàng của bạn đã được gửi đi !']);
    }

    public function getNews() {
      $news = News::orderBy('created_at','desc')->paginate(5);
      return view('front-end.modules.blog',['news'=>$news]);
    }
   
    public function getNewsDetail($id) {
      $new = News::find($id);
      $next = News::where('id','>',$id)->max('id');
      $prev = News::where('id','<',$id)->min('id');     
      if (!isset($next)) { $next=$id; }
      if (!isset($prev)) { $prev=$id; }
      
      return view('front-end.modules.blog_detail',['new'=>$new, 'next' => $next, 'prev' => $prev]);
    }
   
    public function getProducts($id = null) {
        $products1 = Products::Join('pro_details','products.id','=',
        'pro_details.pro_id')->
        select('products.*','pro_details.screen as screen',
        'pro_details.os as os','pro_details.cpu as cpu',
        'pro_details.cam1 as cam1',
        'pro_details.cam2 as cam2',
        'pro_details.storage as rom',
        'pro_details.pin as pin',
        'pro_details.sim as sim')->distinct()->latest()->paginate(20);
        $cart = Cart::content();
        $cat= Category::all();
        if ($id != 'null' && $id != 'all') {
            $products = Products::Join('pro_details','products.id','=',
        'pro_details.pro_id')->
        select('products.*','pro_details.screen as screen',
        'pro_details.os as os','pro_details.cpu as cpu',
        'pro_details.cam1 as cam1',
        'pro_details.cam2 as cam2',
        'pro_details.storage as rom',
        'pro_details.pin as pin',
        'pro_details.sim as sim')->where('cat_id','=',$id)->distinct()->orderby('id')->paginate(20);
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
        $img_detail = DB::table('detail_img')->where('pro_id','=',$id)->get();
        $phone_info = Pro_details::where('pro_id','=',$id)->first();
        $cart = Cart::content();
        $phoneIphone = Products::find($id)->where('cat_id', '=', $phone->cat_id)->orderBy('price')->get();
        $phone_recently = Products::latest()->paginate(5);
        $review = Review::where('status','>',0)->orderBy('created_at')->paginate(5);
        $phone_relate = Products::Join('pro_details','products.id','=','pro_details.pro_id')->select('products.*','pro_details.screen as screen','pro_details.os as os','pro_details.cpu as cpu')->where('cat_id',$phone->cat_id)->distinct()->orderby('created_at','DESC')->paginate(5);
        return view('front-end.modules.detail',[
            'phone'=>$phone,
            'img_detail' => $img_detail,
            'phone_info' => $phone_info,
            'phoneIphone' => $phoneIphone,
            'cart' => $cart,
            'phone_recently' => $phone_recently,
            'reviews' => $review,
            'phone_relate' => $phone_relate
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
