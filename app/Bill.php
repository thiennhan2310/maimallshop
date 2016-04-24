<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model {

	//
    public $timestamps = true;
    protected $table = "bills";
    protected $fillable = ['id' , 'total' , 'customer_id' , 'discounted' , 'customer_info_id' , "status" , 'payment_method'];

    public static function NewBill()
    {
        $newBill = Bill::join("customers" , "customers.id" , "=" , "bills.customer_id")
            ->select(["bills.*" , "customers.id as customerId" , "customers.last_name"])
            ->where("bills.status" , 3)->paginate(100);
        return $newBill;
    }

    public static function DeliveryBill()
    {
        $newBill = Bill::join("customers" , "customers.id" , "=" , "bills.customer_id")
            ->select(["bills.*" , "customers.id as customerId" , "customers.last_name"])
            ->where("bills.status" , 2)->paginate(100);
        return $newBill;
    }

    public static function SuccessBill()
    {
        $newBill = Bill::join("customers" , "customers.id" , "=" , "bills.customer_id")
            ->select(["bills.*" , "customers.id as customerId" , "customers.last_name"])
            ->where("bills.status" , 1)->paginate(100);
        return $newBill;
    }

    public function detail(){
        return $this->hasMany('App\billDetail');
    }

    public function customer(){
        return $this->belongsTo('App\customer');
    }

    public function customerInfo()
    {
        return $this->hasOne('App\CustomerInfo');
    }


}
