<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/23/2016
 * Time: 11:28 AM
 */

namespace App\Http\Controllers;


use App\LoveList;
use App\LoveListDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoveListController extends Controller
{
    public function AddLoveProduct($product_id, $list_id = 0)
    {
        if (Request::ajax()) {
            if (Auth::check()) {
                $customer_id = Auth::user()->id;
                /*lay id cua danh sach mac dinh*/
                if ($list_id == 0) {
                    $default_list_id = LoveList::select(["id"])->where("name", "danh sách mặc định")->where("customer_id", $customer_id)->first();
                    $list_id = $default_list_id->id;
                }
                /*them san pham vao danh sach*/
                LoveListDetail::create(["list_id" => $list_id, "product_id" => $product_id]);
                return "success";
            } else {
                return redirect()->route("login");
            }
        } else {
            return redirect()->route("home");
        }
    }

    public function DelLoveProduct($product_id, $list_id = 0)
    {
        if (Auth::check()) {
            $customer_id = Auth::user()->id;
            /*lay id cua danh sach mac dinh*/
            if ($list_id == 0) {
                $default_list_id = LoveList::select(["id"])->where("name", "danh sách mặc định")->where("customer_id", $customer_id)->first();
                $list_id = $default_list_id->id;
            }
            /*them san pham vao danh sach*/
            LoveListDetail::where("list_id", $list_id)->where("product_id", $product_id)->delete();
            return "success";
        } else {
            return redirect()->route("login");
        }
    }

    public function Update($list_id)
    {

    }
}