<?php
/**
 * Created by PhpStorm.
 * User: asimr
 * Date: 7/8/2019
 * Time: 1:34 AM
 */

namespace App\repositories;
use App\Models\Car;
use App\MyConstants;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use DB;

class CarRepository
{
    public function __construct()
    {

    }
    public function carFilter($request){
          $vehicle = $request->vehicle_id;
          $brands = $request->brand_id;
          $model = $request->model_id;
          $condition = $request->condition_id;
          $mileage = $request->mileage;
          $year = $request->year;
          $transmission = $request->transmission_id;
          $minprice = $request->minprice;
          $maxprice = $request->maxprice;

//        $sort = !empty($request->sort) ? $request->sort : 'desc';
//        $view = !empty($request->view) ? $request->view : 10;
//        $type = !empty($request->type) ? $request->type : 'all';

        $query = DB::table('cars');
        $query->select('cars.title','cars.regular_price','cars.featured_image','cars.year','cars.mileage','cars.description',
            'fuel_types.name as fuel_types_name',
            'users.first_name as first_name','users.last_name as last_name','users.phone as phone');
        $query->join('fuel_types', 'cars.fuel_type_id', '=', 'fuel_types.id');
        $query->join('users', 'cars.user_id', '=', 'users.id');
        $query->when($vehicle, function ($query, $vehicle) {
            return $query->where('cars.vehicle_id', $vehicle);
        });
        $query->when($brands, function ($query, $brands) {
            return $query->where('cars.brand_id', $brands);
        });
        $query->when($model, function ($query, $model) {
            return $query->where('cars.brand_model_id', $model);
        });
        $query->when($condition, function ($query, $condition) {
            return $query->where('cars.condtion_id', $condition);
        });
        $query->when($mileage, function ($query, $mileage) {
            $mileageArray = explode("-", $mileage);
            return $query->whereBetween('cars.mileage', $mileageArray);
        });
        $query->when($year, function ($query, $year) {
            return $query->where('cars.year', $year);
        });
        $query->when($transmission, function ($query, $transmission) {
            return $query->where('cars.transmission_type_id', $transmission);
        });
        $query->when($minprice, function($query, $minprice) {
                return $query->where('cars.regular_price', '>=', $minprice);
        });
        $query->when($maxprice, function($query, $maxprice) {
                return $query->where('cars.regular_price', '>=', $maxprice);
        });
        $query->when(request('filter_by') == 'date', function ($q) {
            return $q->orderBy('cars.created_at', request('sort', 'desc'));
        })->where('cars.status', 1)->where('cars.admin_status', 1);
        $queryResult = $query->get();
        $result=[];
        foreach ($queryResult as $data):
                $result[] = array(
                    'owner_name'=>$data->first_name.' '.$data->last_name,
                    'phone'=>$data->phone,
                    'title'=>$data->title,
                    'year' => $data->year,
                    'mileage' => $data->mileage,
                    'price'=>$data->regular_price,
                    'fuel_types_name'=>$data->fuel_types_name,
                    'main_image_url'=>config('app.url').MyConstants::FEATURED_IMAGE_URL.$data->featured_image,
                    'note'=>$data->description
                );
        endforeach;
        return $result;


    }
    public function carDetails($request){
        $result = DB::table('cars')
                ->select('cars.title','cars.regular_price','cars.featured_image','cars.year','cars.mileage','cars.description',
                        'brands.name as brand_name','brand_models.name as brand_model_name',
                        'body_types.name as body_type_name',
                        'fuel_types.name as fuel_types_name',
                        'transmission_types.name as transmission_types_name',
                        'condtions.name as condtions_name')
                ->join('brands', 'cars.brand_id', '=', 'brands.id')
                ->join('brand_models', 'cars.brand_model_id', '=', 'brand_models.id')
                ->join('body_types', 'cars.body_type_id', '=', 'body_types.id')
                ->join('fuel_types', 'cars.fuel_type_id', '=', 'fuel_types.id')
                ->join('transmission_types', 'cars.transmission_type_id', '=', 'transmission_types.id')
                ->join('condtions', 'cars.condtion_id', '=', 'condtions.id')
                ->where('cars.status',1)->where('cars.admin_status',1)->where('cars.id',$request->id)->get()->first();
        $vehicleImages= DB::table('car_images')->get()->toArray();
        $images=[];
        foreach ($vehicleImages as $vi):
            $images[] = config('app.url').MyConstants::SLIDER_IMAGE_URL.$vi->image;
        endforeach;

        $array = array('title'=>$result->title,
                'year' => $result->year,
                'mileage' => $result->mileage,
                'brand_name'=>$result->brand_name,
                'brand_model_name'=>$result->brand_model_name,
                'price'=>$result->regular_price,
                'body_type_name'=>$result->body_type_name,
                'fuel_types_name'=>$result->fuel_types_name,
                'transmission_type'=>$result->transmission_types_name,
                'condtions'=>$result->fuel_types_name,
                'main_image_url'=>config('app.url').MyConstants::FEATURED_IMAGE_URL.$result->featured_image,
                'note'=>$result->description,
                'car_images'=>$images

        );
        return $array;
    }


}
