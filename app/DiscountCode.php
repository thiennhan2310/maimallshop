<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{

    //
    public $timestamps = false;
    protected $table = "discount_code";
    protected $fillable = ['code' , 'percent' , "user" , 'exp_date' , "status"];

    public static function createCode($percent , $exp_date)
    {
        $code = str_random(10);
        $info = DiscountCode::select(["percent"])->where("code" , $code)->first();
        if ( $info == true ) {
            //  da~ ton tai code nay
            DiscountCode::createCode($percent , $exp_date);

        } else {
            DiscountCode::create(["code" => $code , "percent" => $percent , "exp_date" => $exp_date]);

        }
    }

    public static function deleteCode($code)
    {
        $code = DiscountCode::where("code" , $code)->delete();
    }

    public static function changeCodeToPercent($code)
    {
        $detail = DiscountCode::select(["percent"])->where("code" , $code)->first();
        if ( !is_null($detail) ) {
            return $detail->percent;
        } else {
            return false;
        }

    }
}
