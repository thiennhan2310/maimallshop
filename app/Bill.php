<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model {

	//
    protected $table="bill";
    protected $fillable = ['id', 'total', 'customer_id',"status",'type'];
    public $timestamps = true;
    public function detail(){
        return $this->hasMany('App\billDetail');
    }
    public function customer(){
        return $this->belongsTo('App\customer');
    }
}
