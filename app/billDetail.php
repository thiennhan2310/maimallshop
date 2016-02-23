<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class billDetail extends Model {

	//
    public $timestamps = false;
    protected $table="bill_details";
    protected $fillable = ['bill_id', 'products_id', 'price',"amount"];

    public static function getProducts($billID)
    {
        $billDetail = billDetail::join("products" , "products.id" , "=" , "bill_details.products_id")
            ->select(["products.name" , "bill_details.*"])->where("bill_details.bill_id" , $billID)->get();
        return $billDetail;
    }

    public function bill(){
        return $this->belongsTo('App\Bill');
    }

    public function product(){
        return $this->hasOne('App\Products');
    }
}
