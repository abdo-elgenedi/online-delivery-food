<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
    public function rules()
    {
        $nameRegEx='/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.|\w| )[a-zA-Z0-9])*[a-zA-Z0-9]*$/';
        $usernameRegEx='/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.)[a-zA-Z0-9])*[a-zA-Z0-9]*$/';
        $mobileRegEx='/^[\+]?[0-9]*$/';
        $emailRegEX='/^[a-zA-Z0-1]+[@][a-zA-Z0-1]+[\.][a-zA-Z0-1]+/';
        return [
            'name' => ['required','regex:'.$nameRegEx,'max:30'],//done
            'username' => ['required','unique:users,username,'.Auth::user()->id,'max:30','regex:'.$usernameRegEx],//done
            'email' => ['required','unique:users,email,'.Auth::user()->id,'regex:'.$emailRegEX],//done
            'mobile' => ['required','unique:users,mobile,'.Auth::user()->id,'min:3','max:14','regex:'.$mobileRegEx],//done
        ];
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

         ];
    }
}
