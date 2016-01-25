<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LoveList extends Model
{

    public $timestamps = false;
    protected $table = "love_list";
    protected $fillable = ['id', 'customer_id', "name"];

    public function Customer()
    {
        return $this->belongsTo('App\customer', 'customer_id');
    }

}
