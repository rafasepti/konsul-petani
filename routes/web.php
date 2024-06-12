<?php

use App\Http\Controllers\BotManController;
use App\Models\Penyakit;
use App\Models\Pertanyaan;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    // return view('welcome');
    return redirect('/login');
});

Route::post('/chatify/botman', [BotManController::class, 'handleChatifyMessage']);
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('/chat', [BotManController::class, 'index']);

Route::get('/dashboard', function () {
    $total_admin = User::where('tipe','admin')->count();
    $total_petani = User::where('tipe','petani')->count();
    $jumlah_pertanyaan = Pertanyaan::count();
    $jumlah_penyakit = Penyakit::count();
    return view('dashboard',
    [
        'total_admin' => $total_admin,  
        'total_petani' => $total_petani,  
        'jumlah_pertanyaan' => $jumlah_pertanyaan,  
        'jumlah_penyakit' => $jumlah_penyakit,  
    ]);
})->middleware(['auth'])->name('dashboard');

// untuk crud user
Route::get('/user','App\Http\Controllers\UserController@index')->middleware(['auth'])->name('user');
Route::get('/user/create', 'App\Http\Controllers\UserController@create')->middleware(['auth']);
Route::post('/user/store', 'App\Http\Controllers\UserController@store')->middleware(['auth']);
Route::get('/user/destroy/{id}', '\App\Http\Controllers\UserController@destroy')->middleware(['auth']);
Route::get('/user/edit/{id}', 'App\Http\Controllers\UserController@edit')->middleware(['auth']);
Route::post('/user/update', 'App\Http\Controllers\UserController@update')->middleware(['auth']);

// untuk crud gejala
Route::get('/gejala','App\Http\Controllers\GejalaController@index')->middleware(['auth'])->name('gejala');
Route::get('/gejala/create', 'App\Http\Controllers\GejalaController@create')->middleware(['auth']);
Route::post('/gejala/store', 'App\Http\Controllers\GejalaController@store')->middleware(['auth']);
Route::get('/gejala/destroy/{id}', '\App\Http\Controllers\GejalaController@destroy')->middleware(['auth']);
Route::get('/gejala/edit/{id}', 'App\Http\Controllers\GejalaController@edit')->middleware(['auth']);
Route::post('/gejala/update', 'App\Http\Controllers\GejalaController@update')->middleware(['auth']);

// untuk crud penyakit
Route::get('/penyakit','App\Http\Controllers\PenyakitController@index')->middleware(['auth'])->name('penyakit');
Route::get('/penyakit/create', 'App\Http\Controllers\PenyakitController@create')->middleware(['auth']);
Route::post('/penyakit/store', 'App\Http\Controllers\PenyakitController@store')->middleware(['auth']);
Route::get('/penyakit/destroy/{id}', '\App\Http\Controllers\PenyakitController@destroy')->middleware(['auth']);
Route::get('/penyakit/edit/{id}', 'App\Http\Controllers\PenyakitController@edit')->middleware(['auth']);
Route::post('/penyakit/update', 'App\Http\Controllers\PenyakitController@update')->middleware(['auth']);

// untuk crud penyakit solusi
Route::get('/penyakitsolusi','App\Http\Controllers\PenyakitSolusiController@index')->middleware(['auth'])->name('penyakitsolusi');
Route::get('/penyakitsolusi/create', 'App\Http\Controllers\PenyakitSolusiController@create')->middleware(['auth']);
Route::post('/penyakitsolusi/store', 'App\Http\Controllers\PenyakitSolusiController@store')->middleware(['auth']);
Route::get('/penyakitsolusi/destroy/{id}', '\App\Http\Controllers\PenyakitSolusiController@destroy')->middleware(['auth']);
Route::get('/penyakitsolusi/edit/{id}', 'App\Http\Controllers\PenyakitSolusiController@edit')->middleware(['auth']);
Route::post('/penyakitsolusi/update', 'App\Http\Controllers\PenyakitSolusiController@update')->middleware(['auth']);

// untuk crud pertanyaan
Route::get('/pertanyaan','App\Http\Controllers\PertanyaanController@index')->middleware(['auth'])->name('pertanyaan');
Route::get('/pertanyaan/create', 'App\Http\Controllers\PertanyaanController@create')->middleware(['auth']);
Route::post('/pertanyaan/store', 'App\Http\Controllers\PertanyaanController@store')->middleware(['auth']);
Route::get('/pertanyaan/destroy/{id}', '\App\Http\Controllers\PertanyaanController@destroy')->middleware(['auth']);
Route::get('/pertanyaan/edit/{id}', 'App\Http\Controllers\PertanyaanController@edit')->middleware(['auth']);
Route::post('/pertanyaan/update', 'App\Http\Controllers\PertanyaanController@update')->middleware(['auth']);

Route::get('/konsultasi','App\Http\Controllers\PertanyaanController@konsultasi')->middleware(['auth'])->name('konsultasi');

require __DIR__.'/auth.php';
