<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\PosterPagesController;
use App\Http\Controllers\UploadImagesController;
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
Route::get('/'                  , [PublicPagesController::class, 'index'])->name('home');
Route::get('/news'              , [PublicPagesController::class, 'dummy']);
Route::get('/category'          , [PublicPagesController::class, 'dummy']);
Route::get('/ranking'           , [PublicPagesController::class, 'dummy']);
Route::get('/search'            , [PublicPagesController::class, 'dummy']);
Route::get('/about'             , [PublicPagesController::class, 'dummy']);
Route::get('/company'           , [PublicPagesController::class, 'dummy']);
Route::get('/member'            , [PublicPagesController::class, 'dummy']);
Route::get('/agreement'         , [PublicPagesController::class, 'dummy']);
Route::get('/contact'           , [PublicPagesController::class, 'dummy']);
Route::get('/site-policy'       , [PublicPagesController::class, 'dummy']);
Route::get('/privacy-policy'    , [PublicPagesController::class, 'dummy']);
Route::get('/shou'              , [PublicPagesController::class, 'shou']);
Route::resource('/article'      , PublicPagesController::class, ['only' => ['index', 'show']]);

Route::resource('/post'         , PosterPagesController::class);
Route::get('/new-post'          , [PosterPagesController::class, 'newPost'])->name('post.new_post');
Route::post('/new-post'          , [PosterPagesController::class, 'continuePost'])->name('post.new_post_image');
// Route::get('/new'               , function(){return view('poster/article_new_post');})->name('post.new');
Route::post('/post/tempsave'             , [PosterPagesController::class, 'saveEditingToSession'])->name('post.tempsave');


Route::get('/image/upload'            , [UploadImagesController::class, 'index'])->name('image.upload_form')->where('id', '[0-9]+');
Route::get('/image/select'             , [UploadImagesController::class, 'selectArticleImage'])->name('image.select');
Route::resource('/image'        , UploadImagesController::class,['except' =>['index', 'store']])->names([
    // 'index' => 'image.upload-form',
    'yandex' => 'image.upload-form',
    ]);
Route::post('/upload'           , [UploadImagesController::class, 'upload'])->name('image.upload');
Route::post('/image/delete' , [UploadImagesController::class, 'deleteRequest'])->name('image.del-req');

Route::get('/faker', function () {
    $faker = Faker\Factory::create('ja_JP');
    $dummyData = [
        'name' => $faker->name,
        'password' => $faker->password,
        'country' => $faker->country,
        'prefecture' => $faker->prefecture,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'address' => $faker->address,
        'streetAddress' => $faker->streetAddress,
        'phoneNumber' => $faker->phoneNumber,
        'email' => $faker->email,
        'safeEmail' => $faker->safeEmail,   // (実在しないアドレスのため処理とかで使っても安心)
        'company' => $faker->company,
        'iso8601' => $faker->iso8601($max = 'now'),
        'dateTimeBetween' => $faker->dateTimeBetween($startDate = '-110 years', $endDate = 'now')->format('Y年m月d日'),
        'numberBetween' => $faker->numberBetween($min = 100, $max = 200),
        'title' => $faker->title,
        'realText' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'randomNumber' => $faker->randomNumber($nbDigits = 5),
        'randomFloat' => $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 5),
        'randomElement' => $faker->randomElement($array = ['男性', '女性']),
        'lexify' => $faker->lexify($string = '??????'),
        'hexcolor' => $faker->hexcolor,
        'ipv4' => $faker->ipv4,
        'url' => $faker->url,
        'imageUrl' => $faker->imageUrl($width = 640, $height = 480, $category = 'cats', $randomize = true, $word = null),
        'userAgent' => $faker->userAgent,
        'creditCardType' => $faker->creditCardType,
        'creditCardNumber' => $faker->creditCardNumber,
        'creditCardExpirationDate' => $faker->creditCardExpirationDate,
        'isbn13' => $faker->isbn13,
        'isbn10' => $faker->isbn10
    ];
    echo('<pre>');
    var_dump($dummyData);
    echo('</pre>');
    exit();
});
