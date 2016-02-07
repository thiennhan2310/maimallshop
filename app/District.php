<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    //
    public $timestamps = false;
    protected $table = "district";
    protected $fillable = ['districtid' , "name" , 'type' , 'location' , 'provinceid'];

    public function province()
    {
        return $this->belongsTo('App\Province' , 'provinceid');
    }

    public function ward()
    {
        return $this->hasMany('App\Ward');
    }

    public function CustomerInfo()
    {
        return $this->belongsToMany('App\CustomerInfo');
    }

}
