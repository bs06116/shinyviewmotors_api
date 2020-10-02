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
            $brands = $this->common->allBrand();
            $models = $this->common->allBrandModel();
            $home_filter = array('brands'=>$brands, 'models'=>$models);

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


    public function addCompanyType(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:admin_settings_company_types,name',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('name'=>$request->title);
        $this->setting->insertCompanyType($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }
    public function editCompanyType(Request $request)
    {
        try {
            $result=$this->setting->editCompanyType($request);
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
    public function getCompanyType(Request $request)
    {
        try {
            $result=$this->setting->allCompanyType();
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
    public function updateCompanyType(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:admin_settings_company_types,name,'.$request->id,
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray = array('name'=>$request->title);
        $this->setting->updateCompanyType($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteCompanyType(Request $request)
    {
        try {
            $result=$this->setting->deleteCompanyType($request);
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

    public function addCompanySkill(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_settings_company_skills',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('name'=>$request->name);
        $this->setting->insertCompanySkill($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }
    public function editCompanySkill(Request $request)
    {
        try {
            $result=$this->setting->editCompanySkill($request);
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
    public function getCompanySkill(Request $request)
    {
        try {
            $result=$this->setting->allCompanySkill();
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
    public function updateCompanySkill(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_settings_company_skills,name,'.$request->id,
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray = array('name'=>$request->name);
        $this->setting->updateCompanySkill($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteCompanySkill(Request $request)
    {
        try {
            $result=$this->setting->deleteCompanySkill($request);
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

      //////////////////////Reason Category///////////////////////
    public function addReasonCategory(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_settings_reason_category',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('name'=>$request->name);
        $this->setting->insertReasonCategory($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }
    public function editReasonCategory(Request $request)
    {
        try {
            $result=$this->setting->editReasonCategory($request);
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
    public function getReasonCategory(Request $request)
    {
        try {
            $result=$this->setting->allReasonCategory();
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
    public function updateReasonCategory(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:admin_settings_reason_category,name,'.$request->id,
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray = array('name'=>$request->name,"updated_at" => date('Y-m-d H:i:s'));
        $this->setting->updateReasonCategory($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteReasonCategory(Request $request)
    {
        try {
            $result=$this->setting->deleteReasonCategory($request);
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


    //////////////////////Reason///////////////////////
    public function addReason(Request $request)
    {
        $v = Validator::make($request->all(), [
            'category_id' => 'required',
            'reason' => 'required|unique:admin_settings_reasons',

        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('reason'=>$request->reason,'category_id'=>$request->category_id);
        $this->setting->insertReason($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }
    public function editReason(Request $request)
    {
        try {
            $result=$this->setting->editReason($request);
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
    public function updateReason(Request $request)
    {
        $v = Validator::make($request->all(), [
            'category_id' => 'required',
            'reason' => 'required|unique:admin_settings_reasons,reason,'.$request->id,
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray = array('reason'=>$request->reason,'category_id'=>$request->category_id,"updated_at" => date('Y-m-d H:i:s'));
        $this->setting->updateReason($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteReason(Request $request)
    {
        try {
            $result=$this->setting->deleteReason($request);
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
    public function getReason(Request $request)
    {
        try {
            $result=$this->setting->allReason($request);
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

    //////////////////////Privacy///////////////////////
    public function addPrivacy(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:admin_settings_policy_terms',

        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('title'=>$request->title);
        $this->setting->insertPrivacy($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }
    public function editTab(Request $request)
    {
        try {
            $result=$this->setting->editTab($request);
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
    public function getBody(Request $request)
    {
        try {
            $result=$this->setting->getBody($request);
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
    public function updateTab(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|unique:admin_settings_policy_terms,title,'.$request->id,
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray = array('title'=>$request->title,'id'=>$request->id,"updated_at" => date('Y-m-d H:i:s'));
        $this->setting->updateTab($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function updatePrivacyBody(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray = array('body'=>$request->body,'id'=>$request->id,"updated_at" => date('Y-m-d H:i:s'));
        $this->setting->updatePrivacyBody($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteTab(Request $request)
    {
        try {
            $result=$this->setting->deleteTab($request);
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
    public function getTab(Request $request)
    {
        try {
            $result=$this->setting->allTab($request);
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
    //////////////////////Service Commission///////////////////////
    public function addServiceCommission(Request $request)
    {
        $v = Validator::make($request->all(), [
            'service_id'=> 'required',
            'comission' => 'required',

        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('service_id'=>$request->service_id,'comission'=>$request->comission);
        $this->setting->insertServiceCommission($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }
    public function getServiceCommission(Request $request)
    {
        try {
            $result=$this->setting->allServiceCommission($request);
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
    public function editServiceCommission(Request $request)
    {
        try {
            $result=$this->setting->editServiceCommission($request);
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
    public function updateServiceCommission(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray = array('service_id'=>$request->service_id,'comission'=>$request->comission,"updated_at" => date('Y-m-d H:i:s'));
        $this->setting->updateServiceCommission($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteServiceCommission(Request $request)
    {
        try {
            $result=$this->setting->deleteServiceCommission($request);
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

    //////////////////////Service Sale Commission///////////////////////
    public function addServiceSaleCommission(Request $request)
    {
        $v = Validator::make($request->all(), [
            'service_id'=> 'required',
            'price' => 'required',
            'sale_commission' => 'required'

        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $insertArray=array('service_id'=>$request->service_id,'comission'=>$request->sale_commission,'posting_price'=>$request->price);
        $this->setting->insertServiceSaleCommission($insertArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully saved.'], 200);
    }
    public function getServiceSaleCommission(Request $request)
    {
        try {
            $result=$this->setting->allServiceSaleCommission($request);
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
    public function editServiceSaleCommission(Request $request)
    {
        try {
            $result=$this->setting->editServiceSaleCommission($request);
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
    public function updateServiceSaleCommission(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $updateArray = array('service_id'=>$request->service_id,'comission'=>$request->sale_commission,'posting_price'=>$request->price,"updated_at" => date('Y-m-d H:i:s'));
        $this->setting->updateServiceSaleCommission($request->id,$updateArray);
        return response()->json(['status' => 'success','message'=>'Your data has been successfully updated.'], 200);
    }
    public function deleteServiceSaleCommission(Request $request)
    {
        try {
            $result=$this->setting->deleteServiceSaleCommission($request);
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
    public function getPrefixTable(Request $request)
    {
        try {
            $result=$this->setting->getPrefix($request);
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
    public function updatePrefix(Request $request)
    {
        $result=$this->setting->updatePrefix($request->prefix);
        return response()->json(['status' => $result,'message'=>'Your data has been successfully saved.'], 200);
    }
    public function getWebsiteInfo(Request $request)
    {
        try {
            $result=$this->setting->getWebsiteInfo($request);
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
    public function updateWebsiteInfo(Request $request)
    {
        $image_array=[];
        $image_logo = $request->get('image_logo');
        $image_favicon = $request->get('image_favicon');
        $background_image = $request->get('background_image');
        $logo_image_name=$this->uploadImage($image_logo);
        if($logo_image_name){
            $image_array['0']=$logo_image_name;
        }
        $image_favicon_name=$this->uploadImage($image_favicon);
        if($image_favicon_name){
            $image_array['1']=$image_favicon_name;
        }
        $background_image_name=$this->uploadImage($background_image);
        if($background_image_name){
            $image_array['2']=$background_image_name;
        }
        $updateArray = array(
            'website_title'=> $request->website_title,
            'google_login_details'=>$request->google_login_details,
            'yami_login_details'=>$request->yami_login_details,
            'yakbun_login_details'=>$request->yakbun_login_details,
            "updated_at" => date('Y-m-d H:i:s'));
        $result=$this->setting->updateWebsiteInfo($updateArray,$image_array);

//
//        if(isset($image_logo) && isset($image_favicon) && isset($background_image))
//        {
//            $logo_image_name=$this->uploadImage($image_logo);
//            $image_favicon_name=$this->uploadImage($image_favicon);
//            $background_image_name=$this->uploadImage($background_image);
//            $updateArray = array(
//                'logo_image'=>$logo_image_name,
//                'favicon'=>$image_favicon_name,
//                'background_image'=>$background_image_name,
//                'website_title'=> $request->website_title,
//                'google_login_details'=>$request->google_login_details,
//                'yami_login_details'=>$request->yami_login_details,
//                'yakbun_login_details'=>$request->yakbun_login_details,
//                "updated_at" => date('Y-m-d H:i:s'));
//        }else if(isset($image_logo) && !isset($image_favicon) && !isset($background_image)){
//            $logo_image_name=$this->uploadImage($image_logo);
//            $updateArray = array(
//                'logo_image'=>$logo_image_name,
//                'website_title'=> $request->website_title,
//                'google_login_details'=>$request->google_login_details,
//                'yami_login_details'=>$request->yami_login_details,
//                'yakbun_login_details'=>$request->yakbun_login_details,
//                "updated_at" => date('Y-m-d H:i:s'));
//        }else if(!isset($image_logo) && isset($image_favicon) && !isset($background_image)){
//            $image_favicon_name=$this->uploadImage($image_favicon);
//            $updateArray = array(
//                'favicon'=>$image_favicon_name,
//                'website_title'=> $request->website_title,
//                'google_login_details'=>$request->google_login_details,
//                'yami_login_details'=>$request->yami_login_details,
//                'yakbun_login_details'=>$request->yakbun_login_details,
//                "updated_at" => date('Y-m-d H:i:s'));
//        }else{
//            $updateArray = array(
//                'website_title'=> $request->website_title,
//                'google_login_details'=>$request->google_login_details,
//                'yami_login_details'=>$request->yami_login_details,
//                'yakbun_login_details'=>$request->yakbun_login_details,
//                "updated_at" => date('Y-m-d H:i:s'));
//        }
        return response()->json(['status' => $result,'message'=>$image_array], 200);
    }
     public function  uploadImage($image){
        if(isset($image)){
            $imageName = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($image)->save(public_path('images/').$imageName);
            return $imageName;
        }

     }
 }
