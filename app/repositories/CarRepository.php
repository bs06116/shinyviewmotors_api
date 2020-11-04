<?php
/**
 * Created by PhpStorm.
 * User: asimr
 * Date: 7/8/2019
 * Time: 1:34 AM
 */

namespace App\repositories;

use App\Mail\SellerContactMail;
use App\Models\Car;
use App\MyConstants;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use DB;
use Validator;
use Mail;




class CarRepository
{
    public function __construct()
    {

    }

    public function carFilter($request)
    {
//        echo json_encode(array('Air condition','Navigation','Sunroof','Rear wiper'));
//        die;
        $vehicle = $request->vehicle_id;
        $brands = $request->brand_id;
        $model = $request->model_id;
        $condition = $request->condition_id;
        $mileage = $request->mileage;
        $year = $request->year;
        $transmission = $request->transmission_id;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $feature = $request->feature;

//        $sort = !empty($request->sort) ? $request->sort : 'desc';
//        $view = !empty($request->view) ? $request->view : 10;
//        $type = !empty($request->type) ? $request->type : 'all';

        $query = DB::table('cars');
        $query->select('cars.title', 'cars.regular_price', 'cars.featured_image', 'cars.year', 'cars.mileage', 'cars.description',
            'fuel_types.name as fuel_types_name',
            'users.first_name as first_name', 'users.last_name as last_name', 'users.phone as phone');
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
        $query->when($minprice, function ($query, $minprice) {
            return $query->where('cars.regular_price', '>=', $minprice);
        });
        $query->when($maxprice, function ($query, $maxprice) {
            return $query->where('cars.regular_price', '>=', $maxprice);
        });
        $query->when($feature, function ($query, $feature) {
            return $query->whereRaw('json_contains(cars.features, \'["' . $feature . '"]\')');
        });
        $query->when(request('filter_by') == 'date', function ($q) {
            return $q->orderBy('cars.created_at', request('sort', 'desc'));
        })->where('cars.status', 1)->where('cars.admin_status', 1);
        $queryResult = $query->get();
        $result = [];
        foreach ($queryResult as $data):
            $result[] = array(
                'owner_name' => $data->first_name . ' ' . $data->last_name,
                'phone' => $data->phone,
                'title' => $data->title,
                'year' => $data->year,
                'mileage' => $data->mileage,
                'price' => $data->regular_price,
                'fuel_types_name' => $data->fuel_types_name,
                'main_image_url' => config('app.url') . MyConstants::FEATURED_IMAGE_URL . $data->featured_image,
                'note' => $data->description
            );
        endforeach;
        return $result;
    }

    public function carDetails($request)
    {
        $result = DB::table('cars')
            ->select('cars.title','cars.brand_id', 'cars.regular_price','cars.engine','cars.owner',
                'cars.features', 'cars.featured_image', 'cars.year', 'cars.mileage', 'cars.description','cars.registered_date',
                'cars.history', 'cars.mpg',
                'categories.name as categories_name',
                'brands.name as brand_name', 'brand_models.name as brand_model_name',
                'body_types.name as body_type_name',
                'fuel_types.name as fuel_types_name',
                'transmission_types.name as transmission_types_name',
                'exterior_color.color_name as exterior_color_name',
                'interior_color.color_name as interior_color_name',
                'drive_mode.drive_mode_name',
                'condtions.name as condtions_name',
                'ulez.name as ulez_name')
            ->join('categories', 'cars.category_id', '=', 'categories.id')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->join('brand_models', 'cars.brand_model_id', '=', 'brand_models.id')
            ->join('body_types', 'cars.body_type_id', '=', 'body_types.id')
            ->join('fuel_types', 'cars.fuel_type_id', '=', 'fuel_types.id')
            ->join('transmission_types', 'cars.transmission_type_id', '=', 'transmission_types.id')
            ->join('exterior_color', 'cars.exterior_color_id', '=', 'exterior_color.id')
            ->join('interior_color', 'cars.interior_color_id', '=', 'interior_color.id')
            ->join('condtions', 'cars.condtion_id', '=', 'condtions.id')
            ->join('drive_mode', 'cars.drive_mode_id', '=', 'drive_mode.id')
            ->join('ulez', 'cars.ulez_id', '=', 'ulez.id')
            ->where('cars.status', 1)->where('cars.admin_status', 1)->where('cars.id', $request->id)->get()->first();
        $vehicleImages = DB::table('car_images')->get()->toArray();
        $images = [];
        foreach ($vehicleImages as $vi):
            $images[] = config('app.url') . MyConstants::SLIDER_IMAGE_URL . $vi->image;
        endforeach;

        $array = array(
            'brand_id' => $result->brand_id,
            'title' => $result->title,
           'category' => $result->categories_name,
            'year' => $result->year,
            'engine' => $result->engine,
            'mileage' => $result->mileage,
            'owner' => $result->owner,
            'brand_name' => $result->brand_name,
            'brand_model_name' => $result->brand_model_name,
            'price' => $result->regular_price,
            'ulez' => $result->ulez_name,
            'exterior_color' => $result->exterior_color_name,
            'interior_color' => $result->interior_color_name,
            'body_type_name' => $result->body_type_name,
            'fuel_types_name' => $result->fuel_types_name,
            'transmission_type' => $result->transmission_types_name,
            'drive_mode' => $result->drive_mode_name,
            'condtions' => $result->fuel_types_name,
            'history' => $result->history,
            'mpg' => $result->mpg,
            'registered_date' => date("d-m-Y", strtotime($result->registered_date)),
            'main_image_url' => config('app.url') . MyConstants::FEATURED_IMAGE_URL . $result->featured_image,
            'note' => $result->description,
            'feature' =>  json_decode($result->features),
            'car_images' => $images
        );
        return $array;
    }

    public function vehicleMode($request)
    {
        return DB::table('brand_models')->where('brand_id', $request->brand_id)->where('status', 1)->get()->toArray();
    }

    public function sellerContact($request)
    {
        $v = Validator::make($request->all(), [
            'full_name' => 'required|min:3',
            'postcode' => 'required|min:3',
            'phone' => 'required|min:3',
            'email' => 'required|email',
        ]);
        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }

        $data['full_name'] = $request->full_name;
        $data['postcode'] = $request->postcode;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['message'] = $request->message;
        Mail::to($request->email)->send(new SellerContactMail($data));
        return true;
    }
    public function similarVehicle($request){
        $result = DB::table('cars')
            ->select('cars.id', 'cars.title', 'cars.mileage', 'cars.regular_price','cars.featured_image',
                'transmission_types.name as transmission_types_name',
                'ulez.name as ulez_name')
            ->join('transmission_types', 'cars.transmission_type_id', '=', 'transmission_types.id')
            ->join('ulez', 'cars.ulez_id', '=', 'ulez.id')
          ->where('cars.admin_status', 1)->where('cars.brand_id', $request->brand_id)->get()->toArray();
        $similar=[];
        foreach ($result as $r):
            $similar[]=array(
                'id'=>$r->id,
                'title'=>$r->title,
                'mileage'=>$r->mileage,
                'ulez'=>$r->ulez_name,
                'transmission_types'=>$r->transmission_types_name,
                'price'=>$r->regular_price,
                'image_url'=>config('app.url').MyConstants::FEATURED_IMAGE_URL.$r->featured_image);
        endforeach;
        return $similar;
    }

}
