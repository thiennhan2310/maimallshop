<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LoveListDetail extends Model
{

    public $timestamps = true;
    protected $table = "love_list_detail";
    protected $fillable = ['list_id', 'product_id'];

    public function Product()
    {
        return $this->hasOne('App\Products', 'product_id');
    }
}
