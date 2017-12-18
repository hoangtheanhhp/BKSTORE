<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Requests\AddCategoryRequest;
use DateTime;

class CategoryController extends Controller
{
   public function getlist()
   {
		$data = Category::all();
		return View ('back-end.category.cat-list',['data'=>$data]);
   }
   public function getadd()
   {	
		$data = Category::all();
		return View ('back-end.category.add',['data'=>$data]);
   }
   public function postadd(Request $rq)
   {
      $cat = new Category();
      $cat->name= $rq->txtCateName;
      $f = $rq->file('txtimg')->getClientOriginalName();
      $filename = time().'_'.$f;
      $cat->image = $filename;
      $rq->file('txtimg')->move('images/category/', $filename);
      $cat->created_at = new DateTime;
      $cat->save();
      return redirect()->route('getcat')
      ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã thêm thành công !']);
   }
   public function getedit($id)   {
      $cat = Category::all();
      $data = Category::findOrFail($id)->toArray();
      return View ('back-end.category.edit',['cat'=>$cat,'data'=>$data]);
   }
   public function postedit($id,Request $request)
   {
      $cat = category::find($id);
      $cat->name = $request->txtCateName;
       $file_path = public_path('images/category/').$cat->slug;
       if ($request->hasFile('txtimg')) {
           if (file_exists($file_path))
           {
               unlink($file_path);
           }

           $f = $request->file('txtimg')->getClientOriginalName();
           $filename = time().'_'.$f;
           $cat->slug = $filename;
           $request->file('txtimg')->move('images/category/',$filename);
       }
       $cat->parent_id = $request->sltCate;
      $cat->updated_at = new DateTime;
      $cat->save();
      return redirect()->route('getcat')
      ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã sửa']);

   }
   public function getdel($id)
   {
      $parent_id = category::where('parent_id',$id)->count();
      if ($parent_id==0) {
         $category = category::find($id);
         $category->delete();
         return redirect()->route('getcat')
         ->with(['flash_level'=>'result_msg','flash_massage'=>'Đã xóa !']);
      }
      else{
         echo '<script type="text/javascript">
                  alert("Không thể xóa danh mục này !");                
                window.location = "';
                echo route('getcat');
            echo '";
         </script>';
      }
   }
}
