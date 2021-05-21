<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\Vendor;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //create constructor with middleware admin
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //show admin home
    public function index(){


        $invoices['all']=Invoice::get();
        $invoices['current']=Invoice::whereIn('status',[1,2,3])->get();
        $invoices['completed']=Invoice::where('status',4)->get();
        $invoices['cancelled']=Invoice::where('status',0)->get();
        $vendors['all']=Vendor::get();
        $vendors['pending']=Vendor::where('status',[-1])->get();
        $vendors['active']=Vendor::where('status',1)->get();
        $vendors['blocked']=Vendor::where('status',0)->get();
        $users['all']=User::get();
        $users['active']=User::where('status',1)->get();
        $users['blocked']=User::where('status',0)->get();
        $products=Product::get();
        $categories=MainCategory::get();
        $incomes=DB::table('invoices')->where('status','=','4')->sum('total_price');
        return view('admin.index',compact(['invoices','vendors','users','products','categories','incomes']));
    }
    //show admin  profile
    public function getProfile(){
        return view('admin.profile');
    }

    //update admin profile data
   public function updateProfile(Request $request ){
        $validate=Validator::make($request->all(),$this->adminRules(),$this->adminMessages());
        if($validate->fails()){
           return redirect()->back()->with(['success'=>'Failed To Update!!   Please Check The Errors','style'=>'danger'])->withErrors($validate);
        }else{
            $admin=Admin::find(Auth::user()->id);
            $admin->update([
                'fullname'=>$request['fullname'],
                'username'=>$request['username'],
                'email'=>$request['email'],
                'phone'=>$request['phone'],
                'address'=>$request['address'],
                'dob'=>$request['dob'],
                'password'=>Hash::make(request('password')),
            ]);
            return redirect()->back()->with(['success'=>'The Update Done Successfully','style'=>'success']);
        }
   }
   //update admin profile picture
    public function updatephoto(Request $request){
        $validate=Validator::make($request->all(),[
            'photo'=>'required|image',
        ],[
            'photo.required'=>'please choose image first',
            'photo.image'=>'the file must be an image'
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }else {
            $photo = Admin::find(Auth::user()->id);
            $oldphoto=$photo->photo;
            $file_extension = $request->photo->getClientOriginalExtension();
            $filename = time() . '.' . $file_extension;
            $path = 'images/admins';
            if($oldphoto=='admin.jpg'){
                $request->photo->move($path, $filename);
                $photo->update(['photo' => $filename]);
            }else{
                $request->photo->move($path, $oldphoto);
            }
            return redirect()->back()->with(['success'=>'The Image Updated Successfully','style'=>'success']);
        }
    }





















    protected function adminRules(){
        return [
            'fullname'=>'required|string|max:50',
            'username'=>'required|unique:admins,username,'.Auth::user()->id.'|alpha_num|max:50',
            'email'=>'required|unique:admins,email,'.Auth::user()->id.'|email',
            'phone'=>'required|unique:admins,phone,'.Auth::user()->id.'|string',
            'address'=>'required|max:50',
            'dob'=>'required|date',
            'password'=>'required|confirmed',
        ];
    }
    protected function adminMessages(){
        return [
            'fullname.required'=>'please Enter Your Name',
            'fullname.string'=>'Your Name Must be Text',
            'fullname.max'=>'Your Name Must be Less Than 50 letters',
            'username.required'=>'please Enter a Valid Username',
            'username.unique'=>'This Username Is Already Used',
            'username.max'=>'Your Name Must be Less Than 50 letters',
            'username.alpha_num'=>'Username Can be Only Letters and Numbers and _',
            'email.required'=>'please Enter a Valid Email',
            'email.unique'=>'This Email Is Already Used',
            'email.email'=>'please Enter Vaild Email Format (example@example.com)',
            'phone.required'=>'please Enter a Valid Phone Number',
            'phone.unique'=>'This Phone Number is Belong To Another User',
            'phone.string'=>'The Phone Number Must be string Only',
            'dob.required'=>'Please Select Your Birthday',
            'dob.date'=>'Please Enter Correct Date Format',
            'password.required'=>'Please Your Password',
            'password.confirmed'=>'Your Password Confirmation does not match' ,
        ];
    }
}
