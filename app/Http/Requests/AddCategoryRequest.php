<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddCategoryRequest extends Request
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
            'txtCateName' => 'required|unique:category,name'
        ];
    }
    public function messages()
    {
        return [
            'txtCateName.required' => ' Hãy nhập tên danh mục ',
            'txtCateName.unique' => 'Tên danh mục này đã tồn tại '
            
        ];
    }
}
