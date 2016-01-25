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
use App\Products;
use Illuminate\Support\Facades\Auth;

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
            $arrayCurrentCateName=[["name"=> "Sản phẩm mới"]];
        } elseif ($cate == "ban-chay") {
            $products = Products::getBestSellProducts($limit);
            $arrayCurrentCateName=[["name"=> "Sản phẩm bán chạy"]];
        } elseif ($cate == "giam-gia") {
            $products = Products::getSaleProducts($limit);
            $arrayCurrentCateName=[["name"=> "Sản phẩm giảm giá"]];
        } else {
            $cateId = Cate::getIdByAlias($cate);//$cate=alias
            $products = Products::getProductsOnCate($cateId, $limit);
            $parentId = Cate::getParentId($cateId);
            $arrayCurrentCateName = Cate::getNameById($cateId);
            $arrayParentName = Cate::getNameById($parentId);// duong dan
        }
        $products->setPath($cate);
        return view("pages.list_products", compact("products", "arrayParentName", "arrayCurrentCateName"));
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
        return view("pages.detail_products", compact("product", "arrayParentName", "arrayCurrentCateName", "productSameCate"));
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
        $products=Products::getProductByName($request->get("ten_san_pham"),25);
        $products->setPath("tim-kiem");
        $count=count($products);
        $arrayCurrentCateName=[["name"=> "Có $count sản phẩm tìm thấy"]];
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
        return redirect()->route("home");
    }

    public function CustomerInfoTemplate()
    {
        return view("pages.customer_info");
    }

    public function CustomerInfo()
    {
        return view("pages.customerInfo.info");
    }

    public function CartInfo()
    {
        return view("pages.customerInfo.cart");
    }

    public function LoveProduct()
    {
        return view("pages.customerInfo.love");
    }
}