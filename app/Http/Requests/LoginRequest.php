<?php namespace App\Http\Requests;


class LoginRequest extends Request
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
            "email" => "email|required",
            "password" => "required"
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Chưa nhập email',
            "email.email" => "Nhập email",
            'password.required' => 'Chưa nhập password'
        ];
    }

}
