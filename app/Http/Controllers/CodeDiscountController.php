<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 4/13/2016
 * Time: 8:54 PM
 */

namespace App\Http\Controllers;

use App\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CodeDiscountController extends Controller
{
    public function useCode(Request $request)
    {
        if ( $request->ajax() ) {
            $code = $request->get("code");
            $percent = DiscountCode::changeCodeToPercent($code);
            $cart = new CartController();
            $products = $cart->getProduct();
            $total = $cart->subTotalPrice($products);
            $total = $total * ($percent / 100);
            $total = number_format($total);
            Session::put("codeDiscount" , $code);
            return $total;
        } else {
            return redirect()->route("home");
        }
    }


}