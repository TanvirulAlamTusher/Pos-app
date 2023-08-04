<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

  function CategoryPage():View{
    return view('pages.dashboard.category-page');
}

  function Create_Category(Request $request){
    try{
      $user_id = $request->header('id');
      Category::create([
       'name'=> $request->input('name'),
       'user_id' => $user_id
      ]);
    return response()->json([
      'status' => 'success',
      'message' => 'Category created successfully',
     ], 200);

    }catch(Exception $e){
      return response()->json([
        'status' => 'Failure',
        'message' => 'Fail to create Category',
       ]);

    }
   
  }
  function Category_List(Request $request){
    $user_id = $request->header('id');
    return Category::where('user_id', $user_id)->get();

    
  }
  function Update_Category(Request $request){
    try{
      $user_id = $request->header('id');
      $category_id = $request->input('id');
      $name = $request->input('name');

     $count = Category::where('user_id', $user_id)->where('name',$name)->count();
     if($count > 0){
      return response()->json([
        'status' => 'Already Exists',
        'message' => 'Category Name already exists',
          ],200);
        
     }else{
      Category::where('user_id',$user_id)->where('id',$category_id)->update([
        'name'=> $name
         ]);
         return response()->json([
         'status' => 'success',
         'message' => 'Category Updated Successfully',
           ],200);
     }

     

    }catch(Exception $e){
      return response()->json([
        'status' => 'failure',
        'message' => $e->getMessage()
       ],200);

    }
  
  }

  function Delete_Category(Request $request){
    try{
      $user_id = $request->header('id');
      $category_id = $request->input('id');
    
     // check if this category have any product
     $count =Product::where('category_id','=',$category_id)->
                      where('user_id',$user_id)->count();
  
     if($count < 1 ){

    Category::where('user_id', $user_id)
      ->where('id', $category_id)
      ->delete();

      return response()->json([
        'status' => 'success',
        'message' => 'Category Delete',
       ],200);
     }else{
      return response()->json([
        'status' => 'Failure',
        'message' => 'Fail to Delete Category, because there are some product under this category',
       ],200);
     }
  
     }catch(Exception $e){
      return response()->json([
        'status' => 'Failure',
        'message' => 'something went wrong',
       ],200);

    }
   
   
      

   
   
  }

  function Total_Category(Request $request){
    $user_id = $request->header('id');
    return Category::where('user_id', $user_id)->count();
  }
}
