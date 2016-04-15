<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 2/14/2016
 * Time: 11:23 AM
 */

namespace App\Http\Controllers;

use App\Bill;
use App\billDetail;
use App\customer;
use App\CustomerInfo;
use App\DiscountCode;
use App\District;
use App\Products;
use App\Province;
use App\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    public $code = "";

    public function useCode()
    {

    }
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
        $cart = new CartController();
        $products = $cart->getProduct();
        $subTotal = $cart->subTotalPrice($products);
        if ( Session::has("codeDiscount") ) {
            $code = Session::get("codeDiscount");
            $total = $cart->totalPrice($subTotal , null , $code);
        } else {
            $code = "---";
            $total = $cart->totalPrice($subTotal , null , null);
        }
        return view("pages.paymentInfo.cart" , compact("products" , "subTotal" , "code" , "total"));
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

    public function Finish(Request $request)
    {
        if ( Auth::check() && Session::has("cart") ) {
            $payment_method = (int) $request->get("method");

            $cart = new CartController();
            $products = $cart->getProduct();
            $subTotal = $cart->subTotalPrice($products);
            if ( Session::has("codeDiscount") ) {
                $code = Session::get("codeDiscount");
                $percent = DiscountCode::changeCodeToPercent($code);
                $total = $subTotal * $percent / 100;
            } else {
                $total = $subTotal;
            }
            $customerID = Auth::user()->id;
            $customerInfoID = Auth::user()->default_info_id;
            /*
             * 1: done
             * 2:chua thanh toan
             * 3: moi
             */
            $bill = Bill::create(["total" => $total , "customer_id" => $customerID , "customer_info_id" => $customerInfoID , "status" => 3 , "payment_method" => $payment_method]);
            $billID = $bill->id;
            foreach ( $products as $item ) {
                $price = $item->price * (100 - $item->percent) / 100;
                billDetail::create(["bill_id" => $billID , "products_id" => $item->id , "price" => $price , "amount" => $item->so_luong]);
                $count = Products::select(["count"])->where("id" , $item->id)->first();
                $count->count += $item->so_luong;
                Products::where("id" , $item->id)->update(["count" => $count->count]);
            }
            Session::forget("codeDiscount");
            Session::forget("cart");
            /*Send mail*/
            $this->sendMail($billID);
            /**********/
            return redirect()->route("thanhtoan.thongtin.hoadon" , $billID);
        } else {
            return redirect()->route("home");
        }
    }

    private function sendMail($billID)
    {
        $bill_id = $billID;
        $billInfo = Bill::find($bill_id);
        $customerInfo = CustomerInfo::getAddressInfo($billInfo->customer_info_id);
        $billDetail = billDetail::getProducts($bill_id);
        $data = [
            "billInfo" => $billInfo ,
            "customerInfo" => $customerInfo ,
            "billDetail" => $billDetail
        ];
        $email = Auth::user()->email;
        $name = $customerInfo->last_name;
        \Mail::send('emails.purchased' , $data , function ($message) use ($email , $name) {
            $message->from('admin@maimallshop.com' , 'Mai Mall. Thông tin hóa đơn');
            $message->to($email , $name)->subject('Xác nhận mua hàng thành công');
        });
    }

    public function BillDetail($bill_id)
    {
        if ( Auth::check() ) {
            $billInfo = Bill::find($bill_id);
            if ( $billInfo->customer_id == Auth::user()->id ) {
                $customerInfo = CustomerInfo::getAddressInfo($billInfo->customer_info_id);
                $billDetail = billDetail::getProducts($bill_id);
                return view("pages.finish_purchase" , compact("billInfo" , "customerInfo" , "billDetail"));
            } else {
                return redirect()->route("home");
            }
        } else {
            return redirect()->route("login");
        }
    }
}