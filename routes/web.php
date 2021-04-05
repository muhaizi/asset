<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetMapController;
use App\Http\Controllers\PremiseController;
use App\Models\AssetMap;

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
    return view('welcome');
});
Route::get('/picker', function () {
    return view('picker');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(
	[
		'middleware' => ['auth'],
	],
	function() {

        Route::group(['prefix' => 'asset', 'as' => 'asset.'], function() {
            Route::delete('/deleteall/{asset?}', [AssetController::class, 'deleteall'])->name('deleteall');
            Route::post('/updateall/{asset?}', [AssetController::class, 'approveall'])->name('pengesahan');
        });
        
        Route::resource('/asset', AssetController::class);

        Route::resource('/premise', PremiseController::class);
        Route::get('asset/{asset}/map', [AssetMapController::class, 'create'])->name('map.create');
        Route::get('asset/{asset}/map/{map:id}', [AssetMapController::class, 'show'])->name('map.show'); //model route binding , removing :id will effect
        Route::post('asset/{asset}/map', [AssetMapController::class, 'store'])->name('map.store');
        

    }
);

//L8 AssetController::class
//L7 AssetController@deleteall

Route::get('/demo', function () {
    $user = App\Models\User::with('ministry')->first();//eager load + performance wise better (using IN()) compared to lazy loading N+1 queries
    //dd($user->ministry->name);
    return new App\Mail\UserRegister($user);
});
