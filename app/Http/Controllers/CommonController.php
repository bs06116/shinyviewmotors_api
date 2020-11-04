<?php

namespace App\Http\Controllers;

use App\repositories\CommonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class CommonController extends Controller
{
    /**
     * CommonController constructor.
     */
    public function __construct(commonRepository $common)
    {
        $this->common=$common;
    }
    public function getHomePage(Request $request)
    {
        try {
            $vehicles = $this->common->allVehicle();
            $brands = $this->common->allBrand();
            $models = $this->common->allBrandModel();
            $bodies = $this->common->allBody();
            $totalVehicle = $this->common->totalVehicle();
            $vehicleCondition = $this->common->vehicleCondition();
            $vehicleYear = $this->common->vehicleYear();
            $vehicleMileage = array(array('id'=>'<10000','text'=>'< 10000'),
                                     array('id'=>'10000-20000','text'=>'10000 - 20000'),
                                    array('id'=>'20000-30000','text'=>'20000 - 30000'),
                                    array('id'=>'30000-40000','text'=>'30000 - 40000'),
                                    array('id'=>'40000-50000','text'=>'40000 - 50000'),
                                    array('id'=>'50000-60000','text'=>'50000 - 60000'),
                                    array('id'=>'60000-70000','text'=>'60000 - 70000'),
                                    array('id'=>'70000-80000','text'=>'70000 - 80000'),
                                    array('id'=>'80000-90000','text'=>'80000 - 90000'),
                                    array('id'=>'90000-100000','text'=>'90000 - 100000'),
                                    array('id'=>'100000>','text'=>'100000 >')
                                     );
            $transmitionType = $this->common->transmissionType();
            $fuelType = $this->common->fuelType();
            $engineSize = $this->common->engineSize();
            $home_filter = array('vehicles'=>$vehicles,
                'brands'=>$brands,
                'models'=>$models,
                'year' => $vehicleYear,
                'mileage' => $vehicleMileage,
                'transmition_type' => $transmitionType,
                'fuel_type'=>$fuelType,
                'engine_size' =>$engineSize,
                'body_type'=>$bodies,
                'total_vehicle'=>$totalVehicle
                );

            return response()->json([
                'success' => true,
                'data' => $home_filter,
            ], 200);

        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    public function getFeaturedVehicle(Request $request)
    {
        try {
            $featuredVehicles = $this->common->latestFeaturedVehicle();
            return response()->json([
                'success' => true,
                'data' => $featuredVehicles,
            ], 200);

        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    public function allVehicle(Request $request)
    {
        try {
            $allTypeVehicles = $this->common->allTypeOfVehicle($request);
            return response()->json([
                'success' => true,
                'data' => $allTypeVehicles,
            ], 200);

        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    public function getVehicleFeatureList(Request $request)
    {
        try {
            $vehicleFeature = $this->common->getVehicleFeatureList();
            return response()->json([
                'success' => true,
                'data' => $vehicleFeature,
            ], 200);

        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
     public function uploadImage($image){
        if(isset($image)){
            $imageName = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($image)->save(public_path('images/').$imageName);
            return $imageName;
        }

     }
 }
