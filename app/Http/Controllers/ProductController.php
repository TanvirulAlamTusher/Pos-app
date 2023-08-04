<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
  function ProductPage():View{
    return view('pages.dashboard.product-page');
   }
   
   
   function Create_Product(Request $request){
    $user_id = $request->header('id');

    $img= $request->file('img');
    $currentTime = time();
    $file_name = $img->getClientOriginalName();
    $img_name = "{$user_id}-{$currentTime}-{$file_name}";
    $img_url = "uploads/{$img_name}";

    //upload image
    $img->move(public_path('uploads'),$img_name);

    //save to database
    return Product::create([
        'name'=> $request->input('name'),
        'price'=> $request->input('price'),
        'unit'=> $request->input('unit'),
        'img_url'=>$img_url,
        'user_id'=>$user_id,
        'category_id'=>$request->input('category_id')

    ]);   
   }

   function Delete_Product(Request $request){
    $user_id = $request->header('id');
    $product_id = $request->input('id');
    $filePath = $request->input('file_path');
    //delete the file
    File::delete($filePath);
    //delete from database
    return Product::where('user_id',$user_id)->where('id',$product_id)->delete();

   }

   function ProductList(Request $request){
    $user_id = $request->header('id');
    return Product::where('user_id',$user_id)->get();
   }

   function Update_Product(Request $request){
    $user_id = $request->header('id');
    $product_id = $request->input('id');

    if($request->hasFile('img')){
       //upload new img file
       $img= $request->file('img');
       $currentTime = time();
       $file_name = $img->getClientOriginalName();
       $img_name = "{$user_id}-{$currentTime}-{$file_name}";
       $img_url = "uploads/{$img_name}";
   
       //save image to diroctory
       $img->move(public_path('uploads'),$img_name);

       //delete old image
       $filePath = $request->input('file_path');
       File::delete($filePath);

       //Update database
       return Product::where('user_id',$user_id)->where('id',$product_id)->update([
        'name'=> $request->input('name'),
        'price'=> $request->input('price'),
        'unit'=> $request->input('unit'),
        'img_url'=>$img_url,
         'category_id'=>$request->input('category_id')
        
       ]);

    }else{
        return Product::where('user_id',$user_id)->where('id',$product_id)->update([
            'name'=> $request->input('name'),
            'price'=> $request->input('price'),
            'unit'=> $request->input('unit'),
           'category_id'=>$request->input('category_id')
        ]);
    }
  }
  function Total_Product(Request $request){
    $user_id = $request->header('id');
    return Product::where('user_id', $user_id)->count();
  }

}
