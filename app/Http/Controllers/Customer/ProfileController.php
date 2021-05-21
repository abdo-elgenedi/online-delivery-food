<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{


    public function index(){

        return view('customer.profile');
    }

    public function update(UserRequest $request){

        try {
            $user = User::find(Auth::user()->id);
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'mobile' => $request->mobile,
            ]);
            return redirect()->route('customer.profile')->with(['message' => 'Your profile updated successfully', 'color' => 'success']);
        }catch (\Exception $e){
            return  redirect()->route('customer.profile')->with(['message' => 'Your profile not updated please try again', 'color' => 'dark']);

        }
    }

    public function image(Request $request){

        $validation=Validator::make($request->only('image'),['image'=>['required','image']],['required'=>'please choose image first','image'=>'the file must be an image only']);
        if ($validation->fails()){
            return redirect()->route('customer.profile')->withErrors($validation->errors())->with(['message' => 'Your image not updated please try again', 'color' => 'danger']);
        }
        $user=User::find(Auth::user()->id);
        $imageName=$user->username.$request->image->hashName();
        $oldImage=$user->image;
        try{
            $user->update(['image'=>$imageName]);
            $request->image->move(base_path().'/public/images/users',$imageName);
            if ($oldImage!='customer.jpg'){
                try{
                    unlink(base_path().'/public/image/users/'.$oldImage);
                }catch (\Exception $e){}
            }
            return redirect()->route('customer.profile')->with(['message' => 'Your image updated successfully', 'color' => 'success']);
        }catch (\Exception $e){
            return  redirect()->route('customer.profile')->with(['message' => 'Your image not updated please try again', 'color' => 'dark']);
        }
    }

    public function password(Request $request){
        $passwordRegEx='/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';
        $validation=Validator::make($request->only(['password','password_confirmation']),
            [
                'password' => ['required','min:8','confirmed','regex:'.$passwordRegEx]
            ],
            [
                'password.confirmed'=>'password not matched',
                'password.min'=>'password must be more than 8 chars',
                'password.regex'=>'the password must contains at least upper char and lower char'
            ]
    );
        if ($validation->fails()){
            return redirect()->route('customer.profile')->withErrors($validation->errors())->with(['message' => 'Your Password not updated please check errors', 'color' => 'danger']);
        }
        $user=User::find(Auth::user()->id);
        if (Auth::guard('web')->validate(['email'=>$user->email,'password'=>$request->oldpassword])){
            $user->update(['password'=>Hash::make($request->password)]);
            return  redirect()->route('customer.profile')->with(['message' => 'Your password updated successfully', 'color' => 'success']);
        }
        return  redirect()->route('customer.profile')->with(['message' => 'Your old password is incorrect', 'color' => 'danger']);
    }
}
