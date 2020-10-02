<?php
/**
 * Created by PhpStorm.
 * User: asimr
 * Date: 7/8/2019
 * Time: 1:34 AM
 */

namespace App\repositories;
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

    public function allBrand(){
        return DB::table('brands')->where('status',1)->get()->toArray();;
    }
    public function allBrandModel(){
        return DB::table('brand_models')->where('status',1)->get()->toArray();;
    }
    public function allBody(){
        return DB::table('body_types')->where('status',1)->get()->toArray();;
    }

    ///////////////////Company Type///////////////////////
    public  function  insertCompanyType($insertArray){
        return DB::table('admin_settings_company_types')->insertGetId($insertArray);
    }
    public function editCompanyType($params){
        return  DB::table('admin_settings_company_types')->where('id',$params['id'])->select('*')->first();
    }
    public function updateCompanyType($id,$updateArray){
        return DB::table('admin_settings_company_types')->where('id',$id)->update($updateArray);
    }
    public function allCompanyType(){
        return DB::table('admin_settings_company_types')->get()->toArray();;
    }
    public function deleteCompanyType($params){
        return  DB::table('admin_settings_company_types')->where('id',$params['id'])->delete();
    }

    ///////////////////Company Skill///////////////////////
    public  function  insertCompanySkill($insertArray){
        return DB::table('admin_settings_company_skills')->insertGetId($insertArray);
    }
    public function editCompanySkill($params){
        return  DB::table('admin_settings_company_skills')->where('id',$params['id'])->select('*')->first();
    }
    public function updateCompanySkill($id,$updateArray){
        return DB::table('admin_settings_company_skills')->where('id',$id)->update($updateArray);
    }
    public function allCompanySkill(){
        return DB::table('admin_settings_company_skills')->get()->toArray();;
    }
    public function deleteCompanySkill($params){
        return  DB::table('admin_settings_company_skills')->where('id',$params['id'])->delete();
    }

    ///////////////////Reason Category///////////////////////
    public  function  insertReasonCategory($insertArray){
        return DB::table('admin_settings_reason_category')->insertGetId($insertArray);
    }
    public function editReasonCategory($params){
        return  DB::table('admin_settings_reason_category')->where('id',$params['id'])->select('*')->first();
    }
    public function updateReasonCategory($id,$updateArray){
        return DB::table('admin_settings_reason_category')->where('id',$id)->update($updateArray);
    }
    public function allReasonCategory(){
        $reasonCategoryQuery = DB::table('admin_settings_reason_category')
            ->leftjoin('admin_settings_reasons', 'admin_settings_reason_category.id', '=', 'admin_settings_reasons.category_id')
            ->select('admin_settings_reason_category.id','admin_settings_reason_category.name', DB::raw('COUNT(admin_settings_reasons.id) as total_reason'))
            ->orderBy('admin_settings_reason_category.id')
            ->groupBy('admin_settings_reason_category.name')->get()->toArray();
        return $reasonCategoryQuery;
//        return DB::table('admin_settings_reason_category')->get()->toArray();;
    }
    public function deleteReasonCategory($params){
        DB::beginTransaction();
        try {
            DB::table('admin_settings_reason_category')->where('id',$params['id'])->delete();
            DB::table('admin_settings_reasons')->where('category_id',$params['id'])->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception('not deleted');
        }
    }

    ///////////////////Reason///////////////////////
    public  function  insertReason($insertArray){
        return DB::table('admin_settings_reasons')->insertGetId($insertArray);
    }
    public function editReason($params){
        return  DB::table('admin_settings_reasons')->where('id',$params['id'])->select('*')->first();
    }
    public function updateReason($id,$updateArray){
        return DB::table('admin_settings_reasons')->where('id',$id)->update($updateArray);
    }
    public function deleteReason($params){
        return  DB::table('admin_settings_reasons')->where('id',$params['id'])->delete();
    }
    public function allReason($params){
        return DB::table('admin_settings_reasons')->where('category_id',$params['category_id'])->get()->toArray();;
    }
    ///////////////////Privacy///////////////////////
    public  function  insertPrivacy($insertArray){
        return DB::table('admin_settings_policy_terms')->insertGetId($insertArray);
    }
    public function editTab($params){
        return  DB::table('admin_settings_policy_terms')->where('id',$params['id'])->select('*')->first();
    }
    public function updateTab($id,$updateArray){
        return DB::table('admin_settings_policy_terms')->where('id',$id)->update($updateArray);
    }
    public function updatePrivacyBody($id,$updateArray){
        return DB::table('admin_settings_policy_terms')->where('id',$id)->update($updateArray);
    }
    public function allTab($params){
        if(isset($params['sort_id']) && $params['sort_id']==1){
            $order_by='asc';
        }else{
            $order_by='desc';
        }
        return DB::table('admin_settings_policy_terms')->orderBy('title', $order_by)->get()->toArray();
    }
    public function deleteTab($params){
        return  DB::table('admin_settings_policy_terms')->where('id',$params['id'])->delete();
    }
    public function getBody($params){
        return  DB::table('admin_settings_policy_terms')->where('id',$params['id'])->select('*')->first();
    }
    ///////////////////Service Commission///////////////////////
    public  function  insertServiceCommission($insertArray){
        return DB::table('admin_service_comission')->insertGetId($insertArray);
    }
    public function editServiceCommission($params){
        return DB::table('admin_service_comission')->where('id',$params['id'])->select('*')->first();
    }
    public function updateServiceCommission($id,$updateArray){
        return DB::table('admin_service_comission')->where('id',$id)->update($updateArray);
    }
    public function deleteServiceCommission($params){
        return  DB::table('admin_service_comission')->where('id',$params['id'])->delete();
    }
    public function allServiceCommission($params){
        $reasonServiceCommissionQuery = DB::table('admin_service_comission')
            ->join('admin_service_category', 'admin_service_category.id', '=', 'admin_service_comission.service_id')
            ->select('admin_service_comission.id','admin_service_category.name','admin_service_comission.comission')
            ->orderBy('admin_service_comission.id')->get()->toArray();
        return $reasonServiceCommissionQuery;
    }

    ///////////////////Service Sale Commission///////////////////////
    public function insertServiceSaleCommission($insertArray){
        return DB::table('admin_settings_sales_comission')->insertGetId($insertArray);
    }
    public function editServiceSaleCommission($params){
        return DB::table('admin_settings_sales_comission')->where('id',$params['id'])->select('*')->first();
    }
    public function updateServiceSaleCommission($id,$updateArray){
        return DB::table('admin_settings_sales_comission')->where('id',$id)->update($updateArray);
    }
    public function deleteServiceSaleCommission($params){
        return  DB::table('admin_settings_sales_comission')->where('id',$params['id'])->delete();
    }
    public function allServiceSaleCommission($params){
        $reasonServiceCommissionQuery = DB::table('admin_settings_sales_comission')
            ->join('admin_service_category', 'admin_service_category.id', '=', 'admin_settings_sales_comission.service_id')
            ->select('admin_settings_sales_comission.id','admin_service_category.name','admin_settings_sales_comission.posting_price','admin_settings_sales_comission.comission')
            ->orderBy('admin_settings_sales_comission.id')->get()->toArray();
        return $reasonServiceCommissionQuery;
    }

    ////////////////////////Prefix Table//////////////////////////////////////////

    public function getPrefix($params){
        return DB::table('admin_settings_prefix')->get()->toArray();
        }
    public function updatePrefix($insertArray){
        $id=[];
        $prefix=[];
        for($i=1; $i<count($insertArray); $i++){
            $id[]=$i;
            DB::table('admin_settings_prefix')->where('id', $i)->update(array('value'=>$insertArray[$i]));
           // $prefix[]=array('value'=>$insertArray[$i]);
        }
        return true;
    }
    public function getWebsiteInfo(){
        return DB::table('admin_settings_website_infos')->first();
    }
    public function updateWebsiteInfo($updateArray,$imageArray){
        if(count($imageArray)>0){
            for($i=0; $i<count($imageArray); $i++){
                if(isset($imageArray[$i]) && $imageArray[$i]==0){
                    DB::table('admin_settings_website_infos')->where('id', 1)->update(array('logo_image'=>$imageArray[$i]));
                }
                if(isset($imageArray[$i]) && $imageArray[$i]==1) {
                    DB::table('admin_settings_website_infos')->where('id', 1)->update(array('favicon' => $imageArray[$i]));
                }
                if(isset($imageArray[$i]) && $imageArray[$i]==2){
                    DB::table('admin_settings_website_infos')->where('id', 1)->update(array('background_image'=>$imageArray[$i]));
                }
                // $prefix[]=array('value'=>$insertArray[$i]);
            }
        }

        return DB::table('admin_settings_website_infos')->where('id',1)->update($updateArray);
    }
}
