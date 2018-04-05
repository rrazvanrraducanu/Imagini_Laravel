<?php
Route::get("/",'ImagesController@showall');
Route::get("image",'ImagesController@index');
Route::any("store",'ImagesController@store');
Route::get("show/{id}",'ImagesController@show');
Route::get("edit/{id}",'ImagesController@edit');
Route::any("update/{id}",'ImagesController@update');
Route::get("delete/{id}",'ImagesController@delete');