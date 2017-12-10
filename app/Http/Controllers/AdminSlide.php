<?php

namespace App\Http\Controllers;

use App\Slide;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminSlide extends Controller
{
    public function list()
    {
        $slide = Slide::latest()->paginate(5);
        return view('back-end.slide.list')->with(['slide' => $slide]);
    }

    public function getAdd()
    {
        return view('back-end.slide.add');
    }

    public function postAdd(Request $request)
    {
        $slide = new Slide();
        $slide->title = $request->txttitle;
        // dd($request);
        $f = $request->file('txtimg')->getClientOriginalName();
        $filename = time().'_'.$f;
        $slide->link = 1;
        $slide->image = $filename;
        $request->file('txtimg')->move('images/slide/',$filename);
        $slide->save();
        return redirect()->action('AdminSlide@list')->with(['success', 'Create Slide Successfully!!']);
    }

    public function del($id)
    {
        $slide = Slide::find($id)->first();
        if($slide->count() == 0) return back()->withErrors('そのスライドがありません！！');
        $slide->delete();
        return back()->with(['success' => 'Delete Slide Successfully!!']);
    }
    //
}
