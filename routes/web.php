<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/admin/home', 'HomeController@index')->name('home');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::namespace('Category')->group(function () {

        Route::get('/newcategory', 'CategoryController@create')->name('newcategory');
        Route::post('/newcategory', 'CategoryController@store');
        Route::post('/updatecategory/{category_id}', 'CategoryController@update');
        
        /** Start Ajax Call **/
        Route::get('/updatecategory/{category_id}', function(App\Models\Category\Category $category, $category_id) {

            $category_data = $category->findOrFail($category_id);

            $value = "<p id=\"category_id_modal\" hidden>".$category_data['id']."</p><p class=\"text-bold\">Category : <input type=\"text\" style=\"padding-left: 6px; border-radius: 4px; font-weight: bold;\" id=\"category_name_modal\" value=\"".$category_data['category']."\"/><font style=\"margin-left: 10px;\" id=\"category_name_text\"></font></p><p><center><p id=\"response_msg\"></p><hr><button type=\"button\" id=\"btn_save_category_info\" class=\"btn btn-danger text-bold\" onclick=\"save_category_info()\">Update Category</button></center></p>";

            print $value;
        });
        /** End Ajax Call **/
    });

    Route::namespace('Auction')->group(function () {

        Route::get('/newauction', 'AuctionController@create')->name('newauction');
        Route::post('/newauction', 'AuctionController@store');
        Route::get('/allauction/{type}', 'AuctionController@all_auction')->name('allauction');
        Route::post('/allauction/{type}', 'AuctionController@all_auction_data');
        Route::get('/admin/change_status_auction/{auction_id}/{status}/{type}', 'AuctionController@change_status_auction')->name('change_status_auction');
        Route::get('/updateauction/{auction_id}', 'AuctionController@updateForm')->name('updateauctionform');
        Route::post('/updateauction/{auction_id}', 'AuctionController@update')->name('updateauction');
        Route::get('/allauctionvehicle/{auction_id}', 'AuctionController@all_auction_vehicle')->name('allauctionvehicle');
        Route::get('/vehicle_details/{vehicleId}', 'AuctionController@vehicle_details')->name('vehicle_details');
    });

    Route::namespace('Vehicle')->group(function () {

        Route::get('/newvehicle', 'VehicleController@create')->name('newvehicle');
        Route::put('/newvehicle', 'VehicleController@store');
        Route::get('/allvehicle', 'VehicleController@all_vehicle')->name('allvehicle');
        Route::get('/updatevehicleform/{vehicle_id}', 'VehicleController@update_form')->name('updatevehicleform');
        Route::put('/updatevehicle/{vehicle_id}', 'VehicleController@update');
        
        /** Start Ajax Call **/
        Route::get('/auction_retrive/{category_id}', function(App\Models\Auction\Auction $auction, $category_id) {

            $auction_data = $auction->where('category_id', $category_id)
                                    ->get();

            $data = "<option selected disabled class=\"text-bold\">Choose Auction Group Name";

            foreach ($auction_data as $value)
                $data = $data."</option><option value=\"".$value->id."\" class=\"text-bold\">".$value->auction_group_name."</p>";

            print $data;
        });
        /** End Ajax Call **/
    });

    Route::namespace('Users')->group(function () {

        Route::get('/newusers', 'UsersController@create')->name('newusers');
        Route::get('/verifyusers/{member_id}', 'UsersController@verifyUser')->name('verifyusers');
        Route::put('/verifyusersdata/{member_id}', 'UsersController@verifyUserData')->name('verifyusersdata');
        Route::get('/deleteusers/{member_id}', 'UsersController@deleteUser')->name('deleteusers');
        Route::get('member_image/{filename}', 'UsersController@memberImage')->name('member_image');
        Route::get('member_image_1/{filename_1}', 'UsersController@memberImage_1')->name('member_image_1');
        Route::get('/allusers', 'UsersController@allUser')->name('allusers');
        Route::get('/updatestatus/{member_id}/{status}', 'UsersController@updateStatus')->name('updatestatus');
    });

    Route::namespace('Notification')->group(function () {

        Route::get('/newnotification', 'NotificationController@showNotificationForm')->name('newnotification');
        Route::post('newnotification', 'NotificationController@create'); 
        Route::get('/allnotification', 'NotificationController@allNotification')->name('allnotification');
        Route::get('/updatenotification/{notificationId}', 'NotificationController@showNotificationUpdateForm')->name('updatenotification'); 
        Route::post('updatenotification/{notificationId}', 'NotificationController@update');    
    });

    Route::namespace('Bid')->group(function () {

        Route::get('/running_bids', 'BidController@allRunningBids')->name('running_bids');
        Route::get('/expired_bids', 'BidController@allExpiredBids')->name('expired_bids');
        Route::get('/winner_bid/{bidId}', 'BidController@allWinnerBid')->name('winner_bid'); 
        Route::get('/winner_bids', 'BidController@allWinnerBids')->name('winner_bids');   
    });
});

// Routes for user

Route::get('/user', function () {
    return view('user.login');
});

Route::get('/user/register', function () {
    return view('user.register');
});
Route::post('user/register', 'FrontController@register');

