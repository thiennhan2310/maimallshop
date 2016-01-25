<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    public $timestamps = true;
    protected $table = "products";
    protected $fillable = ['id', 'cate_id', 'name', "alias", 'price', 'img1', 'img2', 'img3', 'img4', 'description', 'brand', 'size', 'status'];

    public static function getSaleProducts($limit) //get san pham giam gia
    {
        $saleProducts = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
            ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])->where("cates.discount_id", "!=", "0")
            ->orderBy("products.updated_at")->paginate($limit);
        return $saleProducts;
    }

    public static function getNewestProducts($limit)
    {
        $newProducts = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
            ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
            ->orderBy("products.updated_at")->paginate($limit);
        return $newProducts;
    }

    public static function getBestSellProducts($limit)
    {
        $bestSell = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
            ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
            ->orderBy("products.count", "desc")
            ->orderBy("products.updated_at")->paginate($limit);
        return $bestSell;
    }
    /* Lay san pham giam gia */

    public static function getProductsOnCate($cate_id, $limit)
    {   /*Tim danh sach con neu co*/
        $arrayChildCateId = [];
        if ($cate_id == 1) { // loai my pham
            $arrayChildCateId = Cate::getSecChildId($cate_id);
        } else { //loai thoitrang suckhoe
            $arrayChildCateId = Cate::getFirstChildId($cate_id);
        }
        if (count($arrayChildCateId) > 0) { //Co con
            $products = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
                ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
                ->whereIn("cate_id", $arrayChildCateId)
                ->orderBy("products.updated_at")->paginate($limit);
        } else { //Khong co con
            $products = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
                ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
                ->where("cate_id", $cate_id)
                ->orderBy("products.updated_at")->paginate($limit);
        }
        return $products;
    }

    /* Lay san pham moi nhat*/

    public static function getProductByAlias($alias)
    {
        $products = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
            ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
            ->where("products.alias", $alias)->first();
        return $products;
    }

    /* Lay san pham ban chay*/

    public static function getProductsSameCate($cateId, $productId)
    {
        $products = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
            ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
            ->where("products.cate_id", $cateId)->where("products.id", "!=", $productId)->take(5)->get();
        return $products;
    }

    /*lay san pham theo loai*/

    public static function getProductById($id, $type = "single")
    {
        $products = [];
        if ($type == "single") {
            $products = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
                ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
                ->where("products.id", $id)->first();
        } else if ($type == "array") {
            $products = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
                ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
                ->whereIn("products.id", $id)->get();
        }
        return $products;
    }

    /*lay san pham theo alias*/

    public static function getProductByName($name, $limit)
    {
        $products = Products::Join("cates", "products.cate_id", "=", "cates.id")->join("discounts", "discounts.id", "=", "cates.discount_id")
            ->select(["products.*", "cates.name as cate", "cates.alias as cate_alias", "discounts.percent as percent"])
            ->where("products.name", "like", "%" . $name . "%")->paginate($limit);
        return $products;
    }
    /*lay san pham cung loai tru san pham chinh*/

    public function cate()
    {
        return $this->belongsTo('App\Cate');
    }
    /*lay san pham theo id*/

    public function bill_detail()
    {
        return $this->belongsToMany('App\billDetail', 'bill_details', 'products_id');
    }

    public function love_list_detail()
    {
        return $this->belongsToMany('App\billDetail', 'love_list_detail', 'product_id');
    }

}
