<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\VendorMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainCategoryController extends Controller
{
    public function __construct(){

        $this->middleware('auth:vendor');
    }

    public function index(){
        $categories = VendorMainCategory::where('vendor_id',Auth::user()->id)->with('category')->get();
        return view('vendor.maincategories.index',compact(['categories']));
    }


    public function create()
    {
         $categories = (VendorMainCategory::select('category_id')->where('vendor_id',Auth::user()->id)->get())->toArray();
          $maincategories=MainCategory::whereNotIn('id',$categories)->get();

        return view('vendor.maincategories.create',compact(['maincategories']));

    }



    public function store(Request $request)
    {
        try {
            $category=VendorMainCategory::where('category_id',$request->category)->where('vendor_id',Auth::user()->id)->first();
            if (!$category) {
                DB::beginTransaction();
                VendorMainCategory::create([
                    'vendor_id' => Auth::user()->id,
                    'category_id' => $request['category'],
                ]);
                DB::commit();
                return redirect()->route('vendor.maincategories')->with(['success' => 'You are added to this category', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            }else{
                return redirect()->route('vendor.maincategories')->with(['success' => 'sorry you are already in this category', 'bg' => 'bg-danger', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.maincategories')->with(['success' => 'Error while processing please try again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }

    }

    public function delete(Request $request)
    {
        $category = VendorMainCategory::find($request->id);
        if (!$category) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Category Not Found',
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
