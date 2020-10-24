<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        // Below mention routes are public, user can access those without any restriction.
        // Create New User
        Route::post('register', 'AuthController@register');
        // Login User
        Route::post('login', 'AuthController@login');
        Route::get('/register/verify/{token}', 'AuthController@token');

        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');

        // Below mention routes are available only for the authenticated users.
        Route::middleware('auth:api')->group(function () {
            // Get user info
            Route::get('user', 'AuthController@user');
            // Update user info
            Route::post('update-user', 'AuthController@updateUser');
            // Logout user from application
            Route::post('logout', 'AuthController@logout');

        });
    });
    Route::prefix('home-page')->group(function () {
             // List of Home Page Filter
            Route::get('list', 'CommonController@getHomePage');
             // List of Top Featured Vehicle
            Route::get('featured-list', 'CommonController@getFeaturedVehicle');
    });
    Route::prefix('vehicle-feature')->group(function () {
        // List of Car Feature list
        Route::get('list', 'CommonController@getVehicleFeatureList');

    });
    Route::prefix('vehicle')->group(function () {
        // List of NEW and USED Vehicle
        Route::post('list', 'CommonController@allVehicle');
        // List Filter Vehicle
        Route::post('filter', 'CarController@getCarFilter');
        // List Details Vehicle
        Route::get('details', 'CarController@getCarDetails');
    });

});
