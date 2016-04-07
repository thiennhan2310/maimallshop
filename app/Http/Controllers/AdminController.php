<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/13/2016
 * Time: 4:37 PM
 */

namespace App\Http\Controllers;


use App\Bill;
use App\billDetail;
use App\Cate;
use App\Discount;
use App\Http\Requests\ProductRequest;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function Home()
    {
        if (Auth::check()) {
            if ( Auth::user()->email == "admin@maimallshop.com" ) {
                $newBillCount = count(Bill::NewBill());
                return view("admin.layout" , compact("newBillCount"));
            }
            else
                return redirect()->route("home");
        } else {
            return view("pages.login");
        }
    }

    public function ProductList()
    {
        $newBillCount = count(Bill::NewBill());
        $products = Products::select(["id" , "name" , "price"])->paginate(100);
        $products->setPath("list");
        return view("admin.sanpham.list" , compact("products" , "newBillCount"));
    }

    public function ProductGetAdd()
    {
        $newBillCount = count(Bill::NewBill());
        $cate = Cate::select(["id", "name"])->where("parent_id", "!=", "0")->where("parent_id", "!=", "1")->orderBy("name")->get();
        return view("admin.sanpham.add" , compact("cate" , "newBillCount"));
    }

    public function ProductPostAdd(ProductRequest $request)
    {
        $id = $request->get("id");
        $name = $request->get("name");
        $alias = str_slug($name);
        $cate = $request->get("cate");
        $brand = $request->get("brand");
        $price = $request->get("price");
        $size = $request->get("size");
        $img = $request->file("img");
        $img1 = "";
        $img2 = "";
        $img3 = "";
        $img4 = "";
        for ($i = 1; $i <= count($img); $i++) {
            switch ($i) {
                case 1:
                    $img1 = date("jnyGis") . $img[$i - 1]->getClientOriginalName();
                    $img[$i - 1]->move("public/products/", $img1);
                    break;
                case 2:
                    $img2 = date("jnyGis") . $img[$i - 1]->getClientOriginalName();
                    $img[$i - 1]->move("public/products", $img2);
                    break;
                case 3:
                    $img3 = date("jnyGis") . $img[$i - 1]->getClientOriginalName();
                    $img[$i - 1]->move("public/products", $img3);
                    break;
                case 4:
                    $img4 = date("jnyGis") . $img[$i - 1]->getClientOriginalName();
                    $img[$i - 1]->move("public/products", $img4);
                    break;
            }
        }
        $detail = $request->get("detail");
        $status = $request->get("status");
        $result = Products::create(["id" => $id, "name" => $name, "alias" => $alias,
            "cate_id" => $cate, "brand" => $brand, "size" => $size, "price" => $price,
            "img1" => $img1, "img2" => $img2, "img3" => $img3, "img4" => $img4, "description" => $detail, "status" => $status]);
        if ($result) {
            $result = "Thêm sản phẩm thành công";
        } else {
            $result = "Chưa thêm được";
        }
        return redirect()->route("admin.product.getAdd")->with("result", $result);
    }

    public function ProductGetEdit($id)
    {
        $newBillCount = count(Bill::NewBill());
        $product = Products::getProductById($id);
        $cate = Cate::select(["id", "name"])->where("parent_id", "!=", "0")->where("parent_id", "!=", "1")->orderBy("name")->get();
        return view("admin.sanpham.edit" , compact("product" , "cate" , "newBillCount"));
    }

    public function ProductPostEdit(ProductRequest $request, $id)
    {
        $name = $request->get("name");
        $alias = str_slug($name);
        $cate = $request->get("cate");
        $brand = $request->get("brand");
        $price = $request->get("price");
        $size = $request->get("size");
        $img = $request->file("img"); //new img
        $currentImg = $request->get("currentImg");//current img
        $imgDel = $request->get("imgDel"); //img del
        $detail = $request->get("detail");
        $status = $request->get("status");
        /** Luu thong tin hinh cu**/
        $img1 = "";
        $img2 = "";
        $img3 = "";
        $img4 = "";
        if (isset($currentImg[0])) $img1 = $currentImg[0];
        if (isset($currentImg[1])) $img2 = $currentImg[1];
        if (isset($currentImg[2])) $img3 = $currentImg[2];
        if (isset($currentImg[3])) $img4 = $currentImg[3];
        /****Them hinh moi****/
        for ($i = 1; $i <= count($img); $i++) {
            switch ($i) {
                case 1:
                    if (!is_null($img[$i - 1])) {
                        $img1 = date("jnyGis") . $img[$i - 1]->getClientOriginalName();
                        $img[$i - 1]->move("public/products/", $img1);
                    }
                    break;
                case 2:
                    if (!is_null($img[$i - 1])) {
                        $img2 = date("jnyGis") . $img[$i - 1]->getClientOriginalName();
                        $img[$i - 1]->move("public/products", $img2);
                    }
                    break;
                case 3:
                    if (!is_null($img[$i - 1])) {
                        $img3 = date("jnyGis") . $img[$i - 1]->getClientOriginalName();
                        $img[$i - 1]->move("public/products", $img3);
                    }
                    break;
                case 4:
                    if (!is_null($img[$i - 1])) {
                        $img4 = date("jnyGis") . $img[$i - 1]->getClientOriginalName();
                        $img[$i - 1]->move("public/products", $img4);
                    }
                    break;
            }
        }
        /**Xoa hinh cu**/
        $this->deleteImage($imgDel);
        /***************/
        $product = Products::find($id);
        $product->name = $name;
        $product->alias = $alias;
        $product->cate_id = $cate;
        $product->brand = $brand;
        $product->description = $detail;
        $product->price = $price;
        $product->size = $size;
        $product->status = $status;
        $product->img1 = $img1;
        $product->img2 = $img2;
        $product->img3 = $img3;
        $product->img4 = $img4;
        $result = $product->save();
        if ($result) {
            $result = "Cập nhật sản phẩm thành công";
        } else {
            $result = "Chưa cập nhật được";
        }
        return redirect()->route("admin.product.list")->with("result", $result);
    }

    private function deleteImage($imgDel)
    {
        if (isset($imgDel)) {
            foreach ($imgDel as $img) {
                $url = "public/products/" . $img;
                if (File::exists($url)) {
                    File::delete($url);
                }
            }
        }
    }

    public function ProductGetDelete($id)
    {
        $product = Products::find($id);
        $img = [$product->img1, $product->img2, $product->img3, $product->img4];
        $this->deleteImage($img);
        $product->delete();
        return redirect()->route("admin.product.list")->with("result", "Xóa thành công");
    }

    public function DiscountList()
    {
        $newBillCount = count(Bill::NewBill());
        $discount = Discount::select(["id", "name", "percent", "start", "end"])->paginate(10);
        return view("admin.giamgia.list" , compact("discount" , "newBillCount"));
    }

    public function DiscountGetEdit($id)
    {
        $newBillCount = count(Bill::NewBill());
        $detail = Discount::find($id);
        $dicountedCate = Cate::getCateOnDiscount($id);
        $discountedCateID = [];

        foreach ( $dicountedCate as $item ) {
            $discountedCateID[] = $item->id;
        }

        $cateAll = Cate::select(["id", "discount_id", "name"])->get();
        return view("admin.giamgia.edit" , compact("detail" , "discountedCateID" , "cateAll" , "newBillCount"));
    }

    public function DiscountPostEdit(Request $request , $id)
    {
        $discount = Discount::find($id);
        $discount->name = $request->get("name");
        $discount->percent = $request->get("percent");
        $discount->description = $request->get("description");
        $discount->start = $request->get("start");
        $discount->end = $request->get("end");
        $discount->save();

        $cateId = $request->get("loai");
        foreach ( $cateId as $item ) {
            Cate::where("id" , $item)->update(["discount_id" => $id]);
        }
        return redirect()->route("admin.discount.list");
    }

    public function DiscountGetAdd()
    {
        $newBillCount = count(Bill::NewBill());
        $cateAll = Cate::select(["id" , "discount_id" , "name"])->get();
        return view("admin.giamgia.add" , compact("cateAll" , "newBillCount"));
    }

    public function DiscountPostAdd(Request $request)
    {
        $name = $request->get("name");
        $percent = $request->get("percent");
        $description = $request->get("description");
        $start = $request->get("start");
        $end = $request->get("end");
        $discount = Discount::create(["name" => $name , "percent" => $percent , "description" => $description ,
            "start" => $start , "end" => $end
        ]);
        $discountId = $discount->id;
        $cateId = $request->input("loai");
        foreach ( $cateId as $item ) {
            Cate::where("id" , $item)->update(["discount_id" => $discountId]);
        }
        return redirect()->route("admin.discount.list");
    }

    public function DiscountGetDelete($id)
    {
        Cate::where("discount_id" , $id)->update(["discount_id" => 0]);
        $discount = Discount::find($id);
        $discount->delete();
        return redirect()->route("admin.discount.list");
    }

    public function ListNewBill()
    {
        $bill = Bill::NewBill();
        $newBillCount = count(Bill::NewBill());
        $bill->setPath("list");
        $action = "Mới";
        return view("admin.hoadon.list" , compact("bill" , "action" , "newBillCount"));
    }

    public function ListDeliveryBill()
    {

        $bill = Bill::DeliveryBill();
        $newBillCount = count(Bill::NewBill());
        $bill->setPath("list");
        $action = "Chờ giao hàng";
        return view("admin.hoadon.list" , compact("bill" , "action" , "newBillCount"));
    }

    public function ListSuccessBill()
    {
        $newBillCount = count(Bill::NewBill());
        $bill = Bill::SuccessBill();
        $bill->setPath("list");
        $action = "Thành Công";
        return view("admin.hoadon.list" , compact("bill" , "action" , "newBillCount"));
    }

    public function DetailBill(Request $request , $billId)
    {
        if ( $request->ajax() ) {
            $detail = billDetail::getProducts($billId);
            $string = "";
            foreach ( $detail as $item ) {
                $string = "<td>" . $item->products_id . "</td>";
                $string .= "<td>" . $item->name . "</td>";
                $string .= "<td>" . $item->amount . "</td>";
                $string .= "<td>" . $item->price . "</td>";
            }
            return json_encode(["result" => $string]);
        }
    }

    public function ConfirmBill(Request $request , $billID)
    { /*
        * 3 : new
         *2 : delivering
         *1 : complete
        */
        if ( $request->ajax() ) {
            $bill = Bill::find($billID);
            if ( $bill->status == 3 ) {
                $bill->status = 2;
            } elseif ( $bill->status == 2 ) {
                $bill->status = 1;
            }
            $bill->save();

        }
    }

    public function DelBill(Request $request , $billID)
    {
        if ( $request->ajax() ) {
            $bill = Bill::find($billID);
            $bill->delete();
        }
    }
}