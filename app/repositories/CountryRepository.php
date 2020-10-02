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

class CountryRepository
{
        private $perPage=10;
        private $pageNo=1;
    public function __construct()
    {


    }
    public  function  insertCountry($insertArray){
        return DB::table('admin_country')->insertGetId($insertArray);
    }
    public function editCountry($params){
        return  DB::table('admin_country')->where('id',$params['id'])->select('*')->first();
    }
    public function updateCountry($id,$updateArray){
        return DB::table('admin_country')->where('id',$id)->update($updateArray);
    }
    public function getCountry(){
        $countryQuery = DB::table('admin_country')
            ->leftjoin('admin_state', 'admin_country.id', '=', 'admin_state.country_id')
//            ->leftjoin('admin_city', 'admin_state.id', '=', 'admin_city.country_id')
            ->select('admin_country.id','admin_country.name',DB::raw('COUNT(admin_state.id) as total_state'))
            ->orderBy('admin_country.name')
            ->groupBy('admin_country.name')->get()->toArray();
        $arr=[];
       // ,DB::raw('COUNT(admin_city.id) as total_city')
        foreach ($countryQuery as $cq) :
            $total_city=DB::table('admin_city')->where('country_id',$cq->id)->select('*')->count();
            $arr[]=array('id'=>$cq->id,
                         'name'=>$cq->name,
                          'total_state'=>$cq->total_state,
                          'total_city'=>$total_city
                           );
        endforeach;
        return $arr;
      //  return $countryQuery;
    }
    public function deleteCountry($params){
         DB::table('admin_country')->where('id',$params['id'])->delete();
         DB::table('admin_state')->where('country_id',$params['id'])->delete();
       return  DB::table('admin_city')->where('country_id',$params['id'])->delete();
    }
    ///////////////////STATE///////////////////////

    public function insertState($insertArray){
        return DB::table('admin_state')->insertGetId($insertArray);
    }
    public function getState($params){
        return DB::table('admin_state')->where('country_id', $params['country_id'])->get()->toArray();
    }
    public function allState(){
        return DB::table('admin_state')->get()->toArray();
    }
    public function editState($params){
        return  DB::table('admin_state')->where('id',$params['id'])->select('*')->first();
    }
    public function updateState($id,$updateArray){
        return DB::table('admin_state')->where('id',$id)->update($updateArray);
    }
    public function deleteState($params){
        return DB::table('admin_state')->where('id',$params['id'])->delete();
    }
    ////////////////////CITY/TOWN/ZIPCODE////////////////
    public function insertCity($params){
        $result=DB::table('admin_state')->where('id',$params['state_id'])->select('*')->first();
        $insertArray=array('name'=>$params['name'],'zipcode'=>$params['zip_code'],'state_id'=>$params['state_id'],'country_id'=>$result->country_id);
         return DB::table('admin_city')->insertGetId($insertArray);
    }
    public function allCity($params){
        if(isset($params['page']) && $params['page']==1){
            $offset=0;
        }else{
            $offset=$params['page']*$this->perPage;
        }
        $resultCity=DB::table('admin_city')->where('country_id', $params['id'])->offset($offset)->limit($this->perPage)->get()->toArray();;
        $totalCity    =DB::table('admin_city')->where('country_id', $params['id'])->count();
        return $dataArray=array('total_rows'=>$totalCity,'per_page'=>$this->perPage,'result'=>$resultCity);
    }
    public function editCity($params){
        return  DB::table('admin_city')->where('id',$params['id'])->select('*')->first();
    }
    public function updateCity($id,$updateArray){
        return DB::table('admin_city')->where('id',$id)->update($updateArray);
    }
    public function deleteCity($params){
        return DB::table('admin_city')->where('id',$params['id'])->delete();
    }
}
