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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/users', function(Request $request) {
    return $request->user();
});
// Route::middleware('provider_detector', 'throttle')->post('/test',
//     'OAuth\VendorTokenAuthController@issueToken' );

// Route::post('oauth/token/', 'OAuth\VendorTokenAuthController@issueToken')
//         ->middleware(['provider_detector', 'throttle'])
//         ->name('issue.token');


Route::get('/maps','GoogleMapController@getCordinate')
->middleware(['cors']);


Route::post('/customer/register', [

    'uses' => 'Customer\RegisterController@create'

])->middleware([
    'cors',
    'throttle'
]);

Route::post('/customer/login', [
    'uses' => 'Customer\CustomerTokenAuthController@issueToken'
])->middleware([
    'cors',
    'customer_auth',
    'throttle'
]);


/**
 * Booking
 */

 Route::post('/pengiriman/booking', [
     'uses' => 'Customer\BookingController@create',
 ])->middleware([
     'cors',
     'auth:api',
     'find_tarif'
 ]);
 Route::get('/pengiriman/bookings', [
    'uses' => 'Customer\BookingController@all'
 ])->middleware([
     'cors',
     'auth:api',
     'scope:vendor_owner,office_counter,customer',
    //  'can:booking.getList'
 ]);

 Route::get('/tarif/search-near', [
     'uses' => 'Vendor\TarifController@searchTarifNear'
 ])->middleware([
    'cors',
    'auth:api'
 ]);

 /**
  * ADDRESSBOOK
  */
Route::get('/addressbook/search', [
    'uses' => 'AddressBookController@search',
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter'
]);

Route::post('/addressbook/create', [
    'uses' => 'AddressBookController@create',
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter'
]);
