<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{

    //
    public $timestamps = false;
    protected $table = "customer_info";
    protected $fillable = ['customer_id' , 'first_name' , "last_name" , 'address' , 'phone' , 'district_id' , 'province_id' , 'ward_id'];

    public function customer()
    {
        return $this->belongsTo('App\customer');
    }

    public function Province()
    {
        return $this->hasOne('App\Province');
    }

    public function District()
    {
        return $this->hasOne('App\District');
    }

    public function Ward()
    {
        return $this->hasOne('App\Ward(');
    }
}
