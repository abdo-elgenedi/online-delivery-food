<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'name' => ['required','string','min:3','max:100'],//done
            'description' => ['required'],//done
            'sub_category' => ['required','exists:vendor_categories,id'],//done
            'price' => ['required','numeric'],//done
           'photo' => ['nullable','image'],//done


        ];
    }

    public function messages()
    {
            return [
                'required' => 'this :attribute required',
                'sub_category.required' => 'choose category if you do not have create one first',
                'name.stirng'=>'the name must be string',
                'name.min'=>'product name must be more than 3 chars',
                'name.max'=>'product name must be less than 100 chars',
                'category_id.exists'=>'please choose valid category',
                'sub_category.exists'=>'choose valid category if you do not have create one first',
                'price.numeric'=>'the price must be numbers only',
                'photo.image'=>'please choose images only',

            ];


    }

    public function attributes()
    {
        return [
            'product.*.name'=>'Product Name',
            'product.*.tags'=>'Product Tags',
            'product.*.description'=>'Product description',
            'maincategory'=>'main category',
            'categorylevel1'=>'category level 1',
            'categorylevel2'=>'category level 2',
            'categorylevel3'=>'category level 3',
        ];
    }

    public function withValidator($validator){
        if($validator->fails()){
        }
    }
}
