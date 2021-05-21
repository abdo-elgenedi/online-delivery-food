<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function cancelledOrders(){

        $invoices=Invoice::with(['orders'=>function($q){
            $q->with('product');
        },'customer'])->where('vendor_id',Auth::user()->id)->where('status','=',0)->get();

        return view('vendor.orders.cancelled',compact(['invoices']));

    }

    public function currentOrders(){

        $invoices=Invoice::with(['orders'=>function($q){
            $q->with('product');
        },'customer'])->where('vendor_id',Auth::user()->id)->whereIn('status',['1','2','3'])->get();

        return view('vendor.orders.current',compact(['invoices']));

    }


    public function completedOrders(){

        $invoices=Invoice::with(['orders'=>function($q){
            $q->with('product');
        },'customer'])->where('vendor_id',Auth::user()->id)->where('status','=',4)->get();

        return view('vendor.orders.completed',compact(['invoices']));

    }

    public function orderDetails(Request $request){

        $invoice=Invoice::with(['orders'=>function($q){
            $q->with('product');
        },'customer'])->find($request->id);
        $view=view('vendor.orders.details',compact(['invoice']))->render();
        return response()->json([
            'view'=>$view,
            'type'=>'success'
        ]);
    }
     public function orderStatus(Request $request){

            $invoice=Invoice::find($request->id);
            if ($request->action==2) {
                $invoice->update(['status' => 2]);

                return response()->json([
                    'show' => true,
                    'message' => 'The order accepted successfully',
                    'bg' => 'bg-blue',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'id' => $request->id,
                    'status' => 'Accepted',
                    'statuscolor' => 'blue'
                ]);
            }
            if ($request->action==3) {
                $invoice->update(['status' => 3]);

                return response()->json([
                    'show' => true,
                    'message' => 'The order On The Way',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'id' => $request->id,
                    'status' => 'On The Way',
                    'statuscolor' => 'green'
                ]);
            }
            elseif ($request->action==4) {
                $invoice->update(['status' => 4]);

                return response()->json([
                    'show' => true,
                    'message' => 'The order completed',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'id' => $request->id,
                    'status' => 'Completed',
                    'statuscolor' => 'green',
                    'delete'=>true
                ]);
            }
            elseif ($request->action==0) {
                $invoice->update(['status' => 0]);

                return response()->json([
                    'show' => true,
                    'message' => 'The order cancelled',
                    'bg' => 'bg-red',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'id' => $request->id,
                    'status' => 'Cancelled',
                    'statuscolor' => 'red',
                    'delete'=>true
                ]);
            }else{
                return response()->json([
                    'show' => true,
                    'message' => 'Please Choose the correct action',
                    'bg' => 'bg-black',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'id' => $request->id,
                ]);
            }

        }

}
