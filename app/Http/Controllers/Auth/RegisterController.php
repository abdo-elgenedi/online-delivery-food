<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
    protected function validator(array $data)
    {
        $nameRegEx='/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.|\w| )[a-zA-Z0-9])*[a-zA-Z0-9]*$/';
        $usernameRegEx='/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.)[a-zA-Z0-9])*[a-zA-Z0-9]*$/';
        $mobileRegEx='/^[\+]?[0-9]*$/';
        $ssnRegEx='/^[0-9]+$/';
        $emailRegEX='/^[a-zA-Z0-1]+[@][a-zA-Z0-1]+[\.][a-zA-Z0-1]+/';
        $passwordRegEx='/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';

        return Validator::make($data,
            [
                'name' => ['required','regex:'.$nameRegEx,'max:30'],//done
                'username' => ['required','unique:users,username','max:30','regex:'.$usernameRegEx],//done
                'email' => ['required','unique:users,email','regex:'.$emailRegEX],//done
                'mobile' => ['required','unique:users,mobile','min:3','max:14','regex:'.$mobileRegEx],//done
                'password' => ['required','min:8','confirmed','regex:'.$passwordRegEx],//done
            ],
            [
                'required' => 'this :attribute is required',
                'username.unique'=>'this username belongs to another user',
                'username.max'=>'the username must be less than 20 chars',
                'username.regex'=>'the username can only special (.,_) allowed you can not start or end with it',
                'name.max'=>'your name must be less than 100 chars',
                'name.regex'=>'your name can only special (.,_,spaces) allowed you can not start or end with it',
                'email.unique'=>'this email belongs to another user',
                'email.regex'=>'email format is invalid',
                'mobile.unique'=>'this mobile belongs to another user',
                'mobile.min'=>'mobile must be greater than 2 chars',
                'mobile.max'=>'mobile must be less than 15 chars',
                'mobile.regex'=>'mobile must be numbers only (you can start with + (optional))',
                'password.confirmed'=>'password not matched',
                'password.min'=>'password must be more than 8 chars',
                'password.regex'=>'the password must contains at least upper char and lower char',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'image' => 'customer.jpg',
            'password' => Hash::make($data['password']),
        ]);
    }
}
