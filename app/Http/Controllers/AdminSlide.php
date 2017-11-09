<?php

namespace App\Http\Controllers;

use App\Slide;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminSlide extends Controller
{
    public function index()
    {
        $data = Slide::paginate(10);
        return view('back-end.news.list',['data'=>$data]);
    }

    public function add()
    {
        $cat= Category::where('parent_id','>=',0)->get();
        return view('back-end.news.add',['cat'=>$cat]);
    }
    //
}
