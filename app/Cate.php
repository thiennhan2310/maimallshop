<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{

    //
    public $timestamps = false;
    protected $table = "cates";
    protected $fillable = ['id', 'discount_id', 'name', "alias", 'parent_id'];

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

    public static function getFirstChildId($id)
    {
        $fisrtChild = Cate::select(["id"])->where("parent_id", $id)->get()->toArray();
        $temp = [];
        foreach ($fisrtChild as $item) {
            $temp[] = $item["id"];
        }
        return $fisrtChild;
    }

    /*tim mang loai con 2 cap*/

    public static function getIdByAlias($alias)
    {
        $id=Cate::select(["id"])->where("alias","=",$alias)->first();
        return $id->id;
    }

    /*tim mang loai con 1 cap*/

    public static function getParentId($id,$chuoi="")
    {
        if($id==1||$id==2||$id==3){
            return $chuoi;
        }
        else{
           $parent_id= Cate::select(["parent_id"])->where("id",$id)->first();
           $chuoi.=$parent_id->parent_id."-" ;
            $chuoi=Cate::getParentId($parent_id->parent_id,$chuoi);
        }
        $chuoi=trim($chuoi,"-");
        return $chuoi; //10-4-1
    }

    public static function getNameById($id)
    {
        $array_id=explode("-",$id);
        $array_name=Cate::select(["name"])->whereIn("id",$array_id)->get()->toArray();
        return $array_name;
    }

    public static function getCateOnDiscount($discount_id)
    {
        $cate = Cate::select(["id", "discount_id", "name"])->where("discount_id", $discount_id)->get();
        return $cate;
    }

    public function product()
    {
        return $this->hasMany('App\Products');
    }

    public function discount()
    {
        return $this->belongsToMany('App\Discount', 'discounts', 'discount_id');
    }
}
