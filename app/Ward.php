<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{

    //
    //
    public $timestamps = false;
    protected $table = "ward";
    protected $fillable = ['wardid' , "name" , 'type' , 'location' , 'districtid'];

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function CustomerInfo()
    {
        return $this->belongsToMany('App\CustomerInfo');
    }
}
