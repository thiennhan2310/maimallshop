<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/4/2016
 * Time: 11:19 PM
 */

namespace App\Http\Controllers;

use App\Cate;
use App\Products;

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
        return view("pages.index", compact("giam_gia", "sp_moi", "sp_banchay", "child", "my_pham", "thoi_trang", "suc_khoe"));
    }

    public function listProducts($cate) //trang danh sach san pham
    {
        /* Co alias->tim id->tim chuoi parentId->tim ten loai hien tai->tim ten loai cha     */
        $limit = 25;
        $cateId = Cate::getIdByAlias($cate);//$cate=alias
        $products = Products::getProductsOnCate($cateId, $limit);
        $products->setPath($cate);
        $parentId = Cate::getParentId($cateId);
        $arrayCurrentCateName = Cate::getNameById($cateId);
        $arrayParentName = Cate::getNameById($parentId);// duong dan
        return view("pages.list_products", compact("products", "arrayParentName", "arrayCurrentCateName"));
    }

    public function detailProduct($alias) //trang chi tiet
    {  /*tim san pham*/
        $product=Products::getProductByAlias($alias); //tim san pham
        /*lay thong tin loai san pham*/
        $cateId = Cate::getIdByAlias($product->cate_alias);//$cate=alias
        $parentId = Cate::getParentId($cateId);
        $arrayCurrentCateName = Cate::getNameById($cateId);
        $arrayParentName = Cate::getNameById($parentId);// duong dan
        /*San pham cung loai*/
        $productSameCate=Products::getProductsSameCate($cateId,$product->id);
        return view("pages.detail_products",compact("product","arrayParentName", "arrayCurrentCateName","productSameCate"));
    }


}