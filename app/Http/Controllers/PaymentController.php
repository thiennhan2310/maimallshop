<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 2/14/2016
 * Time: 11:23 AM
 */

namespace App\Http\Controllers;

use App\customer;
use App\CustomerInfo;
use App\District;
use App\Province;
use App\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function Login()
    {
        return view("pages.paymentInfo.login");
    }

    public function Address()
    {
        if ( Auth::check() ) {
            $customerId = Auth::user()->id;
            $province = Province::select(["provinceid" , "name"])->orderBy("name")->get();
            $district = District::select(["districtid" , "name"])->where("provinceid" , $province[ 0 ]->provinceid)->orderBy("name")->get();
            $ward = Ward::select(["wardid" , "name"])->where("districtid" , $district[ 0 ]->districtid)->orderBy("name")->get();
            $address = CustomerInfo::getAllAddressInfo($customerId);


            return view("pages.paymentInfo.address" , compact("province" , "district" , "ward" , "address"));
        } else {
            return redirect()->route("login");
        }
    }

    public function Method()
    {
        if ( Auth::check() ) {
            return view("pages.paymentInfo.method");
        } else {
            return redirect()->route("login");
        }

    }

    public function Cart()
    {
        return view("pages.paymentInfo.cart");
    }

    public function postAddress(Request $request)
    {
        if ( Auth::check() ) {
            $customer = customer::find(Auth::user()->id);
            $customer->default_info_id = $request->get('customerInfoId');
            $customer->save();
            $customerInfo = CustomerInfo::getAddressInfo($request->get('customerInfoId'));
            $name = $customerInfo->first_name . " " . $customerInfo->last_name;
            $address = $customerInfo->address . " P." . $customerInfo->ward_name . ", Q." . $customerInfo->district_name . ",TP." . $customerInfo->province_name;
            $phone = $customerInfo->phone;
            return json_encode(["name" => $name , "address" => $address , "phone" => $phone]);

        }
    }
}