<?php

Route::auth();
// admin route
Route::get('admin/login', ['as'  => 'getlogin', 'uses' =>'Admin\AuthController@showLoginForm']);
Route::post('admin/login', ['as'  => 'postlogin', 'uses' =>'Admin\AuthController@login']);
Route::get('admin/password/reset', ['as'  => 'getreser', 'uses' =>'Admin\AuthController@email']);
Route::get('admin/getRegister',function(){
  return view('back-end.auth.register');
})->middleware('CheckAdmin');
Route::post('admin/register', 'Admin_usersController@register')->middleware('CheckAdmin');
Route::post('products/search', 'PagesController@searchProducts');

Route::get('admin/logout', ['as'  => 'getlogin', 'uses' =>'Admin\AuthController@logout']);

Route::get('/', ['as'  => 'index', 'uses' =>'PagesController@index']);
Route::get('products/{id}', ['as'  => 'getproducts', 'uses' =>'PagesController@getProducts']);
Route::get('detail/{id}', ['as'  => 'getdetail', 'uses' =>'PagesController@getDetail']);
Route::post('detail/{id}/message', 'PagesController@message');
Route::get('detail/{id}/{review_id}/{token}', 'PagesController@activeReview');
Route::get('blog',['as'=>'getblog','uses'=>'PagesController@getNews']);
Route::get('blog_detail/{id}',['as'=>'getblogdetail','uses'=>'PagesController@getNewsDetail']);

// cart - oder
Route::get('gio-hang', ['as'  => 'getcart', 'uses' =>'PagesController@getcart']);
// them vao gio hang
Route::get('gio-hang/addcart/{id}', ['as'  => 'getcartadd', 'uses' =>'PagesController@addcart']);
Route::get('gio-hang/update', ['as'  => 'getupdatecart', 'uses' =>'PagesController@getupdatecart']);
Route::get('gio-hang/delete', ['as'  => 'getdeletecart', 'uses' =>'PagesController@getdeletecart']);
// tien hanh dat hang

Route::get('dat-hang',  ['as'  => 'getoder', 'uses' =>'PagesController@getoder']);
Route::post('cart-dat-hang',  ['as'  => 'getoder', 'uses' =>'PagesController@getoder']);
Route::post('dat-hang', ['as'  => 'postoder', 'uses' =>'PagesController@postoder']);
// category
Route::get('/{cat}', ['as'  => 'getcate', 'uses' =>'PagesController@getcart']);
Route::get('/{cat}/{id}-{slug}', ['as'  => 'getdetail', 'uses' =>'PagesController@detail']);

Route::resource('payment', 'PayMentController');
// --------------------------------cac cong viec trong admin (back-end)---------------------------------------

Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin'], function () {
       	Route::get('/home', function() {
         return view('back-end.home');
       });
       // -------------------- quan ly danh muc----------------------
       	Route::group(['prefix' => 'danhmuc'], function() {
           Route::get('add',['as'        =>'getaddcat','uses' => 'CategoryController@getadd']);
           Route::post('add',['as'       =>'postaddcat','uses' => 'CategoryController@postadd']);

           Route::get('/',['as'       =>'getcat','uses' => 'CategoryController@getlist']);
           Route::get('del/{id}',['as'   =>'getdellcat','uses' => 'CategoryController@getdel'])->where('id','[0-9]+');

           Route::get('edit/{id}',['as'  =>'geteditcat','uses' => 'CategoryController@getedit'])->where('id','[0-9]+');
           Route::post('edit/{id}',['as' =>'posteditcat','uses' => 'CategoryController@postedit'])->where('id','[0-9]+');
    	});
         // -------------------- quan ly danh muc--------------------
        Route::group(['prefix' => '/sanpham'], function() {
           Route::get('/{loai}/getadd',['as'        =>'getaddpro','uses' => 'ProductsController@getadd']);
           Route::post('/{loai}/add',['as'       =>'postaddpro','uses' => 'ProductsController@postadd']);

           Route::get('/{loai}',['as'       =>'getpro','uses' => 'ProductsController@getlist']);
           Route::get('/del/{id}',['as'   =>'getdellpro','uses' => 'ProductsController@getdel'])->where('id','[0-9]+');

           Route::get('/{loai}/edit/{id}',['as'  =>'geteditpro','uses' => 'ProductsController@getedit'])->where('id','[0-9]+');
           Route::post('/{loai}/edit/{id}',['as' =>'posteditpro','uses' => 'ProductsController@postedit'])->where('id','[0-9]+');
           Route::get('history/{id}', 'ProductsController@history');
           Route::post('/search-products/{id}', 'ProductsController@searchProducts');
           Route::get('/review/{id}', 'ProductsController@reviewProducts');
           Route::get('/review/{id}/{review_id}', 'ProductsController@upReview');
        });
       // -------------------- quan ly danh muc-----------------------------
        Route::group(['prefix' => '/news'], function() {
           Route::get('/add',['as'        =>'getaddnews','uses' => 'NewsController@getadd']);
           Route::post('/add',['as'       =>'postaddnews','uses' => 'NewsController@postadd']);

           Route::get('/',['as'       =>'getnews','uses' => 'NewsController@getlist']);
           Route::get('/del/{id}',['as'   =>'getdellnews','uses' => 'NewsController@getdel'])->where('id','[0-9]+');

           Route::get('/edit/{id}',['as'  =>'geteditnews','uses' => 'NewsController@getedit'])->where('id','[0-9]+');
           Route::post('/edit/{id}',['as' =>'posteditnews','uses' => 'NewsController@postedit'])->where('id','[0-9]+');

        });
        // -------------------- quan ly đơn đặt hàng--------------------
        Route::group(['prefix' => '/donhang'], function() {;

           Route::get('',['as'       =>'getpro','uses' => 'OdersController@getlist']);
           Route::get('/del/{id}',['as'   =>'getdeloder','uses' => 'OdersController@getdel'])->where('id','[0-9]+');

           Route::get('/detail/{id}',['as'  =>'getdetail','uses' => 'OdersController@getdetail'])->where('id','[0-9]+');
           Route::post('/detail/{id}',['as' =>'postdetail','uses' => 'OdersController@postdetail'])->where('id','[0-9]+');
      });
        // -------------------- quan ly thong tin khach hang--------------------
        Route::group(['prefix' => '/khachhang'], function() {;

           Route::get('',['as'       =>'getmem','uses' => 'UsersController@getlist']);
           Route::get('/del/{id}',['as'   =>'getdelmem','uses' => 'UsersController@getdel'])->where('id','[0-9]+');

           Route::get('/edit/{id}',['as'  =>'geteditmem','uses' => 'UsersController@getedit'])->where('id','[0-9]+');
           Route::post('/edit/{id}',['as' =>'posteditmem','uses' => 'UsersController@postedit'])->where('id','[0-9]+');
      });
       // -------------------- quan ly thong nhan vien--------------------
        Route::group(['prefix' => '/nhanvien'], function() {;

           Route::get('',['as'       =>'getnv','uses' => 'Admin_usersController@getlist']);
           Route::get('/del/{id}',['as'   =>'getdelnv','uses' => 'Admin_usersController@getdel'])->middleware('CheckAdmin');

           Route::get('/edit/{id}',['as'  =>'geteditnv','uses' => 'Admin_usersController@getEdit'])->where('id','[0-9]+')->middleware('CheckAdmin');
           Route::post('/edit/{id}',['as' =>'posteditnv','uses' => 'Admin_usersController@postEdit'])->where('id','[0-9]+')->middleware('CheckAdmin');
      });
        Route::group(['prefix' => '/slide'], function(){
           Route::get('', 'AdminSlide@list');
           Route::get('/add', 'AdminSlide@getAdd');
           Route::post('/add', 'AdminSlide@postAdd');
           Route::get('/del/{id}', 'AdminSlide@del');
        });
      // ---------------van de khac ----------------------
    });
});


Route::get('register','Auth\AuthController@showRegistrationForm');

Route::post('register','Auth\AuthController@postregister');
