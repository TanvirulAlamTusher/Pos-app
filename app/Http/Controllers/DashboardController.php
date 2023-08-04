<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardPage():View{
        return view('pages.dashboard.dashboard-page');
    }

    function TotalCustomer(Request $request){
        $user_id = $request->header('id');
        return Customer::where('user_id', $user_id)->count();
    }
    function TotalCategory(Request $request){
        $user_id = $request->header('id');
        return Category::where('user_id', $user_id)->count();
    }

    function TotalProduct(Request $request){
        $user_id = $request->header('id');
        return Product::where('user_id', $user_id)->count();
    }
   
}
