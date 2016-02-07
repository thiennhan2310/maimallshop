<?php namespace App\Http\Requests;

class CustomerAddrRequest extends Request
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
            //
            "firstname" => "required" ,
            "lastname" => "required" ,
            "phone" => "required|min:8|max:12" ,
            "address" => "required" ,
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Chưa nhập tên ' ,
            'lastname.required' => 'Chưa nhập họ' ,
            'phone.required' => 'Chưa nhập số điện thoại' ,
            'address.required' => 'Chưa nhập địa chỉ' ,
            'phone.min' => "Số điện thoại không phù hợp" ,
            'phone.max' => "Số điện thoại không phù hợp" ,
        ];
    }
}
