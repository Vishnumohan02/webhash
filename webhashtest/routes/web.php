<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/Register','AdminController@register');
//Route::get('Admin-register', 'AdminController@register')->name('register');
Route::post('/store','AdminController@store');
Route::get('/Login','LoginController@login');
Route::post('/profile','LoginController@profilelogin');
Route::get('/Register-students','AdminController@register_students');
Route::post('/students_register','AdminController@students_register');
Route::get('/edit/{id}','AdminController@profileedit');
Route::get('/view_students','AdminController@view');
Route::get('/student_edit/{id}','AdminController@student_edit');
Route::get('/download/{id}','AdminController@download');
Route::put('/student_edit/certificate/delete/{id}', 'AdminController@destroy_certificate');
Route::post('/update/{id}','AdminController@update');
Route::post('/student_update/{id}','AdminController@student_update');
Route::get('/delete/{id}','AdminController@delete');


Route::get('/cancel/{id}','LoginController@canceledit');

Route::get('/Logout','LoginController@logout');


Route::prefix('infrastructure')->group(function() {
      Route::get('/','Admin\InfrastructureController@index')->name('admin.infrastructure');
      Route::get('/create','Admin\InfrastructureController@create')->name('admin.infrastructure.create');
      Route::post('/store','Admin\InfrastructureController@store')->name('admin.infrastructure.store');
      Route::get('/edit/{id}','Admin\InfrastructureController@edit')->name('admin.infrastructure.edit');
      
      Route::post('/{publicId}/update','Admin\InfrastructureController@update')->name('admin.infrastructure.update');
      Route::post('/action','Admin\InfrastructureController@action')->name('admin.infrastructure.action');
      Route::post('update_status', 'Admin\InfrastructureController@update_status')->name('admin.infrastructure.update_status');

      Route::post('upload-image','Admin\InfrastructureController@upload_image')->name('admin.infrastructure.upload-image');
      Route::post('delete-image','Admin\InfrastructureController@delete_image')->name('admin.infrastructure.delete-image');
      Route::post('deleteImage','Admin\InfrastructureController@deleteImage')->name('admin.infrastructure.deleteImage');
      Route::post('/uploadImage','Admin\InfrastructureController@uploadImage')->name('admin.infrastructure.uploadImage');
  });