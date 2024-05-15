<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\Filter;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
      $id= $this->route('category');
       return [
        'name' => [
            "required",
            "string",
            "max:255",
            "min:3",
            Rule::unique('categories','name')->ignore($id),
            // function($attribute, $value, $fail){
            //     if(strtolower($value) == 'laravel'){
            //         $fail('This is forbidden name!');
            //     }
            // },
            // new Filter(['laravel', 'php']),
            'filter:laravel,php,css'
            ],
        'parent_id' => ['nullable','int', 'exists:categories,id'],
        'image' => ['image', 'mimes:jpg,png', 'dimensions:min_width:100,min_height:100'],
        'status' => 'required|in:active,archived',
        'description' =>''
    ];
    }
    public function messages()
    {
      $id= $this->route('category');
       return [
        'name.unique' => 'This name is already exists',
        'name.required' => 'The name field is required',
    ];
    }
}
