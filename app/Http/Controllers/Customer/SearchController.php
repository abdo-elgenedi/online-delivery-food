<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\MainCategory;
use App\Models\State;
use App\Models\Vendor;
use Illuminate\Http\Request;

class SearchController extends Controller
{




    public function findByLocation(Request $request){

        if ((!isset($request->state)||$request->state==null)||(!isset($request->city)||$request->city==null)){
            return redirect('/')->with(['message'=>'please choose valid location','color'=>'red']);
        };
        $cities=City::find($request->city);
        $states=State::find($request->state);
        $stateInCity=State::where('city_id',$request->city)->first();
        if (!$cities||!$states){
            return redirect('/')->with(['message'=>'we did not delivered to this location','color'=>'red']);
        };
        if (!$stateInCity){
            return redirect('/')->with(['message'=>'please choose valid location','color'=>'red']);
        };
        $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->with('categories')->orderBy('open_status','DESC')->paginate(6);
         $categories=$this->getCategories();
        return view('customer.rests.rests',compact(['restaurants','categories']));
    }


    public function filter(Request $request){
        $categories=$this->getCategories();
        if ((!isset($request->state)||$request->state==null)||(!isset($request->city)||$request->city==null)){
            return redirect('/')->with(['message'=>'please choose valid location','color'=>'red']);
        };
        $cities=City::where('id',$request->city)->get();
        $states=State::where('id',$request->state)->get();
        if (!$cities->count()>0||!$states->count()>0){
            return redirect('/')->with(['message'=>'we did not delivered to this location','color'=>'red']);
        };
        $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->with('categories')->orderBy('open_status','DESC');
        if (isset($request->category)&&$request->category!=0){
             $restaurants->join('vendor_maincategories','vendors.id','vendor_maincategories.vendor_id')->where('vendor_maincategories.category_id',$request->category)
                 ->select('vendors.*');
        }
        if (isset($request->name)){
            $restaurants->where('name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->sort)){
            if ($request->sort=='1'){
                $restaurants->orderBy('created_at','DESC');
            }
            elseif ($request->sort=='2'){
                $restaurants->orderBy('delivery_time','ASC');
            }
            elseif ($request->sort=='3'){
                $restaurants->orderBy('delivery_fees','ASC');
            }

        }

       $restaurants=$restaurants->paginate(5);
        return view('customer.rests.rests',compact(['restaurants','categories']));


    }

    public function sort(Request $request){

        if (!isset($request->state)){
            return redirect('/')->with(['message'=>'please choose valid location','color'=>'red']);
        };
        if ($request->sort=='1'){
        $restaurants=Vendor::where('state_id',$request->state)->orderBy('created_at','DESC')->where('status',1)->with('categories')->paginate(5);
        }
        elseif ($request->sort=='2'){
            $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->orderBy('delivery_fees','ASC')->with('categories')->paginate(6);
        }
        elseif ($request->sort=='3'){
            $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->orderBy('name','ASC')->with('categories')->paginate(6);
        }
        else{
            $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->with('categories')->paginate(6);
        }
        $categories=$this->getCategories();
        return view('customer.rests.sorting',compact(['restaurants','categories']));
    }






    public function findByName(Request $request){

        if (!isset($request->state)){
            return redirect('/')->with(['message'=>'please choose valid location','color'=>'red']);
        };
        if (isset($request->sort)){
            if ($request->sort=='1'){
                $restaurants=Vendor::where('state_id',$request->state)->orderBy('created_at','DESC')->where('status',1)->where('name', 'like', '%' . $request->name . '%')->with('categories')->paginate(5);
            }
            elseif ($request->sort=='2'){
                $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->orderBy('delivery_fees','ASC')->where('name', 'like', '%' . $request->name . '%')->with('categories')->paginate(6);
            }
            elseif ($request->sort=='3'){
                $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->orderBy('name','ASC')->where('name', 'like', '%' . $request->name . '%')->with('categories')->paginate(6);
            }else{
                $restaurants = Vendor::where('state_id', $request->state)->where('status', 1)->where('name', 'like', '%' . $request->name . '%')->with('categories')->paginate(6);
            }
        }else {
            $restaurants = Vendor::where('state_id', $request->state)->where('status', 1)->where('name', 'like', '%' . $request->name . '%')->with('categories')->paginate(6);
        }
        $categories=$this->getCategories();
        return view('customer.rests.name',compact(['restaurants','categories']));

    }

    public function findByCategory(Request $request){
        if (!isset($request->state)){
            return redirect('/')->with(['message'=>'please choose valid location','color'=>'red']);
        };
        if (isset($request->sort)){

            if ($request->sort=='1'){
                $restaurants=Vendor::where('state_id',$request->state)->orderBy('vendors.created_at','DESC')->where('status',1)->where('name', 'like', '%' . $request->name . '%')->with('categories')
                    ->join('vendor_maincategories','vendors.id','vendor_maincategories.vendor_id')->where('vendor_maincategories.category_id',$request->category)->paginate(6);
            }
            elseif ($request->sort=='2'){
                $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->orderBy('vendors.delivery_fees','ASC')->where('name', 'like', '%' . $request->name . '%')->with('categories')
                    ->join('vendor_maincategories','vendors.id','vendor_maincategories.vendor_id')->where('vendor_maincategories.category_id',$request->category)->paginate(6);
            }
            elseif ($request->sort=='3'){
                $restaurants=Vendor::where('state_id',$request->state)->where('status',1)->orderBy('vendors.name','ASC')->where('name', 'like', '%' . $request->name . '%')->with('categories')
                    ->join('vendor_maincategories','vendors.id','vendor_maincategories.vendor_id')->where('vendor_maincategories.category_id',$request->category)->paginate(6);
            }else{
                $restaurants = Vendor::where('state_id', $request->state)->where('status', 1)->where('vendors.name', 'like', '%' . $request->name . '%')->with('categories')
                    ->join('vendor_maincategories','vendors.id','vendor_maincategories.vendor_id')->where('vendor_maincategories.category_id',$request->category)->paginate(6);
            }
        }else {
            $restaurants = Vendor::where('state_id', $request->state)->where('status', 1)->where('vendors.name', 'like', '%' . $request->name . '%')->with('categories')
              ->join('vendor_maincategories','vendors.id','vendor_maincategories.vendor_id')->where('vendor_maincategories.category_id',$request->category)->paginate(6);
        }
        $categories=$this->getCategories();
        return view('customer.rests.category',compact(['restaurants','categories']));

    }





    public function getCategories(){

        return MainCategory::where('active','1')->get();
    }
}
