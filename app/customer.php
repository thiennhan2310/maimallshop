<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model {

	//
    protected $table="customers";
    protected $fillable = ['id', 'email', 'first_name',"last_name",'address','phone'];
    public $timestamps = false;
    public function bill(){
        return $this->hasMany('App\Bill');
    }

}
