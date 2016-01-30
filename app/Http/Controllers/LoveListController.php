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
                /*Kiem tra san pham da co trong yeu thich*/
                $array_list_id = LoveList::select(["id"])->where("customer_id", $customer_id)->get()->toArray();
                $count = LoveListDetail::whereIn("list_id", $array_list_id)->where("product_id", $product_id)->count();
                if ($count > 0) {
                    return json_encode(["result" => "Sản phẩm đã trong yêu thích"]);
                } else {
                    LoveListDetail::create(["list_id" => $list_id, "product_id" => $product_id]);
                    return json_encode(["result" => "Thêm yêu thích thành công"]);
                }

            } else {
                return redirect()->route("login");
            }
        } else {
            return redirect()->route("home");
        }
    }

    public function DelLoveProduct($product_id)
    {
        if (Auth::check()) {
            /* get customer id*/
            $customer_id = Auth::user()->id;
            /* get list id of customer*/
            $array_list_id = LoveList::select(["id"])->where("customer_id", $customer_id)->get()->toArray();
            /*del san pham */
            LoveListDetail::whereIn("list_id", $array_list_id)->where("product_id", $product_id)->delete();
            return "success";
        } else {
            return redirect()->route("login");
        }
    }

    public function Update($list_id)
    {

    }

    /*Chuyen san pham(id) tu->den*/
    public function MoveLovedProduct($product, $from, $to)
    {
        if (Request::ajax()) {
            if (Auth::check()) {
                LoveListDetail::where("list_id", $from)->where("product_id", $product)->update(["list_id" => $to]);
                return json_encode(["result" => "success"]);
            } else {
                return redirect()->route("login");
            }
        } else {
            return redirect()->route("login");
        }

    }
}