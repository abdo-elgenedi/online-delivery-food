<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function previousOrders(){

         $orders=Invoice::with(['orders','vendor'])->where('user_id',Auth::user()->id)->whereIn('status',['0','4'])->get();

         return view('customer.orders.previous',compact(['orders']));

    }

    public function currentOrders(){

        $orders=Invoice::with(['orders','vendor'])->where('user_id',Auth::user()->id)->whereIn('status',['1','2','3'])->get();

        return view('customer.orders.current',compact(['orders']));

    }



    public function orderDetails(Request $request){

        $invoice=Invoice::with(['orders','vendor'])->find($request->id);
        $view=view('customer.orders.orderdetails',compact(['invoice']))->render();
        return response()->json([
           'view'=>$view,
           'type'=>'success'
        ]);
    }

    public function orderTracking(Request $request){

        $invoice=Invoice::with(['orders','vendor'])->find($request->id);
        $view=view('customer.orders.ordertracking',compact(['invoice']))->render();
        return response()->json([
            'view'=>$view,
            'type'=>'success'
        ]);
    }
}
