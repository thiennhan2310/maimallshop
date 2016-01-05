<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/4/2016
 * Time: 11:19 PM
 */

namespace App\Http\Controllers;
use App\Products;

class PageController extends Controller
{

    public function index(){
        $giam_gia=Products::getSaleProducts();
        $sp_moi=Products::getNewestProducts();
        $sp_banchay=Products::getBestSellProducts();
        $my_pham=Products::getProductsOnCate(1);
        $thoi_trang=Products::getProductsOnCate(2);
        $suc_khoe=Products::getProductsOnCate(3);
        return view("pages.index",compact("giam_gia","sp_moi","sp_banchay","child","my_pham","thoi_trang","suc_khoe"));
    }

}