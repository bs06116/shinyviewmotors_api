<?php
/**
 * Created by PhpStorm.
 * User: asimr
 * Date: 7/8/2019
 * Time: 1:34 AM
 */

namespace App\repositories;
use App\MyConstants;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use DB;

class CommonRepository
{
    public function __construct()
    {

    }
    ///////////////////Home Page Filter///////////////////////
    public function allVehicle(){
        return DB::table('vehicle_type')->where('status',1)->get()->toArray();
    }
    public function allBrand(){
        $result = DB::table('brands')->where('status',1)->get()->toArray();
        $brands = [];
        foreach ($result as $r):
            $brands[]=array('name'=>$r->name,
                'image_url'=>config('app.url').MyConstants::BRAND_IMAGE_URL.$r->image);
        endforeach;
        return $brands;
    }
    public function allBrandModel(){
        return DB::table('brand_models')->where('status',1)->get()->toArray();
    }
    public function allBody(){
        return DB::table('body_types')->where('status',1)->get()->toArray();
    }
    public function latestFeaturedVehicle(){
        $result= DB::table('cars')->where('status',1)->where('featured',1)->limit(5)->get()->toArray();
        $featured=[];
        foreach ($result as $r):
            $featured[]=array('title'=>$r->title,
                               'price'=>$r->regular_price,
                               'image_url'=>config('app.url').MyConstants::FEATURED_IMAGE_URL.$r->featured_image);
        endforeach;
        return $featured;
    }


}
