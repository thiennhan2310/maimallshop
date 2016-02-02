<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 2/2/2016
 * Time: 4:03 PM
 */

namespace App\Http\Requests;


class SignupRequest extends Request
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
            "email" => "email|required|unique:customers,email" ,
            "password" => "required|confirmed|min:6"
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Chưa nhập email' ,
            "email.email" => "Nhập email" ,
            "password.min" => "Mật khẩu ít nhất 6 kí tự" ,
            "email.unique" => "Email đã tồn tại" ,
            'password.required' => 'Chưa nhập mật khẩu' ,
            'password.confirmed' => 'Mật khẩu xác nhận không đúng'
        ];
    }
}