<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 1/13/2016
 * Time: 4:37 PM
 */

namespace App\Http\Controllers;


use App\Cate;
use App\Http\Requests\ProductRequest;
use App\Products;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function Home()
    {
        return view("admin.layout");
    }

    public function ProductList()
    {
        $products = Products::select(["id", "name", "price"])->paginate(10);
        $products->setPath("list");
        return view("admin.sanpham.list", compact("products"));
    }

    public function ProductGetAdd()
    {
        $cate = Cate::select(["id", "name"])->where("parent_id", "!=", "0")->where("parent_id", "!=", "1")->orderBy("name")->get();
        return view("admin.sanpham.add", compact("cate"));
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
        return redirect()->route("admin.product.getAdd")->with("result",$result);
    }

    public function ProductGetEdit($id)
    {
        $product = Products::getProductById($id);
        $cate = Cate::select(["id", "name"])->where("parent_id", "!=", "0")->where("parent_id", "!=", "1")->orderBy("name")->get();
        return view("admin.sanpham.edit", compact("product", "cate"));
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
        return redirect()->route("admin.product.list")->with("result",$result);
    }

    public function ProductGetDelete($id)
    {
        $product=Products::find($id);
        $img=[$product->img1,$product->img2,$product->img3,$product->img4];
        $this->deleteImage($img);
        $product->delete();
        return redirect()->route("admin.product.list")->with("result","Xóa thành công");
    }
    private function deleteImage($imgDel){
        if (isset($imgDel)) {
            foreach ($imgDel as $img) {
                $url = "public/products/" . $img;
                if(File::exists($url)){
                    File::delete($url);
                }
            }
        }
    }
}