<?php

namespace App\Http\Controllers;

use App\repositories\CountryRepository;
use Illuminate\Http\Request;
use App\repositories\AuthRepository;
use Illuminate\Support\Facades\Input;
use App\Exceptions\Handler;
use Auth;
use Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class CountryController extends Controller
{
    /**
     * CountryController constructor.
     */
    public function __construct(CountryRepository $country)
    {
        $this->country=$country;
    }
    public function addCountry(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_country',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('name'=>$request->name);
        $this->country->insertCountry($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }
    public function editCountry(Request $request)
    {
        try {
            $result=$this->country->editCountry($request);
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
    public function getCountry(Request $request)
    {
        try {
            $result=$this->country->getCountry();
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
    public function updateCountry(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_country,name,'.$request->id,
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray=array('name'=>$request->name);
        $this->country->updateCountry($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteCountry(Request $request)
    {
        try {
            $result=$this->country->deleteCountry($request);
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
    public function addState(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_state',
             'country_id' => 'required'
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('name'=>$request->name,'country_id'=>$request->country_id);
        $this->country->insertState($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }

    public function getState(Request $request)
    {
        try {
            $result=$this->country->getState($request);
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

    public function allState(Request $request)
    {
        try {
            $result=$this->country->allState($request);
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

    public function editState(Request $request)
    {
        try {
            $result=$this->country->editState($request);
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
    public function updateState(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_state,name,'.$request->id,
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray=array('name'=>$request->name);
        $this->country->updateState($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteState(Request $request)
    {
        try {
            $result=$this->country->deleteState($request);
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
    public function addCity(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_city',
            'zip_code' => 'required',
            'state_id' => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $result= $this->country->insertCity($request);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.','ad'=>$result], 200);
    }
    public function allCity(Request $request)
    {
        try {
            $result=$this->country->allCity($request);
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
    public function editCity(Request $request)
    {
        try {
            $result=$this->country->editCity($request);
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
    public function updateCity(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_city,name,'.$request->id,
            'zip_code' => 'required',
            'state_id' => 'required'
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray=array('name'=>$request->name,'zipcode'=>$request->zip_code,'state_id'=>$request->state_id);
        $this->country->updateCity($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteCity(Request $request)
    {
        try {
            $result=$this->country->deleteCity($request);
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
