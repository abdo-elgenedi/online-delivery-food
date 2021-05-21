<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\State;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $menu1=Product::with('vendor')->inRandomOrder()->limit(5)->get();
         $menu2=Product::with('vendor')->inRandomOrder()->limit(5)->get();

        return view('customer.home',compact(['menu1','menu2']));
    }

    public function getStates(Request $request){

        $states=State::where('city_id',$request->id)->get();

        return response()->json([
            'values'=>$states
        ]);
    }
}
