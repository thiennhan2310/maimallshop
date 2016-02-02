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

}
