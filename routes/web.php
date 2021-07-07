<?php

use App\Http\Controllers\StepFormController;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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
//        Alert::success('Success Title', 'Success Message');
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');

//Route::get('/projects', [App\Http\Controllers\PostController::class,'index'])->name('index');
Route::resource('/projetcs','PostController');

Route::prefix('admin')->group(function() {
    Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/confirmstatus', [\App\Http\Controllers\AdminController::class, 'confirm_report'])->name('admin.report_authorize');
    Route::get('/report', 'AdminController@showReport')->name('admin.report');
    Route::get('/report/comment', [\App\Http\Controllers\AdminController::class, 'comment_report'])->name('admin.comment');
    Route::post('/updateprojectstatus', [\App\Http\Controllers\AdminController::class, 'updatestatus'])->name('updateStatus');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('confirm_stepform', 'AdminController@confirm')->name('admin.confirm_stepform');
    Route::post('/projectAuthorize', [\App\Http\Controllers\AdminController::class, 'projectAutherize'])->name('admin.projectAuthorize');
    Route::get('/defaultdonate', [\App\Http\Controllers\FinacialController::class, 'Defaultdonate'])->name('default_donate');
    Route::get('/edit/{id}', [\App\Http\Controllers\AdminController::class, 'showEdit']);
    Route::post('/edit', [\App\Http\Controllers\AdminController::class, 'update']);
});

Route::get('/enrollform' , [App\Http\Controllers\EnrollFormController::class, 'index']);
Route::post('/enrollform',[App\Http\Controllers\EnrollFormController::class, 'enrollform'])->name('enrollform');

Route::get('/stepform', [App\Http\Controllers\StepFormController::class, 'index']);
Route::post('/stepform', [App\Http\Controllers\StepFormController::class, 'stepform'])->name('stepform');

Route::get('/qrcode', [App\Http\Controllers\QrcodeController::class, 'index']);
Route::post('/qrin', [App\Http\Controllers\QrcodeController::class, 'gen'])->name('gen');

Route::get('/test',[App\Http\Controllers\TestController::class,'index']);
Route::get('/myproject', [\App\Http\Controllers\HomeController::class, 'myproject'])->name('myproject');
Route::get('/myproject/{id}', [\App\Http\Controllers\StepFormController::class, 'get_project']);

Route::get('/withdraw/{id}', [\App\Http\Controllers\FinacialController::class, 'show_withdraw'])->name('withdraw');
Route::post('/save_withdraw', [\App\Http\Controllers\FinacialController::class, 'save_withdraw'])->name('save_withdraw');
Route::post('/report', [\App\Http\Controllers\StepFormController::class, 'store_report'])->name('report');
Route::post('/UploadImage', [\App\Http\Controllers\UploadController::class, 'UploadImage']);
Route::post('/donate/{id}', [\App\Http\Controllers\FinacialController::class, 'donate'])->name('donate');
Route::post('/add_comment', [\App\Http\Controllers\StepFormController::class, 'insertComment'])->name('add_comment');
