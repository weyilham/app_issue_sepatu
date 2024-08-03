<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImprovedController;
use App\Http\Controllers\IssueAjaxController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\UserController;
use App\Models\Artikel;
use App\Models\Issue;
use App\Models\Sepatu;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'issue' => Issue::where('status', 'Issue')->where('created_at', '>=', now()->subDays(30))->get(),
        'improve' => Issue::where('status', 'Done')->where('created_at', '>=', now()->subDays(30))->get(),
        'sepatu' => Sepatu::orderBy('id', 'desc')->get(),

    ]);
})->middleware('auth');

Route::resource('/users', UserController::class)->middleware('is_admin');
Route::get('/profile/{user:username}', [ProfileController::class, 'index'])->middleware('auth');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->middleware('auth');

Route::get('/profile/change-password/{user:username}', [ProfileController::class, 'changePassword'])->middleware('auth');
Route::put('/profile/change-password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.change-password')->middleware('auth');


Route::resource('/sepatu', SepatuController::class)->middleware('is_admin', 'is_qc');
Route::get('/getTableSepatu', function () {
    return view('dashboard.sepatu.getTable', [
        'sepatu' => Sepatu::orderBy('id', 'desc')->get(),
    ]);
})->middleware('auth');

Route::get('/getShoes/{id}', function ($id) {
    return response()->json(Sepatu::find($id));
});

Route::resource('/artikel', ArtikelController::class)->middleware('is_admin');

Route::resource('/issue', IssueController::class)->middleware('is_qc');
Route::get('/getIssue/{id}', function ($id) {
    return response()->json(['data' => Issue::find($id), 'sepatu' => Sepatu::orderBy('id', 'desc')->get()]);
});
Route::resource('/ajaxIssue', IssueAjaxController::class)->middleware('is_qc');
Route::get('/improve', [ImprovedController::class, 'index'])->middleware('is_lab');
Route::get('/improve/{id}', [ImprovedController::class, 'show'])->middleware('is_lab');
Route::post('/improve', [ImprovedController::class, 'store'])->middleware('is_lab');
Route::get('/getDataIssue', [ImprovedController::class, 'getDataIssue'])->middleware('auth');
Route::get('/getDataImprove', [ImprovedController::class, 'getDataImprove'])->middleware('auth');
Route::get('/laporan/issue', [LaporanController::class, 'index'])->middleware('auth');
Route::get('/laporan/improve', [LaporanController::class, 'improve'])->middleware('auth');
Route::get('/laporan/getIssue', [LaporanController::class, 'getDataLaporan'])->middleware('auth');
Route::get('/laporan/getImprove', [LaporanController::class, 'getDataLaporanImprove'])->middleware('auth');
Route::get('/laporan/export_issue', [LaporanController::class, 'exportIssue'])->middleware('auth');
Route::get('/laporan/export_improve', [LaporanController::class, 'exportImprove'])->middleware('auth');
Route::get('/dashboard/chart/issue', [ChartController::class, 'index'])->middleware('auth');

// cek email
Route::post('/check-email', [UserController::class, 'checkEmail'])->name('check.email');
