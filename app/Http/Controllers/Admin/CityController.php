<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $cities=City::all();
        return view('admin.cities.index',compact(['cities']));
    }

    public function create(){


        return view('admin.cities.create');
    }
 public function store(Request $request){
        $validate=Validator::make($request->only('name'),['name'=>'string|max:30'],['string'=>'the name must be string','max'=>'the name must be less than 30 chars']);
        if ($validate->fails()){
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
     try {


         DB::beginTransaction();
         City::create([
             'name' =>$request->name,
         ]);
         DB::commit();
         return redirect()->route('admin.cities')->with(['success' => 'The City Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
     }catch (\Exception $e) {
         DB::rollBack();
         return redirect()->route('admin.cities')->with(['success' => 'city Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
     }
    }


    public function edit($id)
    {
            $city = City::find($id);
            if (!$city) {
                return redirect()->route('admin.cities')->with(['success' => 'City Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        return view('admin.cities.update',compact(['city']));
    }

    public function update(Request $request)
    {

        $city = City::find($request->id);
        if (!$city) {
            return redirect()->route('admin.cities')->with(['success' => 'City Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
        try {
            DB::beginTransaction();
            $city->update([
                'name' => $request->name,
            ]);
            DB::commit();
            return redirect()->route('admin.cities')->with(['success' => 'The City Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }
        catch
        (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.cities')->with(['success' => 'The City Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function delete(Request $request)
    {
        try {
            $city = City::find($request->id);
            if (!$city) {
                return response()->json([
                    'show'=>true,
                    'id'=>$request->id,
                    'message' => 'City Not Found',
                    'bg' => 'bg-cyan',
                    'color' => 'whitesmoke'
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'City Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $city->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The City Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The City Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }
}
