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
//Route::get("/code" , function () {
//	$billInfo = \App\Bill::find(12);
//	var_dump($billInfo);
//});
Route::get("su-dung-ma-giam-gia" , ["as" => "code.useCode" , "uses" => "CodeDiscountController@useCode"]);

Route::get("trang-chu", ["as" => "home", "uses" => "PageController@index"]);
Route::get("san-pham/{cate}/","PageController@listProducts");
Route::get("chi-tiet/{alias}","PageController@detailProduct");
Route::group(['prefix' => 'gio-hang'], function () {
	Route::get("/" , ["as" => "gio-hang" , "uses" => "PageController@shoppingCart"]);
	Route::get("/them/{id}/{num}",["as"=>"gio-hang.them","uses"=>"CartController@addProduct"]);
	Route::post("/cap-nhat",["as"=>"gio-hang.them","uses"=>"CartController@updateCart"]);
	Route::get("/xoa/{id}",["as"=>"gio-hang.xoa","uses"=>"CartController@delProduct"]);
	Route::get("/xoa-het",["as"=>"gio-hang.xoahet","uses"=>"CartController@delCart"]);

});
Route::group(["prefix" => "admin" , "middleware" => "admin"] , function () {
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
		Route::get("add" , ["as" => "admin.discount.getAdd" , "uses" => "AdminController@DiscountGetAdd"]);
		Route::post("add" , ["as" => "admin.discount.postAdd" , "uses" => "AdminController@DiscountPostAdd"]);

		Route::get("delete/{id}", ["as" => "admin.discount.getDelete", "uses" => "AdminController@DiscountGetDelete"]);
	});
	Route::group(["prefix" => "bill"] , function () {
		Route::get("/" , ["as" => "admin.bill"]);
		Route::get("list-new" , ["as" => "admin.billnew.list" , "uses" => "AdminController@ListNewBill"]);
		Route::get("list-delivery" , ["as" => "admin.billdelivery.list" , "uses" => "AdminController@ListDeliveryBill"]);
		Route::get("list-success" , ["as" => "admin.billsuccess.list" , "uses" => "AdminController@ListSuccessBill"]);
		Route::get("detail-bill/{id}" , ["as" => "admin.bill.detail" , "uses" => "AdminController@DetailBill"]);
		Route::get("confirm-bill/{id}" , ["as" => "admin.bill.confirm" , "uses" => "AdminController@ConfirmBill"]);
		Route::get("delete-bill/{id}" , ["as" => "admin.bill.delete" , "uses" => "AdminController@DelBill"]);
	});

});
Route::post("tim-kiem","PageController@searchPage");
Route::group(["prefix" => "khach-hang"] , function () {
	Route::get("dang-nhap" , ["as" => "login" , "uses" => "PageController@Login"]);
	Route::post("dang-nhap" , ["as" => "login.post" , "uses" => "Auth\AuthController@Login"]);
	Route::get("dang-xuat" , ["as" => "logout" , "uses" => "PageController@Logout"]);
	Route::get("dang-ki" , ["as" => "signup" , "uses" => "PageController@SignUp"]);

	Route::post("dang-ki" , ["as" => "signup.post" , "uses" => "Auth\AuthController@Signup"]);
	Route::get("lay-lai-mat-khau" , ["as" => "reset.password.get" , "uses" => "PageController@ResetPassword"]);
	Route::post("lay-lai-mat-khau" , ["as" => "reset.password.post" , "uses" => "CustomerController@ResetPassword"]);
});


Route::group(["prefix" => "thong-tin-tai-khoan"], function () {
	Route::get("/" , ["as" => "thongtin.template" , "uses" => "PageController@CustomerInfoTemplate"]);
	Route::get("/thong-tin", ["as" => "thongtin", "uses" => "PageController@CustomerInfo"]);
	Route::get("/gio-hang", ["as" => "giohang", "uses" => "PageController@CartInfo"]);
	Route::get("/yeu-thich", ["as" => "yeuthich", "uses" => "PageController@LoveProduct"]);
});
Route::group(["prefix" => "/yeu-thich"], function () {
	Route::get("them/{product_id}/{list_id?}" , ["as" => "yeuthich.sanpham.them" , "uses" => "LoveListController@AddLovedProduct"]);
	Route::get("xoa/{product_id?}" , ["as" => "yeuthich.sanpham.xoa" , "uses" => "LoveListController@DelLovedProduct"]);
	Route::get("chuyen/{product_id}/{list_id_from}/{list_id_to}", ["as" => "yeuthich.sanpham.chuyen", "uses" => "LoveListController@MoveLovedProduct"]);
	Route::get("tao-danh-sach/{list_name}" , ["as" => "yeuthich.danhsach.tao" , "uses" => "LoveListController@CreateLoveList"]);
	Route::get("xoa-danh-sach/{list_id}" , ["as" => "yeuthich.danhsach.xoa" , "uses" => "LoveListController@DelLoveList"]);
	Route::get("doi-ten-danh-sach/{list_id}/{new_name}" , ["as" => "yeuthich.danhsach.suaten" , "uses" => "LoveListController@ChangeNameLoveList"]);
	Route::get("danh-sach-mac-dinh/{list_id}" , ["as" => "yeuthich.danhsach.macdinh" , "uses" => "LoveListController@SetDefaultList"]);
});
Route::group(["prefix" => "/thong-tin"] , function () {
	Route::get("thay-doi/{first_name}/{last_name}/{gender}/{birthday}" , ["as" => "thongtin.canhan.doi" , "uses" => "CustomerController@ChangeCustomerInfo"]);
	Route::post("doi-mat-khau/{password_old}/{password}/{password_confirmation}" , ["as" => "thongtin.matkhau.doi" , "uses" => "CustomerController@ChangePassword"]);
	Route::post("them-dia-chi" , ["as" => "thongtin.diachi.them" , "uses" => "CustomerController@AddAddress"]);
	Route::post("doi-dia-chi" , ["as" => "thongtin.diachi.doi" , "uses" => "CustomerController@ChangeAddress"]);
	Route::get("xoa-dia-chi/{customerInfoID}" , ["as" => "thongtin.diachi.xoa" , "uses" => "CustomerController@DelAddress"]);
});
Route::group(["prefix" => "/thanh-toan"] , function () {
	Route::get("thong-tin" , ["as" => "thanhtoan.thongtin" , "uses" => "PageController@PaymentInfo"]);
	Route::get("dang-nhap" , ["as" => "thanhtoan.thongtin.dangnhap" , "uses" => "PaymentController@Login"]);
	Route::get("dia-chi" , ["as" => "thanhtoan.thongtin.diachi" , "uses" => "PaymentController@Address"]);
	Route::post("dia-chi" , ["as" => "post.thanhtoan.thongtin.diachi" , "uses" => "PaymentController@postAddress"]);
	Route::get("phuong-thuc" , ["as" => "thanhtoan.thongtin.phuongthuc" , "uses" => "PaymentController@Method"]);
	Route::get("phuong-thuc/{id}" , ["as" => "thanhtoan.thongtin.phuongthuc.chon" , "uses" => "PaymentController@PostMethod"]);
	Route::get("gio-hang" , ["as" => "thanhtoan.thongtin.giohang" , "uses" => "PaymentController@Cart"]);
	Route::post("hoan-tat" , ["as" => "thanhtoan.thongtin.hoantat" , "uses" => "PaymentController@Finish"]);
	Route::get("hoa-don/{id}" , ["as" => "thanhtoan.thongtin.hoadon" , "uses" => "PaymentController@BillDetail"]);

});
/*thong tin phuong xa*/
Route::get("thanh-pho" , ["as" => "province" , "uses" => "CityController@GetProvince"]);
Route::get("quan/{provinceid}" , ["as" => "district" , "uses" => "CityController@GetDistrict"]);
Route::get("phuong/{districtid}" , ["as" => "district" , "uses" => "CityController@GetWard"]);
Route::get("/{string}" , "PageController@searchPage");

//Route::get("hash",function(){
//	echo Hash::make("admin!@#$%");
//});


Route::controllers([
	'password' => 'Auth\PasswordController' ,
]);