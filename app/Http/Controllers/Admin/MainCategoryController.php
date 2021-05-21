<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Admin;
use App\Models\Language;
use App\Models\MainCategory;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MainCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $mainCategories = MainCategory::get();
        return view('admin.maincategories.index')->with(['mainCategories' => $mainCategories]);
    }

    public function create()
    {
        return view('admin.maincategories.create');

    }

    public function store(MainCategoryRequest $request)
    {
        if (isset($request->photo))
        {
            $imageName=$request->photo->hashName();
        }else{
            $imageName='maincategory.jpg';
        }
        try {

            if (!isset($request['active'])) {
                $request['active'] = '0';
            }
            DB::beginTransaction();
             MainCategory::create([
                'name' =>$request->name,
                'active' => $request['active'],
                'photo' => $imageName,
            ]);
            if (isset($request->photo))
             $request->photo->move(base_path().'/public/images/maincategories',$imageName);
            DB::commit();
            return redirect()->route('admin.maincategories')->with(['success' => 'The Category Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.maincategories')->with(['success' => 'Category Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }

    public function edit($id)
    {
       try {
           $mainCategory = MainCategory::find($id);
           if (!$mainCategory) {
               return redirect()->route('admin.maincategories')->with(['success' => 'Category Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
           }
       }catch (\Exception $e){
           return redirect()->route('admin.maincategories')->with(['success' => 'Category Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
       }


        return view('admin.maincategories.update')->with(['category' => $mainCategory]);
    }

    public function update(MainCategoryRequest $request)
    {

        $mainCategory = MainCategory::find($request->id);
        if (!$mainCategory) {
            return redirect()->route('admin.maincategories')->with(['success' => 'Category Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }

        if (isset($request->photo))
        {
            $imageName=$request->photo->hashName();
            $oldImage=$mainCategory->photo;
        }else{
            $imageName=$mainCategory->photo;
        }
        try {
            DB::beginTransaction();
            $mainCategory->update([
                'name' => $request->name,
                'photo' => $imageName,
            ]);
            if (isset($request->photo))
            {
                $request->photo->move(base_path().'/public/images/maincategories',$imageName);
                try{
                    unlink(base_path().'/public/images/maincategories/'.$oldImage);
                }catch(\Exception $e){}
            }
            DB::commit();
            return redirect()->route('admin.maincategories')->with(['success' => 'The Category Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }
        catch
            (\Exception $e) {
            DB::rollBack();
                return redirect()->route('admin.maincategories')->with(['success' => 'The Category Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function delete(Request $request)
    {
        try {
            $mainCategory = MainCategory::find($request->id);
            if (!$mainCategory) {
                return response()->json([
                    'show'=>true,
                    'id'=>$request->id,
                    'message' => 'Category Not Found',
                    'bg' => 'bg-cyan',
                    'color' => 'whitesmoke'
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Category Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            if($mainCategory->photo !='maincategory.jpg'&&$mainCategory->photo !=NULL){
                try {
                    unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'maincategories' . DIRECTORY_SEPARATOR . $mainCategory->photo));
                }catch(\Exception $e){}
            }
            $mainCategory->delete();
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