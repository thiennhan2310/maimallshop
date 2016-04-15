<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/4/2016
 * Time: 11:19 PM
 */

namespace App\Http\Controllers;

use App\Cate;
use App\customer;
use App\CustomerInfo;
use App\District;
use App\Http\Requests\FormRequest;
use App\LoveList;
use App\LoveListDetail;
use App\Products;
use App\Province;
use App\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index() //trang chu
    {
        $limit = 10;
        $giam_gia = Products::getSaleProducts($limit);
        $sp_moi = Products::getNewestProducts($limit);
        $sp_banchay = Products::getBestSellProducts($limit);
        $my_pham = Products::getProductsOnCate(1, $limit);
        $thoi_trang = Products::getProductsOnCate(2, $limit);
        $suc_khoe = Products::getProductsOnCate(3, $limit);
        /*Lay san pham da thich*/
        $lovedProductsId = ["0"];
        if (Auth::check()) {
            $lovedProductsId = customer::LovedProduct("id");
        }
        return view("pages.index", compact("giam_gia", "sp_moi", "sp_banchay", "child", "my_pham", "thoi_trang", "suc_khoe", "lovedProductsId"));
    }

    public function listProducts($cate) //trang danh sach san pham
    {

        /* Co alias->tim id->tim chuoi parentId->tim ten loai hien tai->tim ten loai cha     */
        $limit = 25;
        if ($cate == "moi") {
            $products = Products::getNewestProducts($limit);
            $arrayCurrentCateName = [["name" => "Sản phẩm mới"]];
        } elseif ($cate == "ban-chay") {
            $products = Products::getBestSellProducts($limit);
            $arrayCurrentCateName = [["name" => "Sản phẩm bán chạy"]];
        } elseif ($cate == "giam-gia") {
            $products = Products::getSaleProducts($limit);
            $arrayCurrentCateName = [["name" => "Sản phẩm giảm giá"]];
        } else {
            $cateId = Cate::getIdByAlias($cate);//$cate=alias
            $products = Products::getProductsOnCate($cateId, $limit);
            $parentId = Cate::getParentId($cateId);
            $arrayCurrentCateName = Cate::getNameById($cateId);
            $arrayParentName = Cate::getNameById($parentId);// duong dan
        }
        $products->setPath($cate);
        $lovedProductsId = ["0"];
        if (Auth::check()) {
            $lovedProductsId = customer::LovedProduct("id");
        }
        return view("pages.list_products", compact("products", "arrayParentName", "arrayCurrentCateName", "lovedProductsId"));
    }

    public function detailProduct($alias) //trang chi tiet
    {  /*tim san pham*/
        $product = Products::getProductByAlias($alias); //tim san pham
        /*lay thong tin loai san pham*/
        $cateId = Cate::getIdByAlias($product->cate_alias);//$cate=alias
        $parentId = Cate::getParentId($cateId);
        $arrayCurrentCateName = Cate::getNameById($cateId);
        $arrayParentName = Cate::getNameById($parentId);// duong dan
        /*San pham cung loai*/
        $productSameCate = Products::getProductsSameCate($cateId, $product->id);
        $lovedProductsId = ["0"];
        if (Auth::check()) {
            $lovedProductsId = customer::LovedProduct("id");
        }
        return view("pages.detail_products", compact("product", "arrayParentName", "arrayCurrentCateName", "productSameCate", "lovedProductsId"));
    }

    public function shoppingCart() //trang gio hang
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
        return view("pages.shopping_cart" , compact("products" , "subTotal" , "code" , "total"));
    }

    public function searchPage(FormRequest $request , $name = "")//trang tim kiem
    {
        if ( $name != "" ) $tensanpham = $name;
        else $tensanpham = $request->get("ten_san_pham");
        $products = Products::getProductByName($tensanpham , 25);
        $products->setPath("tim-kiem");

        $arrayCurrentCateName = [["name" => "Kết quả tìm kiếm $tensanpham"]];
        $lovedProductsId = ["0"];
        if ( Auth::check() ) {
            $lovedProductsId = customer::LovedProduct("id");
        }
        return view("pages.list_products" , compact("products" , "arrayParentName" , "arrayCurrentCateName" , "lovedProductsId"));
    }

    public function Login() //trang dang nhap
    {
        if (Auth::check())
            return redirect()->route("home");
        else
            return view("pages.login");
    }

    public function Logout() //trang dang xuat
    {
        Auth::logout();
        if (Session::has("cart")) Session::forget("cart");
        if (Session::has("love")) Session::forget("love");
        return redirect()->route("home");
    }

    public function CustomerInfoTemplate()
    {
        if (Auth::check()) {
            return view("pages.customer_info");
        } else {
            return redirect()->route("login");
        }
    }

    public function CustomerInfo() //trang thong tin khach hang
    {
        if (Request::ajax()) {
            if ( Auth::check() ) {
                $customerId = Auth::user()->id;
            $province = Province::select(["provinceid" , "name"])->orderBy("name")->get();
            $district = District::select(["districtid" , "name"])->where("provinceid" , $province[ 0 ]->provinceid)->orderBy("name")->get();
            $ward = Ward::select(["wardid" , "name"])->where("districtid" , $district[ 0 ]->districtid)->orderBy("name")->get();
                $address = CustomerInfo::getAllAddressInfo($customerId); //danh sach dia chi
                return view("pages.customerInfo.info" , compact("province" , "district" , "ward" , "address"));
            }
        } else {
            return redirect()->route("home");
        }
    }

    /*thong tin gio hang trong thong tin khach hang*/
    public function CartInfo()
    {
        if (Request::ajax()) {
            $cart = new CartController();
            $products = $cart->getProduct();
            $total = $cart->subTotalPrice($products);
            return view("pages.customerInfo.cart" , compact("products" , "total"));
        } else {
            return redirect()->route("home");
        }

    }

    public function LoveProduct()
    {
        if (Request::ajax()) {
            $customer_id = Auth::user()->id;
            $default_list_id = Auth::user()->default_list_id;
            $loveList = LoveList::select(["love_list.id", "love_list.name"])->where("love_list.customer_id", $customer_id)->get();
            /*Tao mang love list id*/
            $loveListId = [];
            foreach ($loveList as $item) {
                $loveListId[] = $item->id;
            }
            $lovedProduct = LoveListDetail::join("products", "products.id", "=", "love_list_detail.product_id")
                ->join("cates", "products.cate_id", "=", "cates.id")
                ->join("discounts", "discounts.id", "=", "cates.discount_id")
                ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent", "love_list_detail.list_id", "love_list_detail.updated_at"])
                ->get();
            /*dua danh sach mac dinh len top*/
            $default_list_id = Auth::user()->default_list_id;
            for ( $i = 0 ; $i < count($loveList) ; $i++ ) {
                for ( $j = $i ; $j < count($loveList) ; $j++ ) {
                    if ( $loveList[ $j ]->id == $default_list_id ) {
                        $temp = $loveList[ $j ];
                        $loveList[ $j ] = $loveList[ $i ];
                        $loveList[ $i ] = $temp;
                        break;
                    } else {
                        continue;
                    }
                }
            }

            return view("pages.customerInfo.love", compact("loveList", "lovedProduct"));
        } else {
            return redirect()->route("home");
        }
    }

    public function Signup()
    {
        return view("pages.signup");
    }

    public function PaymentInfo()
    {
        if ( Auth::check() ) {
            if ( Auth::user()->default_info_id == NULL ) {
                $address = "";
            } else {
                $address = CustomerInfo::getAddressInfo(Auth::user()->default_info_id);
            }
        }
        return view("pages.payment_info" , compact("address"));


    }
}