<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\VendorRequest;
use App\Mail\CreatedVendorMail;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterVendorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/vendor';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register(){

        $cities=City::all();
        return view('vendor.create',compact(['cities']));
    }

    public function getStates(Request $request){

        $states=State::where('city_id',$request->id)->get();

        return response()->json([
            'values'=>$states
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(VendorRequest $request)
    {
        if( Vendor::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'mobile'=>$request->mobile,
            'city_id'=>$request->city_id,
            'state_id'=>$request->state_id,
            'email' => $request->email,
            'delivery_fees' => $request->delivery_fees,
            'delivery_time' => $request->delivery_time,
        ])){
            $mailData=[
                'name'=>$request->name,
                'created_at'=>now()->toFormattedDateString(),
            ];
            Mail::to($request->email)->send(new CreatedVendorMail($mailData));
            return redirect()->route('vendor.getlogin');
        }
    }

}
