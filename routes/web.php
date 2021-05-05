<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Specialty
// Metodos de las especialidades (CRUD)
Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties/create', 'SpecialtyController@create'); //form registro
Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit'); 

Route::post('/specialties', 'SpecialtyController@store');//Envio del form
Route::put('/specialties/{specialty}', 'SpecialtyController@update'); 
Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy'); 

//Doctors

Route::resource('doctors','DoctorController');



//Patients