<?php namespace App\Http\Requests;

class ChangePassRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $redirectRoute = 'thongtin.template';

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
            "password" => "required|confirmed|min:6"
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'Mật khẩu xác nhận không đúng' ,
            'password.min' => "Mật khẩu ít nhất 6 kí tự"
        ];
    }
}
