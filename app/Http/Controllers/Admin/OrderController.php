<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function orders(){

        $invoices=Invoice::with(['orders'=>function($q){
            $q->with('product');
        },'customer','vendor'])->get();

        return view('admin.orders.all',compact(['invoices']));

    }

    public function orderDetails(Request $request){

        $invoice=Invoice::with(['orders'=>function($q){
            $q->with('product');
        },'customer','vendor'])->find($request->id);
        $view=view('admin.orders.details',compact(['invoice']))->render();
        return response()->json([
            'view'=>$view,
            'type'=>'success'
        ]);
    }

}
