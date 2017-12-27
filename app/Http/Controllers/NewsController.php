<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddNewsRequest;
use App\Http\Requests\EditNewsRequest;

use App\Http\Requests;
use App\News;
use App\Category;
use Auth;
use DateTime,File,Input,DB;

class NewsController extends Controller
{
    public function getlist()
    {
        $data = News::join('admin_users','news.user_id','=','admin_users.id')->select('news.*','admin_users.name')->orderBy('created_at','desc')->paginate(10);
    	return view('back-end.news.list',['data'=>$data]);
    }
    public function getadd()
    {    	
		$cat= Category::all();

    	return view('back-end.news.add',['cat'=>$cat]);
    }
    public function postadd(AddNewsRequest $rq)
    {
    	$n = new News();
    	$n->title = $rq->txtTitle;
    	$n->slug = str_slug($rq->txtTitle,'-');
    	$n->author = $rq->txtAuth;
    	$n->status = $rq->slstatus;
    	$n->source = $rq->txtSource;
    	$n->intro = $rq->txtIntro;
    	$n->full = $rq->txtFull;
    	$n->user_id = Auth::guard('admin')->user()->id;
    	$n->created_at = new datetime;
        $n->cat_id = 1;
    	$f = $rq->file('txtimg')->getClientOriginalName();
    	$filename = time().'_'.$f;
    	$n->images = $filename;    	
    	$rq->file('txtimg')->move('uploads/news/',$filename);

    	$n->save();
    	return redirect('admin/news')
      	->with(['flash_level'=>'result_msg','flash_massage'=>' Đã thêm thành công !']);    	
    }
    public function getedit($id)
    {
        $n = News::where('id',$id)->first();
        $cat= Category::all();
    	return view('back-end.news.edit',['data'=>$n,'cat'=>$cat]);
    }
    public function postedit(EditNewsRequest $rq,$id)
    {
    	$n = News::find($id);
    	$n->title = $rq->txtTitle;
    	$n->slug = str_slug($rq->txtTitle,'-');
    	$n->author = $rq->txtAuth;
    	$n->status = $rq->slstatus;
    	$n->source = $rq->txtSource;
    	$n->intro = $rq->txtIntro;
    	$n->full = $rq->txtFull;
    	$n->user_id = Auth::guard('admin')->user()->id;
    	$n->created_at = new datetime;

    	$file_path = public_path('uploads/news/').$n->images;
    	 if ($rq->hasFile('txtimg')) {
            if (file_exists($file_path))
                {
                    unlink($file_path);
                }
            
            $f = $rq->file('txtimg')->getClientOriginalName();
            $filename = time().'_'.$f;
            $n->images = $filename;       
            $rq->file('txtimg')->move('uploads/news/',$filename);
        }

    	$n->save();
    	return redirect('admin/news')
      	->with(['flash_level'=>'result_msg','flash_massage'=>' Đã sửa thành công !']);
    }
    
    public function getdel($id)
   {
        News::find($id)->delete();
        return redirect()->action('NewsController@getlist')
                ->with('success','News deleted successfully');
   }
}