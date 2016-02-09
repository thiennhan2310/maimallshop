<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{

    //
    public $timestamps = false;
    protected $table = "customer_info";
    protected $fillable = ['customer_id' , 'first_name' , "last_name" , 'address' , 'phone' , 'district_id' , 'province_id' , 'ward_id'];

    public static function getAddressInfo($customerID)
    {
        $address = CustomerInfo::join("province" , "province.provinceid" , "=" , "customer_info.province_id")
            ->join("district" , "district.districtid" , "=" , "customer_info.district_id")
            ->join("ward" , "ward.wardid" , "=" , "customer_info.ward_id")
            ->select(["customer_info.*" , "province.name as province_name" , "district.name as district_name" , "ward.name as ward_name"])->get();
        return $address;
    }

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
