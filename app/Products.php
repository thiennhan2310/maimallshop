<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

	//
    protected $table="product";
    protected $fillable = ['id', 'cate_id', 'name',"alias",'price','img1','img2','img3','img4','description','brand','size','status'];
    public $timestamps = false;
    public function cate(){
        return $this->belongsTo('App\Cate');
    }
    public function bill_detail(){
        return $this->belongsToMany('App\billDetail','bill_details','products_id');
    }
}
