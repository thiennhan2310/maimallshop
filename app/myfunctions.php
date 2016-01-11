<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/11/2016
 * Time: 11:11 AM
 */
 function countProducts()
{
    $tsl=0;
    if(Session::has("cart")){
        $cart=Session::get("cart");
        foreach($cart as $ma=>$sl){
            $tsl+=$sl;
        }
    }
    return $tsl;
}

?>