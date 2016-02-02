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
use App\Http\Requests\FormRequest;
use App\LoveList;
use App\LoveListDetail;
use App\Products;
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
        $total = $cart->totalPrice($products);
        return view("pages.shopping_cart", compact("products", "total"));
    }

    public function searchPage(FormRequest $request)//trang tim kiem
    {
        $products = Products::getProductByName($request->get("ten_san_pham"), 25);
        $products->setPath("tim-kiem");
        $count = count($products);
        $arrayCurrentCateName = [["name" => "Có $count sản phẩm tìm thấy"]];
        return view("pages.list_products", compact("products", "arrayParentName", "arrayCurrentCateName"));
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

    public function CustomerInfo()
    {
        if (Request::ajax()) {
            return view("pages.customerInfo.info");
        } else {
            return redirect()->route("home");
        }
    }

    public function CartInfo()
    {
        if (Request::ajax()) {
            return view("pages.customerInfo.cart");
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
}