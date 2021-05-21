<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{

    public function __construct()
    {
        if (\session()->has('cart')){
            if ((\session()->get('card'))['subtotal']<=0){
                \session()->remove('card');
            }
        }
    }

    public function addItem(Request $request){
        $product=Product::find($request->id);
        $vendor=Vendor::selection()->find($product->vendor_id);
        if ($vendor->open_status==0){
            return response()->json([
                'type'=>'error',
                'message'=>'The restaurant is closed try again later'
            ]);
        }
        if (session()->has('cart')){
            $cart=\session()->get('cart');
            if ($vendor->id!=$cart['rest']){
                return response()->json([
                    'type'=>'error',
                    'message'=>'your cart has order from another restaurant , remove it and try again'
                ]);
            }
            if (array_key_exists($product->id,$cart['items'])){
                $cart['items'][$product->id]['qnty']+=1;
                $cart['items'][$product->id]['total']+=$product->price;
                $cart['items'][$product->id]['name']=$product->name;
                $cart['items'][$product->id]['price']=$product->price;
                $cart['subtotal']+=$product->price;
                $cart['total']+=$product->price;
                \session()->put('cart',$cart);
            }else{
                $cart['items'][$product->id]['qnty']=1;
                $cart['items'][$product->id]['total']=$product->price;
                $cart['items'][$product->id]['name']=$product->name;
                $cart['items'][$product->id]['price']=$product->price;
                $cart['subtotal']+=$product->price;
                $cart['total']+=$product->price;
                \session()->put('cart',$cart);
            }
        }else{
            $cart=[
                'rest'=>$vendor->id,
                'charges'=>$vendor->delivery_fees,
                'subtotal'=>$product->price,
                'total'=>($product->price+$vendor->delivery_fees),
                'items'=>[
                    $product->id=>[
                        'name'=>$product->name,
                        'price'=>$product->price,
                        'qnty'=>1,
                        'total'=>$product->price
                    ]
                ]
            ];
            \session()->put('cart',$cart);



        }
        $view=view('customer.rests.cart')->with(['cart'=>session()->get('cart')])->render();
        return response()->json([

            'type'=>'success',
            'data'=>$view
        ]);
    }

    public function plusItem(Request $request){
        $product=Product::find($request->id);
        $vendor=Vendor::selection()->find($product->vendor_id);
        if (session()->has('cart')){
            $cart=\session()->get('cart');
            if ($vendor->id!=$cart['rest']){
                return response()->json([
                    'type'=>'error',
                    'message'=>'another restaurant'
                ]);
            }
            if (array_key_exists($product->id,$cart['items'])){
                $cart['items'][$product->id]['qnty']+=1;
                $cart['items'][$product->id]['total']+=$product->price;
                $cart['items'][$product->id]['name']=$product->name;
                $cart['items'][$product->id]['price']=$product->price;
                $cart['subtotal']+=$product->price;
                $cart['total']+=$product->price;
                \session()->put('cart',$cart);
            }else{
                return response()->json([
                    'type'=>'error',
                    'message'=>'no item'
                ]);
            }
        }else{
            return response()->json([
                'type'=>'error',
                'message'=>'no item'
            ]);

        }
        $view=view('customer.rests.cart')->with(['cart'=>session()->get('cart')])->render();
        return response()->json([

            'data'=>$view
        ]);
    }

    public function minusItem(Request $request){
        $product=Product::find($request->id);
        $vendor=Vendor::selection()->find($product->vendor_id);
        if (session()->has('cart')){
            $cart=\session()->get('cart');
            if ($vendor->id!=$cart['rest']){
                return response()->json([
                    'type'=>'error',
                    'message'=>'another restaurant'
                ]);
            }
            if (array_key_exists($product->id,$cart['items'])){
                if ($cart['items'][$product->id]['qnty']==1){
                    unset($cart['items'][$product->id]);
                    $cart['subtotal'] -= $product->price;
                    $cart['total'] -= $product->price;
                    \session()->put('cart', $cart);
                }else {
                    $cart['items'][$product->id]['qnty'] -= 1;
                    $cart['items'][$product->id]['total'] -= $product->price;
                    $cart['items'][$product->id]['name'] = $product->name;
                    $cart['items'][$product->id]['price'] = $product->price;
                    $cart['subtotal'] -= $product->price;
                    $cart['total'] -= $product->price;
                    \session()->put('cart', $cart);
                }
            }else{
                return response()->json([
                    'type'=>'error',
                    'message'=>'no item'
                ]);
            }
        }else{
            return response()->json([
                'type'=>'error',
                'message'=>'no item'
            ]);

        }
        if ($cart['subtotal']<=0){
            \session()->remove('cart');
        }
        $view=view('customer.rests.cart')->with(['cart'=>session()->get('cart')])->render();
        return response()->json([

            'data'=>$view
        ]);
    }

    public function deleteItem(Request $request){

        if(\session()->has('cart')){
            $cart=\session()->get('cart');
            if (array_key_exists($request->id,$cart['items'])){
                $total=$cart['items'][$request->id]['total'];
                $cart['subtotal']-=$total;
                $cart['total']-=$total;
                unset($cart['items'][$request->id]);
            }
            \session()->put('cart',$cart);
            if ($cart['subtotal']<=0){
                \session()->remove('cart');
            }
            $view=view('customer.rests.cart')->with(['cart'=>session()->get('cart')])->render();
            return response()->json([

                'data'=>$view
            ]);
        }
    }
    public function clearCart(){

        if (\session()->has('cart')){
            \session()->remove('cart');

        }
        $view=view('customer.rests.cart')->with(['cart'=>session()->get('cart')])->render();
        return response()->json([
            'data'=>$view
        ]);
    }
}
