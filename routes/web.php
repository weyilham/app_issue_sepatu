<?php

use App\Http\Controllers\ImprovedController;
use App\Http\Controllers\IssueAjaxController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::resource('/users', UserController::class);
Route::resource('/sepatu', SepatuController::class);
Route::get('/getTableSepatu', function () {
    return view('dashboard.sepatu.getTable', [
        'sepatu' => Sepatu::orderBy('id', 'desc')->get(),
    ]);
});

Route::resource('/issue', IssueController::class);
Route::resource('/ajaxIssue', IssueAjaxController::class);

Route::get('/improve', [ImprovedController::class, 'index']);
Route::get('/getDataIssue', [ImprovedController::class, 'getDataIssue']);
