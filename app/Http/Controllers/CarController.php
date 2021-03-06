<?php

namespace App\Http\Controllers;

use App\repositories\CarRepository;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class CarController extends Controller
{
    /**
     * CarController constructor.
     */
    public function __construct(carRepository $car)
    {
        $this->car=$car;
    }
    public function getCarFilter(Request $request)
    {
        try {
            $result = $this->car->carFilter($request);

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);

        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    public function getSimilarVehicle(Request $request)
    {
        try {
            $featuredVehicles = $this->car->similarVehicle($request);
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
    public function getCarDetails(Request $request)
    {
        try {
            $result = $this->car->carDetails($request);
            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);

        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    public function getVehicleModel(Request $request)
    {
        try {
            $result = $this->car->vehicleMode($request);
            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);

        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    public function sendEmailToSeller(Request $request)
    {
        try {
            $result = $this->car->sellerContact($request);
            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);

        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
 }
