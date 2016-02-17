<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class customer extends Model implements AuthenticatableContract
{

    //
    use Authenticatable;
    public $timestamps = true;
    protected $table = "customers";
    protected $fillable = ['id' , 'email' , 'gender' , 'birthday' , 'default_info_id' , "password" , "remember_token" , 'default_list_id'];

    public static function LovedProduct($get = "all") //lay san pham yeu thich
    {
        $arrayListId = [];
        $arrayProductId = [];
        $detailProducts = [];
        /*get user id*/
        $customer_id = Auth::user()->id;
        /*get list id*/
        $loveListId = LoveList::select(["id"])->where("customer_id", $customer_id)->get();
        foreach ($loveListId as $id) {
            $arrayListId[] = $id->id;
        }
        /*get product id of list*/
        if (isset($arrayListId)) {
            $lovedProducts = LoveListDetail::select(["product_id"])->whereIn("list_id", $arrayListId)->get();
            foreach ($lovedProducts as $id) {
                $arrayProductId[] = $id->product_id;
            }
        }
        /*get product detail*/
        if ($get == "all") {
            if (isset($arrayProductId)) {
                $detailProducts = Products::getProductById($arrayProductId, "array");
            }
            return $detailProducts;
        } /*Chi lay id*/
        else if ($get == "id") {
            return $arrayProductId;
        }

    }

    public function bill()
    {
        return $this->hasMany('App\Bill');
    }

    public function CustomerInfo()
    {
        return $this->hasMany('App\CustomerInfo');
    }

    public function LoveList()
    {
        return $this->hasMany('App\LoveList');
    }


}
