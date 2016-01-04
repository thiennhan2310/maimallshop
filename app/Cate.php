<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model {

	//
    protected $table="cates";
    protected $fillable = ['id', 'discount_id', 'name',"alias",'parent_id'];
    public $timestamps = false;
    public function product(){
        return $this->hasMany('App\Products');
    }
    public function discount(){
        return $this->belongsToMany('App\Discount','discounts','discount_id');
    }
}
