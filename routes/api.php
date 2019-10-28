<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {

    /** Start of User Registration and Login Router **/
    Route::namespace('Registration')->group(function () {
        Route::post('user_registration', 'RegistrationController@registration');
    });

    Route::namespace('Login')->group(function () {
        Route::post('user_login', 'LoginController@user_login');
    });

    Route::post('all_notification', 'NotificationController@all_notification')->name('all_notification');

    Route::get('vehicle_image/{file_name}', 'Authcheck\AuctionController@vehicle_image')->name('vehicle_image');
    /** End of User Registration and Login Router **/

    Route::middleware(['memberauth'])->group(function () {

        Route::namespace('Authcheck')->group(function () {

            Route::post('fetch_auction', 'AuctionController@fetch_auction')->name('fetch_auction');
            Route::post('fetch_auction_vehicle', 'AuctionController@fetch_auction_vehicle')->name('fetch_auction_vehicle');
            
            Route::post('bid', 'AuctionController@bid')->name('bid');
            Route::post('vehicle_details', 'AuctionController@vehicle_details')->name('vehicle_details');
            Route::post('your_bid', 'AuctionController@your_bid')->name('your_bid');
            Route::post('deposit_buying_limit_available', 'AuctionController@deposit_buying_limit_available')->name('deposit_buying_limit_available');
            Route::post('payment_request_list', 'AuctionController@payment_request_list')->name('payment_request_list');
            Route::post('add_wish_list', 'AuctionController@add_wish_list')->name('add_wish_list');
            Route::post('wish_list', 'AuctionController@wish_list')->name('wish_list');
            Route::post('remove_wish_list', 'AuctionController@remove_wish_list')->name('remove_wish_list');
        });
    });  
});
 