<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\BlogMemberController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginMemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SearchController;
use App\Models\CountryModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
Route::get('/member/profile', function () {
    $data = [];
    if (Auth::user()) {
        $data = Auth::user();
    }
    $country = CountryModel::all();
    return view('member.profile', ['data' => $data, 'country' => $country]);
});
Route::get('/product/detail/{id}', [ProductController::class, 'show']);

Route::put('/member/account/update', [UserController::class, 'updateUser']);
Route::get('/member/account/my-product', [ProductController::class, 'index']);
Route::get('/member/account/add-product/view', [ProductController::class, 'create']);
Route::post('/member/account/add-product', [ProductController::class, 'store']);
Route::get('/member/account/edit-product/{id}/edit', [ProductController::class, 'edit']);
Route::put('/member/account/edit-product/{id}/update', [ProductController::class, 'update']);
Route::delete('/member/account/delete-product', [ProductController::class, 'destroy']);

Route::post('/cart/add', [CartController::class, 'store']);
Route::get('/cart/list', [CartController::class, 'index']);
Route::post('/cart/edit', [CartController::class, 'edit']);
Route::post('/cart/order', [CartController::class, 'order']);
Route::get('/search', [SearchController::class, 'index']);
Route::post('/search', [SearchController::class, 'search']);
Route::post('/search/price', [SearchController::class, 'searchPrice']);
// Route::get('/mail', [CartController::class, 'mail']);

Route::post('/member/checkout', [LoginMemberController::class, 'logout']);
Route::get('/member/register', [LoginMemberController::class, 'index']);
Route::get('/member/login', [LoginMemberController::class, 'viewLogin']);
Route::post('/member/register/add', [LoginMemberController::class, 'create']);
Route::post('/member/login/add', [LoginMemberController::class, 'login']);

Route::get('/member/blogs', [BlogMemberController::class, 'index']);
Route::get('/member/blogs/{id}', [BlogMemberController::class, 'detail']);
//Route::get('/member/blogs/{id}/{page}', [BlogMemberController::class, 'page']);

Route::post('/member/rate/add', [RateController::class, 'store']);
Route::post('/member/comment/add', [CommentController::class, 'store']);
Route::post('/member/comment/reply/add', [CommentController::class, 'replyCMT']);

Auth::routes();

Route::prefix('admin')->middleware('check_admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'index']);
    Route::get('/country/list', [CountryController::class, 'index']);
    Route::put('/updateProfile', [UserController::class, 'updateUser']);
    Route::get('/country/add', [CountryController::class, 'viewAddCountry']);
    Route::post('/country/add', [CountryController::class, 'addCountry']);
    Route::get('/country/edit/{id}', [CountryController::class, 'edit']);
    Route::put('/country/update/{id}', [CountryController::class, 'update']);
    Route::delete('/country/delete/{id}', [CountryController::class, 'delete']);
    Route::resource('/blogs', BlogController::class);
});
