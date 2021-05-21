<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\CategoryLevel1;
use App\Models\CategoryLevel2;
use App\Models\CategoryLevel3;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function __construct(){

        $this->middleware('auth:vendor');
    }

    public function index(){
        $products = Product::where('vendor_id',Auth::user()->id)->get();
        return view('vendor.product.index')->with(['products' => $products]);
    }


    public function create()
    {
        $restCategories=VendorCategory::where('rest_id',Auth::user()->id)->get();

        return view('vendor.product.create',compact(['restCategories']));

    }



    public function store(ProductRequest $request)
    {
        try {
            if (isset($request->photo)){
                $imageName=Auth::user()->id.time().$request->photo->hashName();
            }else{
                $imageName='product.jpg';
            }

            if (!isset($request['status'])) {
                $request['status'] = '0';
            }
            DB::beginTransaction();
                Product::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'vendor_id' => Auth::user()->id,
                'sub_category' => $request['sub_category'],
                'status' => $request['status'],
                'price' => $request['price'],
                'photo'=>$imageName
            ]);
            if (isset($request->photo)){
                $request->photo->move(base_path().'/public/images/products',$imageName);
            }

            DB::commit();
            return redirect()->route('vendor.products')->with(['success' => 'The product Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.products')->with(['success' => 'Product Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }

    }


    public function deleteImages(Request $request)
    {
                $image=ProductImages::find($request->id);
                if ($image) {
                    try{
                    unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $image->name));
                    $image->delete();
                    return response()->json([
                        'remove' => true,
                        'files' => $request->filename,
                    ]);
                }catch (\Exception $e){
                        return response()->json([
                            'remove'=>false,
                        ]);
                    }
                }
                else{
                    return response()->json([
                        'remove'=>false,
                    ]);
                }
        }


    public function edit($id){
            $product = Product::find($id);
        if(!$product){
            return redirect()->route('vendor.products')->with(['success' => 'Product Not Found ', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);

        }
        else{
            $mainCategories=MainCategory::get();
            $restCategories=VendorCategory::all();
            return view('vendor.product.update',compact(['product','mainCategories','restCategories']));
        }

    }

    public function update(ProductRequest $request){

        $product=Product::find($request->id);
        if(!$product){
            return redirect()->route('vendor.products')->with(['success' => 'Product Not Found ', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);

        }
            try{
            if (isset($request->photo)){

                $imageName=Auth::user()->id.time().$request->photo->hashName();
            }else {
                $imageName = $product->photo;
            }
            $oldImage=$request->photo;
                DB::beginTransaction();
                $product->update([
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'category_id' => $request['category_id'],
                    'sub_category' => $request['sub_category'],
                    'price' => $request['price'],
                    'photo' => $imageName
                ]);
                if (isset($request->photo)) {
                    try {
                    $request->photo->move(base_path() . '/public/images/products', $imageName);
                        if ($oldImage != 'product.jpg')
                            unlink(base_path() . '/public/images/products/' . $oldImage);
                    } catch (\Exception $e) {

                    }
                }

                DB::commit();
                return redirect()->route('vendor.products')->with(['success' => 'The product Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
                }catch(\Exception $e) {
                DB::rollBack();
                return redirect()->route('vendor.products')->with(['success' => 'Product Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
    }

    public function delete(Request $request)
    {
            $product = Product::find($request->id);
            if (!$product) {
                return response()->json([
                    'show'=>true,
                    'id'=>$request->id,
                    'message' => 'Product Not Found',
                    'bg' => 'bg-cyan',
                    'color' => 'whitesmoke'
                ]);
            }
        try {
                $image=$product->photo;
                $product->delete();
                try{
                    if ($image!='product.jpg')
                    unlink(base_path().'/public/images/products/'.$image);
                }catch (\Exception $e){}

            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Product Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Product Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }

    public function changeStatus(Request $request){



            $product = Product::find($request->id);
            if (!$product) {
                return response()->json([
                    'show'=>true,
                    'message' => 'Product Not Found',
                    'bg' => 'bg-cyan',
                    'color' => 'whitesmoke',
                ]);
            }
        try {

            DB::beginTransaction();
            if($product->status==0){ $product->update(['status'=>1]);
                DB::commit();
                return response()->json([
                    'show'=>true,
                    'message' => 'The Category Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);
            }
            elseif ($product->status==1){$product->update(['status'=>0]);
                DB::commit();

                return response()->json([
                    'show' => true,
                    'message' => 'The Category Deactivated Successfully',
                    'bg' => 'bg-red',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Activate',
                    'btn'=>'primary',
                    'id'=>$request->id,
                    'status'=>'Not Active',
                    'statuscolor'=>'red'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
                return response()->json([
                    'show'=>true,
                    'message' => 'The Category Not Changed Please Try Again',
                    'bg' => 'bg-dark',
                    'color' => 'whitesmoke',
                ]);
            }

    }
    
}
