<?php namespace App\Http\Controllers;

use App\customer;
use App\Http\Requests\ChangePassRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class CustomerController extends Controller
{

    public function ChangeCustomerInfo($gender , $birthday)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                $customer_id = Auth::user()->id;
                $customer = customer::find($customer_id);
                $customer->gender = $gender;
                $customer->birthday = $birthday;
                $customer->save();
                return json_encode(["result" => "Cập nhật thành công"]);
            }
        }

    }

    public function ChangePassword(ChangePassRequest $request)
    {
        if ( Auth::check() ) {
            $customer_data = ["email" => Auth::user()->email , "password" => $request->password_old];
            /*kiem tra mat khau cu*/
            if ( Auth::validate($customer_data) ) { //dung mat khau
                $customer = customer::find(Auth::user()->id);
                $customer->password = Hash::make($request->password);
                $customer->save();
                Auth::logout();
                return redirect()->route("login");
            } else {
                return redirect()->route("thongtin.template")->with("result" , "Mật khẩu không chính xác");
            }

        }
    }
}
