<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Products extends Model {

	//
    protected $table="products";
    protected $fillable = ['id', 'cate_id', 'name',"alias",'price','img1','img2','img3','img4','description','brand','size','status'];
    public $timestamps = false;
    public function cate(){
        return $this->belongsTo('App\Cate');
    }
    public function bill_detail(){
        return $this->belongsToMany('App\billDetail','bill_details','products_id');
    }
    /* Lay san pham giam gia */
    public static function getSaleProducts(){
        $saleProducts=Products::Join("cates","products.cate_id","=","cates.id")->join("discounts","discounts.id","=","cates.discount_id")
            ->select(["products.*","cates.name as cate","cates.alias as cate_alias","discounts.percent as percent"])->where("cates.discount_id","!=","0")
            ->orderBy("products.updated_at")->take(10)->get();
        return $saleProducts;
    }
    /* Lay san pham moi nhat*/
    public static function getNewestProducts(){
        $newProducts=Products::Join("cates","products.cate_id","=","cates.id")->join("discounts","discounts.id","=","cates.discount_id")
            ->select(["products.*","cates.name as cate","cates.alias as cate_alias","discounts.percent as percent"])
            ->orderBy("products.updated_at")->take(10)->get();
        return $newProducts;
    }
    /* Lay san pham ban chay*/
    public static function getBestSellProducts(){
        $bestSell=Products::Join("cates","products.cate_id","=","cates.id")->join("discounts","discounts.id","=","cates.discount_id")
            ->select(["products.*","cates.name as cate","cates.alias as cate_alias","discounts.percent as percent"])
            ->orderBy("products.count","desc")
            ->orderBy("products.updated_at")->take(10)->get();
        return $bestSell;
    }
    /*lay san pham theo loai*/
    public static function getProductsOnCate($cate_id){
        $arrayChildCateId=[];
        if($cate_id==1){ // loai my pham
            $arrayChildCateId=Cate::getSecChildId($cate_id);
        }
        else{
            $arrayChildCateId=Cate::getFirstChildId($cate_id);
        }
        $products=Products::Join("cates","products.cate_id","=","cates.id")->join("discounts","discounts.id","=","cates.discount_id")
            ->select(["products.*","cates.name as cate","cates.alias as cate_alias","discounts.percent as percent"])
            ->whereIn("cate_id",$arrayChildCateId)
            ->orderBy("products.updated_at")->take(10)->get();
        return $products;
    }

}
