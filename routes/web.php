<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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


route::get('/redirect',[HomeController::class,'redirect']);


route::get('/',[HomeController::class,'index']);

route::get('/product',[AdminController::class,'product']);

route::post('/uploadproduct',[AdminController::class,'uploadproduct']);

route::get('/showproduct',[AdminController::class,'showproduct']);

route::get('/deleteproduct/{id}',[AdminController::class,'deleteproduct']);

route::get('/redirect2',[AdminController::class,'redirect2']);

route::get('/updateview/{id}',[AdminController::class,'updateview']);

route::post('/updateproduct/{id}',[AdminController::class,'updateproduct']);

route::get('/search',[HomeController::class,'search']);

route::post('/addcart/{id}/{title}',[HomeController::class,'addcart']);

route::get('/showcart',[HomeController::class,'showcart']);

route::get('/delete/{id}',[HomeController::class,'deletecart']);

route::get('/aboutus',[HomeController::class,'aboutus']);

route::post('/order',[HomeController::class,'confirmorder']);

route::get('/showorder',[AdminController::class,'showorder']);

route::get('/updatestatus/{id}',[AdminController::class,'updatestatus']);

route::get('/userprofile/{id}',[HomeController::class,'userprofile']);

route::post('/updateuserprofile/{id}',[HomeController::class,'updateuserprofile']);

route::get('/showhistory',[HomeController::class,'showhistory']);

route::get('/redirect3',[AdminController::class,'redirect3']);


//route::get('/redirect',[HomeController::class,'index']);



// call api
// Route::get('view/detail/users', [HomeController::class, 'redirect'])->name('view/detail/users');
//Route::get('/redirect', [HomeController::class, 'redirect']);

// login api
// Route::get('login', [LoginController::class, 'login'])->name('login');