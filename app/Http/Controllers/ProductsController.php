<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddProductsRequest;
use App\Http\Requests\EditProductsRequest;
use App\Http\Requests;
use App\Products;
use App\Category;
use App\Pro_details;
use App\Detail_img;
use DateTime,File,Input,DB;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
	public function getlist($id)
	{
            
        if ($id!='all') {
            $pro = Products::where('cat_id',$id)->orderby('id')->paginate(10);
            $cat= Category::all();
            return view('back-end.products.list',['data'=>$pro,'cat'=>$cat,'loai'=>$id]);                    
        } else {
            $pro = Products::paginate(10);
            $cat= Category::all();
            return view('back-end.products.list',['data'=>$pro,'cat'=>$cat,'loai'=>$id]);
        }		
	}
    public function getadd($id)
    {
        $loai = Category::where('id',$id)->first();
        $p_id = $loai->parent_id;
        $p_name = $loai->name;
        $cat= Category::where('parent_id',$p_id)->get();
        $pro = Products::all();
        /*echo $p_name;
        echo $pro;*/

        if ($p_id >=19) {
                return view('back-end.products.pc-add',['data'=>$pro,'cat'=>$cat,'loai'=>$p_name]);
            }
        else {
            return view('back-end.products.add',['data'=>$pro,'cat'=>$cat,'loai'=>$p_name]);
        }	
		
		
    }
    public function postadd(AddProductsRequest $rq)
    {
    	$pro = new Products();

    	$pro->name = $rq->txtname;
    	$pro->slug = str_slug($rq->txtname,'-');
    	$pro->number = $rq->txtnumber;
    	$pro->intro = $rq->txtintro;
    	$pro->promo1 = $rq->txtpromo1;
    	$pro->promo2 = $rq->txtpromo2;
    	$pro->promo3 = $rq->txtpromo3;
    	$pro->packet = $rq->txtpacket;
    	$pro->r_intro = $rq->txtre_Intro;
    	$pro->review = $rq->txtReview;
    	$pro->tag = $rq->txttag;
    	$pro->price = $rq->txtprice;
    	$pro->cat_id = $rq->sltCate;
    	$pro->created_at = new datetime;
    	$pro->status = '1';
    	$f = $rq->file('txtimg')->getClientOriginalName();
    	$filename = time().'_'.$f;
    	$pro->images = $filename;
    	$rq->file('txtimg')->move('images/phone/',$filename);
    	$pro_id = $pro->id;
        $pro->save();
    	//them vao bang admin_product
    	$admin_user = Auth::guard('admin')->user();
    	$admin_user->products()->attach($pro->id, ['created_at' => $pro->created_at]);
        $detail = new Pro_details();
       if ($rq->txtCam1=='') {
            $rq->cam1='không có';
        }
        if ($rq->txtCam2=='') {
            $rq->cam2='không có';
        }
        if ($rq->exten_memmory =='') {
            $detail->exten_memmory= $rq->txtCase;
        }
        if ($rq->pin =='') {
            $rq->pin= 'Không có';
        }
         if ($rq->sim =='') {
            $rq->sim= 'Không có';
        }
         if ($rq->note =='' || var_dump($rq->note)) {
            $rq->note= 'Không có';
        }
    	$detail->cpu = $rq->txtCpu;
    	$detail->ram = $rq->txtRam;
    	$detail->screen = $rq->txtScreen;
    	$detail->vga = $rq->txtVga;
    	$detail->storage = $rq->txtStorage;
    	$detail->exten_memmory =$rq->txtExtend;
    	$detail->cam1 = $rq->txtCam1;
    	$detail->cam2 = $rq->txtCam2;
    	$detail->sim = $rq->txtSIM;
    	$detail->connect = $rq->txtConnect;
    	$detail->pin = $rq->txtPin;
    	$detail->os = $rq->txtOs;
        $detail->note = $rq->note;
    	$detail->pro_id = $pro->id;



    	$detail->created_at = new datetime;
    	$detail->save();

    	if ($rq->hasFile('txtdetail_img')) {
    		$df = $rq->file('txtdetail_img');
    		foreach ($df as $row) {
    			$img_detail = new Detail_img();
    			if (isset($row)) {
    				$name_img= time().'_'.$row->getClientOriginalName();
    				$img_detail->images_url = $name_img;
    				$img_detail->pro_id = $pro->id;
    				$img_detail->created_at = new datetime;
    				$row->move('images/phone/',$name_img);
    				$img_detail->save();
    			}
    		}
		}
	return redirect('admin/sanpham/all')
      ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã thêm thành công !']);

    }
    public function getdel($id)
    {
        $detail = Detail_img::where('pro_id',$id)->get();
        foreach ($detail as $row) {                
               $dt = Detail_img::find($row->id);
               $pt = public_path('uploads/products/details/').$dt->images_url; 
               // dd($pt);   
                if (file_exists($pt))
                {
                    unlink($pt);
                }
               $dt->delete();                              
            }
    	$pro = Products::find($id);
        $pro->delete();
        return redirect('admin/sanpham/all')
         ->with(['flash_level'=>'result_msg','flash_massage'=>'Đã xóa !']);
    }
    public function getedit($loai , $id)
    {
        $name = $loai;
        $dt = Products::where('id',$id)->first();
        $c_id= $dt->cat_id;
        $loai= Category::where('id',$c_id)->first();
        $p_id = $loai->parent_id;
        $cat= Category::where('id','>=', '0')->get();
        $pro = Products::where('id',$id)->first();
        return view('back-end.products.edit-mobile',['pro'=>$pro,'cat'=>$cat,'loai'=>$name]);

    /*	if ($p_id == 1) {
            $cat= Category::where('parent_id', '1')->get();
            $pro = Products::where('id',$id)->first();
            return view('back-end.products.edit-mobile',['pro'=>$pro,'cat'=>$cat,'loai'=>'Điện thoại']);    
        } elseif ($p_id ==2) {
            $cat= Category::where('parent_id', 2)->get();
            $pro = Products::where('id',$id)->first();
            return view('back-end.products.edit-mobile',['pro'=>$pro,'cat'=>$cat,'loai'=>'Laptop']);       
        } elseif ($p_id ==19) {
            $cat= Category::where('parent_id', 19)->get();
            $pro = Products::where('id',$id)->first();
            return view('back-end.products.edit-mobile',['pro'=>$pro,'cat'=>$cat,'loai'=>$p_id]);     
        }*/
    }
    public function postedit($loai,$id,EditProductsRequest $rq)
    {
    	$pro = Products::find($id);

        $pro->name = $rq->txtname;
        $pro->slug = str_slug($rq->txtname,'-');
        $pro->intro = $rq->txtintro;
        $pro->number += $rq->txtnumber;
        $pro->promo1 = $rq->txtpromo1;
        $pro->promo2 = $rq->txtpromo2;
        $pro->promo3 = $rq->txtpromo3;
        $pro->packet = $rq->txtpacket;
        $pro->r_intro = $rq->txtre_Intro;
        $pro->review = $rq->txtReview;
        $pro->tag = $rq->txttag;
        $pro->price = $rq->txtprice;
        $pro->cat_id = $rq->sltCate;
        $pro->updated_at = new datetime;
        $pro->status = '1';
        $file_path = public_path('uploads/products/').$pro->images;        
        if ($rq->hasFile('txtimg')) {
            if (file_exists($file_path))
                {
                    unlink($file_path);
                }
            
            $f = $rq->file('txtimg')->getClientOriginalName();
            $filename = time().'_'.$f;
            $pro->images = $filename;       
            $rq->file('txtimg')->move('uploads/products/',$filename);
        }       
        $pro->save();

        $admin_user = Auth::guard('admin')->user();
        $admin_user->products()->attach($id, ['updated_at' => $pro->updated_at]);

        $detail = new Pro_details();

       if ($rq->txtCam1=='') {
            $rq->cam1='không có';
        }
        if ($rq->txtCam2=='') {
            $rq->cam2='không có';
        }
        if ($rq->exten_memmory =='') {
            $detail->exten_memmory= $rq->txtCase;
        }
        if ($rq->pin =='') {
            $rq->pin= 'Không có';
        }
         if ($rq->sim =='') {
            $rq->sim= 'Không có';
        }
         if ($rq->note =='' || var_dump($rq->note)) {
            $rq->note= 'Không có';
        }
     $detail->cpu = $rq->txtCpu;
     $detail->ram = $rq->txtRam;
     $detail->screen = $rq->txtScreen;
     $detail->vga = $rq->txtVga;
     $detail->storage = $rq->txtStorage;
     $detail->exten_memmory =$rq->txtExtend;
     $detail->cam1 = $rq->txtCam1;
     $detail->cam2 = $rq->txtCam2;
     $detail->sim = $rq->txtSIM;
     $detail->connect = $rq->txtConnect;
     $detail->pin = $rq->txtPin;
     $detail->os = $rq->txtOs;
      $detail->note = $rq->note;
     $detail->pro_id = $pro->id;
     $pro_id=$pro->id;
     $detail->updated_at = new datetime;        

        if ($rq->hasFile('txtdetail_img')) {
            $details = Detail_img::where('pro_id',$id)->get();
            $df = $rq->file('txtdetail_img');
            foreach ($details as $row) {                
               $dt = Detail_img::find($row->id);
               $pt = public_path('uploads/products/details/').$dt->images_url; 
               // dd($pt);   
                if (file_exists($pt))
                {
                    unlink($pt);
                }
               $dt->delete();                              
            }
            foreach ($df as $row) {
                $img_detail = new Detail_img();
                if (isset($row)) {
                    $name_img= time().'_'.$row->getClientOriginalName();
                    $img_detail->images_url = $name_img;
                    $img_detail->pro_id = $id;
                    $img_detail->created_at = new datetime;
                    $row->move('uploads/products/details/',$name_img);
                    $img_detail->save();
                }
            }
        }
    $detail->save();
    return redirect('admin/sanpham/all')
      ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã lưu !']);       
    }
}
