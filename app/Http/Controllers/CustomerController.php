<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  
   function CustomerPage():View{
    return view('pages.dashboard.customer-page');
   }

    function CustomerCreate(Request $request){
      try{
        $user_id=$request->header('id');

         Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'user_id' => $user_id
          ]);

          return response()->json([
          'status' => 'success',
          'message' => 'Customer Added Successfully'
           ],200);
  

      }
      catch(Exception $e){
        return response()->json([
         'status' => 'failure',
         'message' => 'Something went wrong'
          ]);

      }

       
    }

    function CustomerList(Request $request){
        $user_id = $request->header('id');
      return Customer::where('user_id', $user_id)->get();
    }

    function CustomereDelete(Request $request){
      try{
        $user_id = $request->header('id');
        $customer_id = $request->input('id');

         Customer::where('id',$customer_id)->where('user_id',$user_id)->delete();

       return response()->json([
       'status' => 'success',
        'message' => 'Customer Delete Successfully'
          ],200);

      }catch(Exception $e){
        return response()->json([
          'status' => 'failure',
           'message' => 'Something went wrong'
             ],200);
   

      }
       

    }

    function CustomerUpdate(Request $request){
      try{
        $user_id = $request->header('id');
        $customer_id = $request->input('id');

        Customer::where('id',$customer_id)
        ->where('user_id',$user_id)->update([
           'name'=>$request->input('name'),
           'email'=>$request->input('email'),
           'mobile'=>$request->input('mobile')
        ]);
        return response()->json([
          'status' => 'success',
          'message' => 'Customer Update Successfully'
           ],200);

      }catch(Exception $e){
        return response()->json([
          'status' => 'failure',
          'message' => 'Something went wrong'
           ],200);

      }
      
    }

    function CustomerByID(Request $request){
      $customer_id=$request->input('id');
      $user_id=$request->header('id');
      return Customer::where('id',$customer_id)->where('user_id',$user_id)->first();
  }
  function Total_Customer(Request $request){
    $user_id = $request->header('id');
    return Customer::where('user_id', $user_id)->count();
  }
}
