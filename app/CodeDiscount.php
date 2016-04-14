<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeDiscount extends Model
{

    //
    public $timestamps = false;
    protected $table = "code_discount";
    protected $fillable = ['code' , 'percent' , "user" , 'exp_date' , "status"];

    public static function createCode()
    {
        return $string = str_random(10);
    }

    public static function changeCodeToPercent($code)
    {
        return 50;
    }
}
