<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/8/2016
 * Time: 1:59 PM
 */

namespace App\Http\Controllers;

use App\DiscountCode;
use App\Products;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /*tong so luong*/


    /*them san pham*/
    public function addProduct($id, $num) // id + soluong
    {
        if (Request::ajax()) {
            if (Session::has("cart")) {
                $cart = Session::get("cart");
                $check = array_key_exists($id, $cart); //kiem tra san pham da co trong gio chua
                if ($check) { //roi thi tra ve
                    $result = "Sản phẩm đã có trong giỏ hàng";
                    return json_encode(["result" => $result]);
                } else {   //chua thi them san pham
                    $product = [$id => $num];
                    $cart = Session::pull("cart");
                    $cart += $product;
                    Session::put("cart", $cart);
                    $result = "Thêm giỏ hàng thành công";
                    $tsl = countProducts();
                    return json_encode(["result" => $result, "tsl" => $tsl]);
                }
            } else { //chua ton tai session gio hang
                $product = [$id => $num];
                Session::put("cart", $product);
                $tsl = $num;
                $result = "Thêm giỏ hàng thành công";
                return json_encode(["result" => $result, "tsl" => $tsl]);
            }
        } else {
            return redirect("/");
        }
    }

    public function updateCart()
    {
        if (Request::ajax()) {
            $string = Request::all();
            $cart = Session::get("cart");
            foreach ($string as $id => $num) {
                if ($id != "_token") {
                    $id = substr($id, 9);
                    if($num==0){ //xoa san pham
                       unset($cart[$id]);
                    }
                    else{
                        $cart[$id] = $num;
                    }
                }
            }
            Session::put("cart", $cart);
            return $cart;
        } else {
            return redirect("/");
        }
    }

    public function delProduct($id)
    {
        $cart = Session::get("cart");
        foreach ($cart as $key => $value) {
            if ($id == $key) {
                unset($cart[$key]);
                if (count($cart) == 0) { //het san pham trong gio
                    Session::forget("cart");
                } else {
                    Session::put("cart", $cart);
                }
                return true;
            }
        }
        return true;
    }

    public function delCart()
    {
        Session::forget("cart");
    }

    public function getProduct()
    {
        $cart = [];
        if (Session::has("cart")) {
            $temp = Session::get("cart");
            $array_id = array_keys($temp);
            $cart = Products::getProductById($array_id, "array");
            /* them field so luong*/
            foreach ($cart as $key => $item) {
                foreach ($temp as $key2 => $item2) {
                    if ($item->id == $key2) $item->so_luong = $item2;
                }
            }
            /******/
            return $cart;
        } else {
            return $cart;
        }
    }

    public function subTotalPrice($cart) //sub total
    {
        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += ($item->price * (100 - $item->percent) / 100) * $item->so_luong;
        }
        return $subTotal;
    }

    public function totalPrice($subTotal , $payment_method , $discount_code)
    {

        $total = $subTotal;
        if ( !is_null($discount_code) ) {
            $percent = DiscountCode::changeCodeToPercent($discount_code);
            $total *= (1 - $percent / 100);
        }
        if ( !is_null($payment_method) ) {

        }
        return $total;
    }

}