<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckOngkirController;
//use App\Http\Controllers\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


route::get('/redirect',[HomeController::class,'redirect'])->name('home');


route::get('/',[HomeController::class,'index']);

route::get('/product',[AdminController::class,'product']);

route::post('/uploadproduct',[AdminController::class,'uploadproduct']);

route::get('/showproduct',[AdminController::class,'showproduct']);

route::get('/verifikasiktm',[AdminController::class,'verifikasiktm']);

route::get('/deleteproduct/{id}',[AdminController::class,'deleteproduct']);

route::get('/deletektm/{id}',[AdminController::class,'deletektm']);

route::get('/redirect2',[AdminController::class,'redirect2']);

route::get('/updateview/{id}',[AdminController::class,'updateview']);

route::post('/updateproduct/{id}',[AdminController::class,'updateproduct']);

route::get('/search',[HomeController::class,'search']);

route::post('/addcart/{id}/{title}',[HomeController::class,'addcart']);

route::get('/showcart',[HomeController::class,'showcart'])->name('showcart');

route::get('/delete/{id}',[HomeController::class,'deletecart']);

route::get('/aboutus',[HomeController::class,'aboutus']);

route::post('/order',[HomeController::class,'confirmorder']);

//route::get('/order/{id}',[HomeController::class,'confirmorder']);

// route::post('/order/{id}',[HomeController::class,'confirmorder']);

route::get('/showorder',[AdminController::class,'showorder']);

route::get('/updatestatus/{id}',[AdminController::class,'updatestatus']);

route::get('/verifikasifotoktm/{id}',[AdminController::class,'verifikasifotoktm']);

route::get('/userprofile/{id}',[HomeController::class,'userprofile']);

route::post('/updateuserprofile/{id}',[HomeController::class,'updateuserprofile']);

route::get('/showhistory',[HomeController::class,'showhistory']);

route::get('/redirect3',[AdminController::class,'redirect3']);

route::get('/payment',[HomeController::class,'payment']);

//route::post('/payment',[HomeController::class,'payment_post']);

//route::get('/showcart',[HomeController::class,'payment']);

route::post('/showcart',[HomeController::class,'payment_post']);

// route::get('/showcart',[CheckOngkirController::class,'index']);

// route::get('/ongkir',[CheckOngkirController::class,'index']);
// route::post('/ongkir',[CheckOngkirController::class,'check_ongkir']);
// route::get('/cities/{province_id}',[CheckOngkirController::class,'getCities']);


route::get('/ongkir',[HomeController::class,'cekongkir']);
route::post('/ongkir',[HomeController::class,'check_ongkir']);
route::get('/cities/{province_id}',[HomeController::class,'getCities']);

route::get('/showtransaction',[AdminController::class,'showtransaction']);

route::get('/showtransactiondetail/{id}',[AdminController::class,'showtransactiondetail']);

route::get('/showhistorydetail/{id}',[HomeController::class,'showhistorydetail']);

// route::post('/showcart/{hargaongkir}',[HomeController::class,'hargaongkir']);

route::post('/addongkir/{hargaongkir}',[HomeController::class,'hargaongkir'])->name('addongkir');

route::post('/updateuserktm/{id}',[HomeController::class,'updateuserktm']);

// route::post('/addongkir',[HomeController::class,'hargaongkir'])->name('addongkir');
// route::get('/showcart',[HomeController::class,'cekongkir']);

// route::get('/showcart',[HomeController::class,'cekongkir']);

// Route::get('/ongkir', 'CheckOngkirController@index');
// Route::post('/ongkir', 'CheckOngkirController@check_ongkir');
// Route::get('/cities/{province_id}', 'CheckOngkirController@getCities');


//route::get('/redirect',[HomeController::class,'index']);



// call api
// Route::get('view/detail/users', [HomeController::class, 'redirect'])->name('view/detail/users');
//Route::get('/redirect', [HomeController::class, 'redirect']);

// login api
// Route::get('login', [LoginController::class, 'login'])->name('login');