<?php

use App\Models\Album;
use App\Models\Photo;
use App\User;

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
Route::get('/','HomeController@index');

Route::get('/albums','AlbumsController@index')->name('albums');
Route::delete('/albums/{id}','AlbumsController@delete')->where('id','[0-9]+');
Route::get('/albums/{id}','AlbumsController@show')->where('id','[0-9]+');
Route::get('/albums/{id}/edit','AlbumsController@edit');
Route::get('/albums/create','AlbumsController@create')->name('album.create');
Route::post('/albums','AlbumsController@save')->name('album.save');
//Route::post('/albums/{id}','AlbumsController@store');
Route::patch('/albums/{id}','AlbumsController@store');
Route::get('/albums/{album}/images','AlbumsController@getImages')
    ->name('album.getmages')
    ->where('album','[0-9]+');


Route::get('/photos',function(){
        
        return Photo::all();
});
   
Route::get('/users',function(){
        
        return User::all();
 });

Route::get('/usersnoalbums',function(){
        $usersnoalbums = DB::table('users as u')
                        ->leftJoin('albums as a', 'u.id','=','a.user_id')
                        ->select('u.id','u.name','a.album_name')
                        ->whereNull('a.album_name')
                        ->get();
        return $usersnoalbums;
});

Route::get('/{name?}/{lastname?}/{age?}','WelcomeController@welcome')->where([
    'name' => '[a-zA-Z]+',
    'lastname' => '[a-zA-Z]+',
    'age' => '[0-9]{0,2}'
    ]);
    /*
    -> where('name','[a-zA-Z]+')
    -> where('lastname','[a-zA-Z]+')
    */
