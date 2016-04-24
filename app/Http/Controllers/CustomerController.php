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

        } else {
            return redirect()->route("login");
        }
    }

    public function ResetPassword()
    {
        $email = Request::get("email");
        $customer = customer::select(["email" , "last_name"])->where("email" , $email)->first();
        if ( $customer != null ) {
            $new_pass = str_random(10);
            $password = Hash::make($new_pass);
            customer::where("email" , $email)->update(["password" => $password]);
            /*Send mail*/

            $name = $customer->last_name;
            $data = ["new_pass" => $new_pass ,
                "name" => $name];
            \Mail::send('emails.password' , $data , function ($message) use ($email , $name) {
                $message->from('admin@maimallshop.com' , 'Mai Mall. Thông tin mật khẩu');
                $message->to($email , $name)->subject('Mật khẩu mới');
            });
            /**/
            return redirect()->route("reset.password.get")->with("result" , "Mật khẩu mới đã được gửi đến email của bạn");
        } else {
            return redirect()->route("reset.password.get")->with("error" , "Tài Khoản không tồn tại");
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
            $info_id = CustomerInfo::create(["customer_id" => $customerID , "first_name" => $firstname
                , "last_name" => $lastname , "address" => $address , "phone" => $phone , "district_id" => $districtID
                , "province_id" => $provinceID , "ward_id" => $wardID]);
            $customer_default_info_id = customer::select(["default_info_id"])->where("id" , Auth::user()->id)->first();
            if ( is_null($customer_default_info_id->default_info_id) ) {
                customer::where("id" , Auth::user()->id)->update(["default_info_id" => $info_id->id]);
            }
            return redirect()->back();
        } else {
            return redirect()->route("login");
        }
    }

    public function ChangeAddress(CustomerAddrRequest $request)
    {
        $customerinfoID = $request->get("customerInfoID");
        if ( Auth::check() ) {
            $info = CustomerInfo::find($customerinfoID);
            $info->first_name = $request->get("firstname");
            $info->last_name = $request->get("lastname");
            $info->phone = $request->get("phone");
            $info->address = $request->get("address");
            $info->province_id = $request->get("provinceID");
            $info->district_id = $request->get("districtID");
            $info->ward_id = $request->get("wardID");
            $info->save();
            return redirect()->back();
        } else {
            return redirect()->route("login");
        }
    }

    public function DelAddress($customerInfoID)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                $info = CustomerInfo::find($customerInfoID);
                $info->delete();
                /*TH xoá info id mac dinh*/
                $default_info_id = customer::where("default_info_id" , $customerInfoID)->count();
                if ( $default_info_id == 1 ) {
                    //bi xoa
                    $id = CustomerInfo::select(["id"])->where("customer_id" , Auth::user()->id)->first();
                    $customer = customer::find(Auth::user()->id);
                    if ( count($id) == 1 ) {
                        //con dia chi khac duong cung cap
                        $customer->default_info_id = $id->id;
                    } else {
                        $customer->default_info_id = NULL;
                    }
                    $customer->save();
                }
                return json_encode(["result" => "Xoá thành công" , "type" => "success"]);
            }
                return redirect()->route("thongtin.template");
            } else {
                return redirect()->route("login");
            }
        }
    }

