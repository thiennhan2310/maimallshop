<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/11/2016
 * Time: 4:31 PM
 */

namespace App\Http\Requests;


class FormRequest extends Request
{
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
            'name.required',
        ];
    }
    public function messages() {
        return [
            'name.required' => 'Chưa nhập tên sản phẩm',
        ];
    }
}