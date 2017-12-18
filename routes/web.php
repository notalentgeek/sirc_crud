<?php

use App\Dates;
use Illuminate\Http\Request;

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

/**
 * Display All Dates
 */
Route::get('/', function () {
    $dates = Dates::orderBy('date', 'asc')->get();

    return view('dates', [
        'dates' => $dates,
        'average_max' => Dates::avg('max'),
        'average_min' => Dates::avg('min')
    ]);
});

/**
 * Add A New Dates
 */
Route::post('/dates', function (Request $request) {
    $dates = new Dates;

    $dates->date = $request->date;
    $dates->max = $request->max;
    $dates->min = $request->min;
    $dates->save();

    return redirect('/');
});

/**
 * Update A New Dates
 */
Route::put('/dates', function (Request $request) {
    $dates = Dates::findOrFail($request->update_id);
    $dates->date = $request->update_date;
    $dates->max = $request->update_max;
    $dates->min = $request->update_min;
    $dates->save();

    return redirect('/');
});

/**
 * Delete An Existing Dates
 */
Route::delete('/dates/{id}', function ($id) {
    Dates::findOrFail($id)->delete();

    return redirect('/');
});