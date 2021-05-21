<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Vendor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{


    public function checkout(){
            if (session()->has('cart')){
                $cart=session()->get('cart');
                $cart['address']=\request()->address;
                $cart['note']=\request()->note;
                session()->put('cart',$cart);
                $vendor=Vendor::with(['city','state'])->find($cart['rest']);
                return view('customer.checkout',compact(['cart','vendor']));
            }else{
                return redirect()->back();
            }
    }

    public function order(){

        if (session()->has('cart')){
            $cart=session()->get('cart');
            $vendor=Vendor::with(['city','state'])->find($cart['rest']);
            try{
                DB::beginTransaction();
                $invoice=Invoice::insertGetId([
                  'total_price'=>$cart['total'],
                  'user_id'=>Auth::user()->id,
                  'vendor_id'=>$cart['rest'],
                  'address'=>$cart['address'],
                  'notes'=>$cart['note'],
                ]);
                foreach ($cart['items'] as $id=>$item){
                    Order::create([
                        'product_id'=>$id,
                        'invoice_id'=>$invoice,
                        'quantity'=>$item['qnty'],
                    ]);
                }
                DB::commit();
                session()->remove('cart');
                return redirect()->route('current.orders');
            }catch(\Exception$e){
                DB::rollBack();
            }
            return view('customer.checkout',compact(['cart','vendor']));
        }else{
            return redirect()->back();
        }
    }
}
