<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['id', 'user_id', 'title', 'brand_id', 'year', 'mileage', 'regular_price', 'sale_price', 'search_price', 'negotiable', 'brand_model_id', 'category_id', 'body_type_id', 'fuel_type_id', 'transmission_type_id', 'condtion_id', 'featured_image', 'description', 'label', 'value', 'top_speed', 'currency_code', 'currency_symbol', 'created_at', 'updated_at'];

    public function user() {
      return $this->belongsTo('App\Models\User');
    }

    public function brand() {
      return $this->belongsTo('App\Models\Brand');
    }

    public function brand_model() {
      return $this->belongsTo('App\Models\BrandModel');
    }

    public function category() {
      return $this->belongsTo('App\Models\Category');
    }

    public function body_type() {
      return $this->belongsTo('App\Models\BodyType');
    }

    public function fuel_type() {
      return $this->belongsTo('App\Models\FuelType');
    }

    public function transmission_type() {
      return $this->belongsTo('App\Models\TransmissionType');
    }

    public function condtion() {
      return $this->belongsTo('App\Models\Condtion');
    }

    public function car_images() {
      return $this->hasMany('App\Models\CarImage');
    }
}
