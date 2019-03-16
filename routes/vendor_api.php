<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/vendor', function(Request $request) {

    return $request->user();

});

Route::post('vendor/login', [
    'uses' => 'OAuth\VendorTokenAuthController@issueToken',
    'middleware' => [
        'cors',
        'vendor_auth',
        'throttle'
    ],
    'as' => 'vendor.login'
]);

Route::post('vendor/register', [
    'uses' => 'Vendor\Auth\RegisterController@register',
    'middleware' => [
        'cors',
        'throttle'
    ],
    'as' => 'vendor.register'
]);


/** BRANCH API */
Route::get('branch/all',[
    'uses' => 'Vendor\BranchController@all',
    'middleware' => ['cors','auth:api','scope:super,vendor_owner,office_counter']
]);


Route::post('branch/create',[
    'uses' => 'Vendor\BranchController@create',

])->middleware([
    'auth:api', 'scope:vendor_owner', 'can:branch.create'
]);

Route::patch('/branch/all/{vendor_detail_id}', [

    'uses' => 'Vendor\BranchController@vendorBranch'

])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter',
    'can:branch.getList'
]);


Route::get('branch/vendor/{vendorId}',[
    'uses' => 'Vendor\BranchController@vendorBranch',
    'middleware' => ['auth:api','scope:vendor_owner']
]);

/**WILAYAH SERVICE */

Route::middleware(['cors'])->prefix('wilayah')->group(function() {
    Route::get('/province/all', [
        'uses' => 'Wilayah\ProvinceController@all'
    ]);

    Route::get('/regencies/{provinceId}', [
        'uses' => 'Wilayah\RegencyController@all'
    ]);

    Route::get('/districts/{regencyId}', [
        'uses' => 'Wilayah\DistrictController@all'
    ]);

    Route::get('/villages/{districtId}', [
        'uses' => 'Wilayah\VillageController@all'
    ]);

    Route::get('/province/search/by', [
        'uses' => 'Wilayah\ProvinceController@searchBy'
    ]);

    Route::get('/district/search/by', [
        'uses' => 'Wilayah\DistrictController@searchBy'
    ]);
});
// ->middleware([
//     'cors'
// ]);

/**
 * TARIF
 */

Route::post('/tarif/create', [
    'uses' => 'Vendor\TarifController@create'
    ])->middleware([
   'cors',
   'auth:api',
   'scope:vendor_owner,office_counter'
]);

Route::patch('/tarif/all/vendor/{vendorDetailId}', [
    'uses' => 'Vendor\TarifController@getByVendor'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter'
 ]);

Route::post('/vehicle/create', [
    'uses' => 'VehicleController@create'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter',
    'can:vehicle.create'
]);

Route::patch('/vehicle/{vendorDetailId}/all', [
    'uses' => 'VehicleController@list',
])->middleware([
    'cors', 'auth:api',
    'scope:vendor_owner,office_counter,staff_warehouse'
]);

/**
 * STAFF
 */
Route::post('/staff/{vendorDetailId}/create', [
    'uses' => 'VendorStaffController@create'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter',
    'exists_role'
]);

Route::get('/staff/{vendorDetailId}/all', [
    'uses' => 'VendorStaffController@list'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter',
    'can:staff.getList'
]);

Route::post('/staff/{vendorId}/confirmation/{token}', [
    'uses' => 'VendorStaffController@setPassword'
])->middleware([
    'cors',
    'exists_vendor_set_password_token'
]);

/**
 * ROLES
 */
Route::patch('/role/all', [
    'uses' => 'RoleController@list',
])->middleware([
    'cors',
    'auth:api'
]);

/**
 * RESI
 */

Route::post('/resi/create', [
    'uses' => 'ResiController@create'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter'
]);

Route::get('/resi/all', [
    'uses' => 'ResiController@list',
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter'
]);

Route::post('/shipping-status/create', [
    'uses' => 'ShippingStatusController@create'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter,staff_warehouse,staff_courier'
]);

Route::post('/shipping-status/update/bulk', [
    'uses' => 'ShippingStatusController@bulk'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter,staff_warehouse,staff_courier'
]);

Route::get('/shipping-status/histories/{resiId}', [
    'uses' => 'ShippingStatusController@list'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,office_counter,staff_warehouse,staff_courier'
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

Route::post('/surat-jalan', [
    'uses' => 'SuratJalanController@create'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,staff_warehouse'
]);

Route::get('/surat-jalan', [
    'uses' => 'SuratJalanController@list'
])->middleware([
    'cors',
    'auth:api',
    'scope:vendor_owner,staff_courier,staff_warehouse'
]);

Route::put('/surat-jalan/on-the-way', [
    'uses' => 'SuratJalanController@onTheWay'
])->middleware([
    'cors',
    'auth:api',
    'scope:staff_courier'
]);

Route::put('/courier/location', [
    'uses' => 'CourierTrackingController@setLocation'
])->middleware([
    'cors',
    'auth:api',
    'scope:staff_courier,staff_warehouse,vendor_owner'
]);
