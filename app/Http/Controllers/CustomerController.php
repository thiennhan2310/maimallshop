<?php namespace App\Http\Controllers;

use App\customer;
use App\CustomerInfo;
use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\CustomerAddrRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class CustomerController extends Controller
{

    public function ChangeCustomerInfo($first_name , $last_name , $gender , $birthday)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                $customer_id = Auth::user()->id;
                $customer = customer::find($customer_id);
                $customer->first_name = $first_name;
                $customer->last_name = $last_name;
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

    public function AddAddress(CustomerAddrRequest $request)
    {
        $firstname = ucfirst($request->get("firstname"));
        $lastname = ucfirst($request->get("lastname"));
        $phone = $request->get("phone");
        $address = $request->get("address");
        $provinceID = $request->get("provinceID");
        $districtID = $request->get("districtID");
        $wardID = $request->get("wardID");
        if ( Auth::check() ) {
            $customerID = Auth::user()->id;
            CustomerInfo::create(["customer_id" => $customerID , "first_name" => $firstname
                , "last_name" => $lastname , "address" => $address , "phone" => $phone , "district_id" => $districtID
                , "province_id" => $provinceID , "ward_id" => $wardID
            ]);
            return redirect()->route("thongtin.template");
        } else {
            return redirect()->route("login");
        }
    }
}
