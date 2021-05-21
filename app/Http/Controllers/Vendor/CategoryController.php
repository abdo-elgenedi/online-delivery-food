<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct(){

        $this->middleware('auth:vendor');
    }

    public function index(){
        $categories = VendorCategory::where('rest_id',Auth::user()->id)->get();
        return view('vendor.categories.index',compact(['categories']));
    }


    public function create()
    {

        return view('vendor.categories.create');

    }



    public function store(Request $request)
    {
        $validation=Validator::make($request->only('name'),['name'=>['string','max:30']],['string'=>'this :attribute must be chars','max'=>'this :attribute must be less than 30 chars']);
        if ($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }
        try {

            DB::beginTransaction();
            VendorCategory::create([
                'name' => $request['name'],
                'rest_id' => Auth::user()->id,
            ]);

            DB::commit();
            return redirect()->route('vendor.categories')->with(['success' => 'The Category Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.categories')->with(['success' => 'Category Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }

    }


    public function edit($id){
        $category = VendorCategory::find($id);
        if(!$category){
            return redirect()->route('vendor.categories')->with(['success' => 'Category Not Found ', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);

        }
        else{
            return view('vendor.categories.update',compact(['category']));
        }

    }

    public function update(Request $request){
        $validation=Validator::make($request->only('name'),['name'=>['string','max:30']],['string'=>'this :attribute must be chars','max'=>'this :attribute must be less than 30 chars']);
        if ($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }
        $category=VendorCategory::find($request->id);
        if(!$category){
            return redirect()->route('vendor.categories')->with(['success' => 'Category Not Found ', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);

        }
        try{
            DB::beginTransaction();
            $category->update([
                'name' => $request['name']
            ]);
            DB::commit();
            return redirect()->route('vendor.categories')->with(['success' => 'The category Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch(\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.categories')->with(['success' => 'category Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }

    public function delete(Request $request)
    {
        $category = VendorCategory::find($request->id);
        if (!$category) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'category Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $category->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Category Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Category Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }
}
