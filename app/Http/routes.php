<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get("/","PageController@index");
Route::get("trang-chu", ["as" => "home", "uses" => "PageController@index"]);
Route::get("san-pham/{cate}/","PageController@listProducts");
Route::get("chi-tiet/{alias}","PageController@detailProduct");
Route::group(['prefix' => 'gio-hang'], function () {
	Route::get('/', "PageController@shoppingCart" );
	Route::get("/them/{id}/{num}",["as"=>"gio-hang.them","uses"=>"CartController@addProduct"]);
	Route::post("/cap-nhat",["as"=>"gio-hang.them","uses"=>"CartController@updateCart"]);
	Route::get("/xoa/{id}",["as"=>"gio-hang.xoa","uses"=>"CartController@delProduct"]);
	Route::get("/xoa-het",["as"=>"gio-hang.xoahet","uses"=>"CartController@delCart"]);

});
Route::group(["prefix" => "admin"],function(){
	Route::get("/",["as"=>"admin.home","uses"=>"AdminController@Home"]);
	Route::group(["prefix"=>"product"],function(){
		Route::get("list",["as"=>"admin.product.list","uses"=>"AdminController@ProductList"]);
		Route::get("add",["as"=>"admin.product.getAdd","uses"=>"AdminController@ProductGetAdd"]);
		Route::post("add",["as"=>"admin.product.postAdd","uses"=>"AdminController@ProductPostAdd"]);
		Route::get("edit/{id}",["as"=>"admin.product.getEdit","uses"=>"AdminController@ProductGetEdit"]);
		Route::post("edit/{id}",["as"=>"admin.product.postEdit","uses"=>"AdminController@ProductPostEdit"]);
		Route::get("delete/{id}",["as"=>"admin.product.getDelete","uses"=>"AdminController@ProductGetDelete"]);
	});
	Route::group(["prefix" => "discount"], function () {
		Route::get("list", ["as" => "admin.discount.list", "uses" => "AdminController@DiscountList"]);
		Route::get("edit/{id}", ["as" => "admin.discount.getEdit", "uses" => "AdminController@DiscountGetEdit"]);
		Route::post("edit/{id}", ["as" => "admin.discount.postEdit", "uses" => "AdminController@DiscountPostEdit"]);
		Route::get("delete/{id}", ["as" => "admin.discount.getDelete", "uses" => "AdminController@DiscountGetDelete"]);
	});

});
Route::post("tim-kiem","PageController@searchPage");
Route::group(["prefix" => "khach-hang"] , function () {
	Route::get("dang-nhap" , ["as" => "login" , "uses" => "PageController@Login"]);
	Route::post("dang-nhap" , ["as" => "login.post" , "uses" => "Auth\AuthController@Login"]);
	Route::get("dang-xuat" , ["as" => "logout" , "uses" => "PageController@Logout"]);
	Route::get("dang-ki" , ["as" => "signup" , "uses" => "PageController@SignUp"]);
	Route::post("dang-ki" , ["as" => "signup.post" , "uses" => "Auth\AuthController@Signup"]);
});


Route::group(["prefix" => "thong-tin-tai-khoan"], function () {
	Route::get("/", "PageController@CustomerInfoTemplate");
	Route::get("/thong-tin", ["as" => "thongtin", "uses" => "PageController@CustomerInfo"]);
	Route::get("/gio-hang", ["as" => "giohang", "uses" => "PageController@CartInfo"]);
	Route::get("/yeu-thich", ["as" => "yeuthich", "uses" => "PageController@LoveProduct"]);


});
Route::group(["prefix" => "/yeu-thich"], function () {
	Route::get("them/{product_id}/{list_id?}" , ["as" => "yeuthich.sanpham.them" , "uses" => "LoveListController@AddLovedProduct"]);
	Route::get("xoa/{product_id}/{list_id}" , ["as" => "yeuthich.sanpham.xoa" , "uses" => "LoveListController@DelLovedProduct"]);
	Route::get("chuyen/{product_id}/{list_id_from}/{list_id_to}", ["as" => "yeuthich.sanpham.chuyen", "uses" => "LoveListController@MoveLovedProduct"]);
	Route::get("tao-danh-sach/{list_name}" , ["as" => "yeuthich.danhsach.tao" , "uses" => "LoveListController@CreateLoveList"]);
	Route::get("xoa-danh-sach/{list_id}" , ["as" => "yeuthich.danhsach.xoa" , "uses" => "LoveListController@DelLoveList"]);
	Route::get("doi-ten-danh-sach/{list_id}/{new_name}" , ["as" => "yeuthich.danhsach.suaten" , "uses" => "LoveListController@ChangeNameLoveList"]);

});

//Route::get("hash",function(){
//	echo Hash::make(12345);
//});
