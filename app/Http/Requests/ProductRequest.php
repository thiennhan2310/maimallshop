<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/14/2016
 * Time: 11:55 AM
 */

namespace App\Http\Requests;


class ProductRequest extends Request
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
           "id"=> "unique:products,id",
            "name"=>'required',
            'img[]' => 'mimes:jpeg,bmp,png,jpg',
        ];
    }
    public function messages() {
        return [
            "id.unique" =>"Mã Sản phẩm đã tồn tại ",
            'name.required' => 'Chưa nhập tên sản phẩm',
            'img[].mimes' => 'Định dạng hình không phù hợp'
        ];
    }
}