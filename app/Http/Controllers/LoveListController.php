<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/23/2016
 * Time: 11:28 AM
 */

namespace App\Http\Controllers;


use App\customer;
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
                //them vao danh sach mac dinh
                if ( $list_id == 0 ) {
                    /*lay id cua danh sach mac dinh*/
                    $default_list_id = customer::select(["default_list_id"])->where("id" , $customer_id)->first();
                    $list_id = $default_list_id->default_list_id;;
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
    public function DelLovedProduct($product_id)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                $customer_id = Auth::user()->id;
                /*lay danh sach yeu thich cua customer*/
                $list_id = LoveList::select(["id"])->where("customer_id" , $customer_id)->get()->toArray();
                /*bỏ yeu thich san pham */
                LoveListDetail::whereIn("list_id" , $list_id)->where("product_id" , $product_id)->delete();
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
                if ( Auth::user()->default_list_id == $list_id ) {
                    return json_encode(["result" => "Không thể xoá danh sách mặc định"]);
                } else {
                LoveList::where("id" , $list_id)->delete();
                return json_encode(["result" => "Đã xoá danh sách"]);

                }
            }
        } else {
            return redirect()->route("home");
        }
    }

    /*Doi ten danh sach*/
    public function ChangeNameLoveList($list_id , $new_name)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                /*kiem tra trung name*/
                $customer_id = Auth::user()->id;
                if ( LoveList::where("name" , $new_name)->where("customer_id" , $customer_id)->count() > 0 )
                    $exist = true;
                else
                    $exist = false;

                if ( $exist === true )
                    return json_encode(["result" => "Tên danh sách đã tồn tại"]);
                else {
                    LoveList::where("id" , $list_id)->update(["name" => $new_name]);
                    return json_encode(["result" => "Đã đổi tên danh sách"]);
                }
            } else {
                return redirect()->route("login");
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
        if ( Request::ajax() ) {

        if ( Auth::check() ) {
            $customer_id = Auth::user()->id;
            /*kiem tra trung name*/
            if ( LoveList::where("name" , $name)->where("customer_id" , $customer_id)->count() > 0 )
                $exist = true;
            else
                $exist = false;
            /*tao danh sach*/
            if ( $exist ) {
                return json_encode(["result" => "Tên danh sách đã tồn tại"]);
            } else { //them vao
                LoveList::create(["customer_id" => $customer_id , "name" => $name]);
                return json_encode(["result" => "Tạo danh sách thành công"]);
            }
        } else {
            return redirect()->route("login");
        }
        } else {
            return redirect()->route("home");
        }
    }

    /*set default list*/
    public function SetDefaultList($list_id)
    {
        if ( Request::ajax() ) {
            if ( Auth::check() ) {
                $customer_id = Auth::user()->id;
                customer::where("id" , $customer_id)->update(["default_list_id" => $list_id]);
            }
        }
    }

}