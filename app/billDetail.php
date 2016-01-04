<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class billDetail extends Model {

	//
    protected $table="bill_details";
    protected $fillable = ['bill_id', 'products_id', 'price',"amount"];
    public $timestamps = false;
    public function bill(){
        return $this->belongsTo('App\Bill');
    }
    public function product(){
        return $this->hasOne('App\Products');
    }
}
