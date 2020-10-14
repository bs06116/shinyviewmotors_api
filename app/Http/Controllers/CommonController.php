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
            $home_filter = array('vehicles'=>$vehicles,'brands'=>$brands, 'models'=>$models,
                'bodies'=>$bodies,
                'total_vehicle'=>$totalVehicle);

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
