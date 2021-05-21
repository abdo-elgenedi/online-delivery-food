<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Requests\VendorRequest;
use App\Models\Admin;
use App\Models\City;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\State;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //create constructor with middleware Vendor
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    //show admin home
    public function index(){
        $invoices['all']=Invoice::where('vendor_id',Auth::user()->id)->get();
        $invoices['current']=Invoice::where('vendor_id',Auth::user()->id)->whereIn('status',[1,2,3])->get();
        $invoices['completed']=Invoice::where('vendor_id',Auth::user()->id)->where('status',4)->get();
        $invoices['cancelled']=Invoice::where('vendor_id',Auth::user()->id)->where('status',0)->get();

        $products=Product::where('vendor_id',Auth::user()->id)->get();
        $categories=VendorCategory::where('rest_id',Auth::user()->id)->get();
        $incomes=DB::table('invoices')->where('vendor_id','=',Auth::user()->id)->where('status','=','4')->sum('total_price');
        return view('vendor.index',compact(['invoices','products','categories','incomes']));
    }
    //show admin  profile
    public function getProfile(){
        $cities=City::all();
        $states=State::where('id',Auth::user()->state_id)->get();
        return view('vendor.profile',compact(['cities','states']));
    }

    public function getStates(Request $request){

        $states=State::where('city_id',$request->id)->get();

        return response()->json([
            'values'=>$states
        ]);
    }
    //update admin profile data
   public function updateProfile(VendorRequest $request ){
            $vendor=Vendor::find(Auth::user()->id);
            if (!isset($request->password)){
                return redirect()->back()->with(['success' => 'Enter your password first', 'style' => 'danger']);
            }
         if(!Auth::guard("vendor")->validate(['email'=>$vendor->email,'password'=>request('password')]))
            {
                return redirect()->back()->with(['success' => 'The password is incorrect', 'style' => 'danger']);
            }
            try {
                $vendor->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'mobile' => $request->mobile,
                    'city_id' => $request->city_id,
                    'state_id' => $request->state_id,
                    'email' => $request->email,
                    'delivery_fees' => $request->delivery_fees,
                    'delivery_time' => $request->delivery_time,
                ]);
                return redirect()->back()->with(['success' => 'The Update Done Successfully', 'style' => 'success']);
            }catch (\Exception $e){
                return redirect()->back()->with(['success' => 'The Profile not updated', 'style' => 'danger']);
            }

   }
   //update admin profile picture
    public function updatephoto(Request $request){
        $validate=Validator::make($request->all(),[
            'logo'=>'required|image',
        ],[
            'logo.required'=>'please choose image first',
            'logo.image'=>'the file must be an image'
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }else {
            $photo = Vendor::find($this->getVendorID());
            $oldphoto=$photo->logo;

            $filename = $request->logo->hashName();
            if($oldphoto=='vendor.jpg'){
                $photo->update(['logo' => $filename]);
                $request->logo->move(base_path().'/public/images/vendors',$filename);
            }else{
                $photo->update(['logo' => $filename]);
                $request->logo->move(base_path().'/public/images/vendors',$filename);
                try {
                    unlink(base_path() . '/public/images/vendors/' . $oldphoto);
                }catch (\Exception $e){}
            }
            return redirect()->back()->with(['success'=>'The Image Updated Successfully','style'=>'success']);
        }
    }

    public function changePassword(Request $request){
        $passwordRegEx='/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';
        $valid=Validator::make($request->only('password','password_confirmation'),['password'=>['required','confirmed','regex:'.$passwordRegEx]],['regex'=>'the password must contains at least upper char and lower char']);
        if($valid->fails()){
            \session()->put(['success'=>'The password not updated please check the errors','style'=>'danger']);
            return redirect()->back()->withErrors($valid->errors());
        }
        if(!Auth::guard("vendor")->validate(['email'=>Auth::user()->email,'password'=>request('oldpassword')]))
        {
            return redirect()->back()->with(['success' => 'The password is incorrect', 'style' => 'danger']);
        }
        Vendor::where('id',Auth::user()->id)->first()->update([
           'password'=>Hash::make($request->password)
        ]);
        return redirect()->back()->with(['success' => 'The password updated successfully', 'style' => 'success']);
    }

    public function status(){

        $vendor=Vendor::find(Auth::user()->id);
        if ($vendor->open_status==0){$vendor->open_status=1; $message='you are open now';}else{$vendor->open_status=0;$message='you are closed now';}
        $vendor->save();
        return redirect()->back()->with(['success' => $message, 'style' => 'success']);
    }


















    protected function vendorRules(){
        return [
            'name'=>'required|string|max:50',
            'username'=>'required|unique:admins,username,'.$this->getVendorID().'|alpha_num|max:50',
            'email'=>'required|unique:admins,email,'.$this->getVendorID().'|email',
            'mobile'=>'required|unique:admins,mobile,'.$this->getVendorID().'|string',
            'address'=>'required|max:50',
            'password'=>'required|confirmed',
        ];
    }
    protected function vendorMessages(){
        return [
            'name.required'=>'please Enter Your Name',
            'name.string'=>'Your Name Must be Text',
            'name.max'=>'Your Name Must be Less Than 50 letters',
            'username.required'=>'please Enter a Valid Username',
            'username.unique'=>'This Username Is Already Used',
            'username.max'=>'Your Name Must be Less Than 50 letters',
            'username.alpha_num'=>'Username Can be Only Letters and Numbers and _',
            'email.required'=>'please Enter a Valid Email',
            'email.unique'=>'This Email Is Already Used',
            'email.email'=>'please Enter Vaild Email Format (example@example.com)',
            'mobile.required'=>'please Enter a Valid Phone Number',
            'mobile.unique'=>'This Phone Number is Belong To Another User',
            'mobile.string'=>'The Phone Number Must be string Only',
            'password.required'=>'Please Your Password',
            'password.confirmed'=>'Your Password Confirmation does not match' ,
        ];
    }
}
