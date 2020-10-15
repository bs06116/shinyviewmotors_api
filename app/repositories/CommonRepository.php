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
    public function totalVehicle(){
        return DB::table('cars')->where('status',1)->where('admin_status',1)->count();
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
    public function vehicleCondition(){
        return DB::table('condtions')->where('status',1)->get()->toArray();
    }
    public function vehicleYear(){
        return DB::table('cars')->select('year as reg_year')->where('status',1)->groupby('year')->get()->toArray();
    }
    public function transmissionType(){
        return DB::table('transmission_types')->where('status',1)->get()->toArray();
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
    public function allTypeOfVehicle($request){
        if(isset($request->condition_id)){
            $condition_id=$request->condition_id;
        }else{
            $condition_id=1;
        }
        $result= DB::table('cars')->where('status',1)->where('condtion_id',$request->condition_id)->limit(5)->get()->toArray();
        $allVehicle=[];
        foreach ($result as $r):
            $allVehicle[]=array('title'=>$r->title,
                'price'=>$r->regular_price,
                'image_url'=>config('app.url').MyConstants::FEATURED_IMAGE_URL.$r->featured_image);
        endforeach;
        return $allVehicle;
    }
    public function getVehicleFeatureList(){
        return DB::table('car_features')->get()->toArray();
    }


}
