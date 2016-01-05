<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{

    //
    protected $table = "cates";
    protected $fillable = ['id', 'discount_id', 'name', "alias", 'parent_id'];
    public $timestamps = false;

    public function product()
    {
        return $this->hasMany('App\Products');
    }

    public function discount()
    {
        return $this->belongsToMany('App\Discount', 'discounts', 'discount_id');
    }

    /*tim loai con 2 cap*/
    public static function getSecChildId($id)
    {
        $fisrtChild = Cate::select(["id"])->where("parent_id", $id)->get()->toArray();
        $secChild = [];
        foreach ($fisrtChild as $item) {
            $a = [];
            $temp = Cate::select(["id"])->where("parent_id", $item["id"])->get()->toArray();
            foreach ($temp as $it) {
                $a[] = $it["id"];
            }
            $secChild = array_merge($secChild, $a);
        }
        return $secChild;

    }
    /*tim loai con 1 cap*/
    public static function getFirstChildId($id){
        $fisrtChild = Cate::select(["id"])->where("parent_id", $id)->get()->toArray();
        $temp=[];
        foreach($fisrtChild as $item){
            $temp[]=$item["id"];
        }
        return $fisrtChild;
    }
}
