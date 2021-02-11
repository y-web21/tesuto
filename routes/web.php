<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPagesController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

// routing by closure
Route::get('/closure', function () {
    return PublicPagesController::class;
});
Route::get('/home', function () {
    return view('public/home');
});

// routing to controller
Route::get('/'                  , [PublicPagesController::class, 'index']);
Route::get('/news'              , [PublicPagesController::class, 'dummy']);
Route::get('/category'          , [PublicPagesController::class, 'dummy']);
Route::get('/ranking'           , [PublicPagesController::class, 'dummy']);
Route::get('/search'            , [PublicPagesController::class, 'dummy']);
Route::get('/about'             , [PublicPagesController::class, 'dummy']);
Route::get('/company'           , [PublicPagesController::class, 'dummy']);
Route::get('/member'            , [PublicPagesController::class, 'dummy']);
Route::get('/agreement'         , [PublicPagesController::class, 'dummy']);
Route::get('/contact'           , [PublicPagesController::class, 'dummy']);
Route::get('/site_policy'       , [PublicPagesController::class, 'dummy']);
Route::get('/privacy_policy'    , [PublicPagesController::class, 'dummy']);
