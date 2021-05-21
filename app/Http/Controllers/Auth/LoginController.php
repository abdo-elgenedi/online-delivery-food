<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function field(){
        if(filter_var(request()->email,FILTER_VALIDATE_EMAIL)){
            return'email';
        }else{
            return'username';
        }
    }
    public function getAdminLogin(){
        return view('admin.login');
    }

    public function adminLogin(){
        if(Auth::guard("admin")->attempt([$this->field()=>request('email'),'password'=>request('password')])) {
            return redirect()->intended(route('admin.index'));
        }
            else
            return redirect()->back()->with(['success'=>'The Username Or Password Does not Exists']);
    }

    public function login()
    {
        if(Auth::guard('web')->attempt([$this->field()=>request('email'),'password'=>request('password')]))
        {
            return redirect()->intended('/');
        }
    }

    public function getVendorLogin(){
        return view('vendor.login');
    }

    public function vendorLogin(){
        if(Auth::guard("vendor")->validate([$this->field()=>request('email'),'password'=>request('password'),'status'=>0])) {
            return redirect()->route('vendor.blocked')->with(['redirect'=>'block']);
        }else if(Auth::guard("vendor")->validate([$this->field()=>request('email'),'password'=>request('password'),'status'=>-1])) {
            return redirect()->route('vendor.pending')->with(['redirect'=>'pending']);
        }else if(Auth::guard("vendor")->attempt([$this->field()=>request('email'),'password'=>request('password'),'status'=>1])
        ||Auth::guard("vendor")->attempt([$this->field()=>request('email'),'password'=>request('password'),'status'=>2])){
            return redirect()->intended(route('vendor.index'));
        }else{
            return redirect()->back()->with(['success'=>'The Username Or Password Does not Exists']);
        }
    }
}
