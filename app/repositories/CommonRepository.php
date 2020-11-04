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
            $brands[]=array(
                'id'=>$r->id,
                'name'=>$r->name,
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
    public function fuelType(){
        return DB::table('fuel_types')->where('status',1)->get()->toArray();
    }
    public function engineSize(){
        return DB::table('cars')->select('engine as id','engine as engine_size')->groupBy('engine')->get()->toArray();
    }
    public function latestFeaturedVehicle(){
        $result= DB::table('cars')->where('status',1)->where('featured',1)->limit(5)->get()->toArray();
        $featured=[];
        foreach ($result as $r):
            $featured[]=array(
                'id'=>$r->id,
                'title'=>$r->title,
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
        $result = DB::table('cars')
            ->select('cars.id', 'cars.title', 'cars.mileage', 'cars.regular_price','cars.featured_image',
            'transmission_types.name as transmission_types_name',
            'ulez.name as ulez_name')
            ->join('transmission_types', 'cars.transmission_type_id', '=', 'transmission_types.id')
            ->join('ulez', 'cars.ulez_id', '=', 'ulez.id')
            ->where('cars.status',1)->where('cars.condtion_id',$condition_id)->limit(5)->get()->toArray();
        $allVehicle=[];
        foreach ($result as $r):
            $allVehicle[]=array('id'=>$r->id,
                'title'=>$r->title,
                'mileage'=>$r->mileage,
                'ulez'=>$r->ulez_name,
                'transmission_types'=>$r->transmission_types_name,
                'price'=>$r->regular_price,
                'image_url'=>config('app.url').MyConstants::FEATURED_IMAGE_URL.$r->featured_image);
        endforeach;
        return $allVehicle;
    }
    public function getVehicleFeatureList(){
        return DB::table('car_features')->orderby('name','ASC')->get()->toArray();
    }


}
