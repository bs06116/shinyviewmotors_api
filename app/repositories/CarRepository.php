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

        $query = Car::query();
        $query->when($vehicle, function ($query, $vehicle) {
            return $query->where('vehicle_id', $vehicle);
        });
        $query->when($brands, function ($query, $brands) {
            return $query->where('brand_id', $brands);
        });
        $query->when($model, function ($query, $model) {
            return $query->where('brand_model_id', $model);
        });
        $query->when($condition, function ($query, $condition) {
            return $query->where('condtion_id', $condition);
        });
        $query->when($mileage, function ($query, $mileage) {
            $mileageArray = explode("-", $mileage);
            return $query->whereBetween('mileage', $mileageArray);
        });
        $query->when($year, function ($query, $year) {
            return $query->where('year', $year);
        });
        $query->when($transmission, function ($query, $transmission) {
            return $query->where('transmission_type_id', $transmission);
        });
        $query->when($minprice, function($query, $minprice) {
                return $query->where('search_price', '>=', $minprice);
        });
        $query->when($maxprice, function($query, $maxprice) {
                return $query->where('search_price', '>=', $maxprice);
        });
        $query->when(request('filter_by') == 'date', function ($q) {
            return $q->orderBy('created_at', request('ordering_rule', 'desc'));
        })->where('status', 1)->where('admin_status', 1);
        return $query->get();

//        $query->when(request('filter_by') == 'date', function ($q) {
//            return $q->orderBy('created_at', request('ordering_rule', 'desc'));
//        });
//
//            ->when($sort, function ($query, $sort) {
//                if ($sort == 'desc') {
//                    return $query->orderBy('id', 'DESC');
//                } elseif ($sort == 'asc') {
//                    return $query->orderBy('id', 'ASC');
//                } elseif ($sort == 'price_desc') {
//                    return $query->orderBy('search_price', 'DESC');
//                } elseif ($sort == 'price_asc') {
//                    return $query->orderBy('search_price', 'ASC');
//                }
//            })
//            ->when($type, function ($query, $type) {
//                if ($type == 'featured') {
//                    return $query->where('featured', 1);
//                }
//            })
//            ->where('status', 1)->where('admin_status', 1)->paginate($view);
    }


}
