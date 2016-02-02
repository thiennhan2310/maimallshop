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
    public function AddLovedProduct($product_id , $list_id = 0)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                $customer_id = Auth::user()->id;
                /*lay id cua danh sach mac dinh*/
                if ( $list_id == 0 ) {
                    $default_list_id = LoveList::select(["id"])->where("name" , "danh sách mặc định")->where("customer_id" , $customer_id)->first();
                    $list_id = $default_list_id->id;
                }
                /*them san pham vao danh sach*/
                /*Kiem tra san pham da co trong yeu thich*/
                $array_list_id = LoveList::select(["id"])->where("customer_id" , $customer_id)->get()->toArray();
                $count = LoveListDetail::whereIn("list_id" , $array_list_id)->where("product_id" , $product_id)->count();
                if ( $count > 0 ) {
                    return json_encode(["result" => "Sản phẩm đã trong yêu thích"]);
                } else {
                    LoveListDetail::create(["list_id" => $list_id , "product_id" => $product_id]);
                    return json_encode(["result" => "Thêm yêu thích thành công"]);
                }

            } else {
                return redirect()->route("login");
            }
        } else {
            return redirect()->route("home");
        }
    }

    /* xoa san pham yeu thich*/
    public function DelLovedProduct($product_id , $list_id)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                /*del san pham */
                LoveListDetail::where("list_id" , $list_id)->where("product_id" , $product_id)->delete();
                return json_encode(["result" => "success"]);
            } else {
                return redirect()->route("login");
            }
        } else {
            return redirect()->route("login");
        }
    }

    /*xoa danh sach yeu thich*/
    public function DelLoveList($list_id)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                LoveList::where("id" , $list_id)->delete();
                return json_encode(["result" => "Đã xoá danh sách"]);
            }
        } else {
            return redirect()->route("home");
        }
    }

    /*Chuyen san pham(id) tu->den*/
    public function MoveLovedProduct($product , $from , $to)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                LoveListDetail::where("list_id" , $from)->where("product_id" , $product)->update(["list_id" => $to]);
                return json_encode(["result" => "success"]);
            } else {
                return redirect()->route("login");
            }
        } else {
            return redirect()->route("login");
        }

    }

    /*Tao danh sach moi*/
    public function CreateLoveList($name)
    {
        if ( Auth::check() ) {
            $customer_id = Auth::user()->id;
            /*kiem tra trung name*/
            if ( LoveList::where("name" , $name)->where("customer_id" , $customer_id)->count() > 0 )
                $exist = true;
            else
                $exist = false;
            /*tao danh sach*/
            if ( $exist ) {
                return json_encode(["resutl" => "Tên danh sách đã tồn tại"]);
            } else { //them vao
                LoveList::create(["customer_id" => $customer_id , "name" => $name]);
                return json_encode(["resutl" => "Tạo danh sách thành công"]);
            }
        } else {
            return redirect()->route("login");
        }
    }
}