<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{


    public function __construct()
    {
    }

    public function getRestMenu($id){

        $categories= VendorCategory::where('rest_id',$id)->with('products')->get();
        $vendor=Vendor::selection()->with(['categoriesLimit','state','city'])->find($id);
        return view('customer.rests.restmenu',compact(['categories','vendor']))->with(['cart'=>session()->get('cart')]);
    }
}
