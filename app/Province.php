<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{

    //
    public $timestamps = false;
    protected $table = "province";
    protected $fillable = ['provinceid' , "name" , 'type'];

    public function district()
    {
        return $this->hasMany('App\District');
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
