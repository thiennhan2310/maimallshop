<?php
/**
 * Created by PhpStorm.
 * User: Thien Nhan
 * Date: 2/4/2016
 * Time: 11:06 AM
 */

namespace App\Http\Controllers;


use App\District;
use App\Ward;

class CityController extends Controller
{
    public function GetDistrict($provinceid)
    {
        $district = District::select(["districtid" , "name"])->where("provinceid" , $provinceid)->orderBy("name")->get();
        $string = "";
        foreach ( $district as $d ) {
            $string .= "<option value='" . $d->districtid . "'>" . $d->name . "</option>";
        }
        return json_encode(["district" => $string]);
    }

    public function GetWard($districtid)
    {
        $ward = Ward::select(["wardid" , "name"])->where("districtid" , $districtid)->orderBy("name")->get();
        $string = "";
        foreach ( $ward as $w ) {
            $string .= "<option value='" . $w->wardid . "'>" . $w->name . "</option>";
        }
        return json_encode(["ward" => $string]);
    }
}