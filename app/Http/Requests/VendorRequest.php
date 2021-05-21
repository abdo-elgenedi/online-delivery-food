<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class VendorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $nameRegEx='/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.|\w| )[a-zA-Z0-9])*[a-zA-Z0-9]*$/';
        $usernameRegEx='/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.)[a-zA-Z0-9])*[a-zA-Z0-9]*$/';
        $mobileRegEx='/^[\+]?[0-9]*$/';
        $ssnRegEx='/^[0-9]+$/';
        $emailRegEX='/^[a-zA-Z0-1]+[@][a-zA-Z0-1]+[\.][a-zA-Z0-1]+/';
        $passwordRegEx='/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';
        if(auth()->guest()){
            return [
                'name' => ['required','regex:'.$nameRegEx,'max:100'],//done
                'username' => ['required','unique:vendors,username','max:20','regex:'.$usernameRegEx],//done
                'password' => ['required','min:8','confirmed','regex:'.$passwordRegEx],//done
                'mobile' => ['required','unique:vendors,mobile','min:3','max:14','regex:'.$mobileRegEx],//done
                'email' => ['required','unique:vendors,email','regex:'.$emailRegEX],//done
                'city_id'=>['required','exists:cities,id'],
                'state_id'=>['required','exists:states,id'],
                'delivery_fees'=>['required','numeric','max:50'],
                'delivery_time'=>['required','numeric'],
            ];
        }else {
            return [
                'name' => ['required','regex:'.$nameRegEx,'max:100'],//done
                'username' => ['required','unique:vendors,username,'.\request()->id,'max:20','regex:'.$usernameRegEx],//done
                'mobile' => ['required','unique:vendors,mobile,'.\request()->id,'min:3','max:14','regex:'.$mobileRegEx],//done
                'email' => ['required','unique:vendors,email,'.\request()->id,'regex:'.$emailRegEX],//done
                'city_id'=>['required','exists:cities,id'],
                'state_id'=>['required','exists:states,id'],
                'delivery_fees'=>['required','numeric','max:50'],
                'delivery_time'=>['required','numeric'],
            ];
        }
    }

    public function messages()
    {

        return [
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
            'city_id.exists'=>'invalid city name',
            'state_id.exists'=>'invalid state name',
            'password.confirmed'=>'password not matched',
            'password.min'=>'password must be more than 8 chars',
            'password.regex'=>'the password must contains at least upper char and lower char',

        ];

    }

}
