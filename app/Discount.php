<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model {

	//
    protected $table="discounts";
    protected $fillable = ['id','name',"percent",'description','start','end'];
    public $timestamps = false;
    public function cates(){
        return $this->hasMany('App\Cate','discount_id');
    }
}
