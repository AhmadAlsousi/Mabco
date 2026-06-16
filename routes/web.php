<?php

use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return response()->json(['name' => 'Ahmad']);
});

// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '^(?!api).*$');


// Route::get('/user', function () {
//     return "Hello";
// });
Route::get('/', function () {
    return 'Laravel works';
});
Route::get('/swagger', function () {
    return view('l5-swagger::index');
});