<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json(['message' => 'WallPost API', 'status' => 'Connected']);
});
// Route::resource('usuario', 'UsuarioController'); 
// Route::resource('mural', 'MuralController');
// Route::resource('post', 'PostController');
// Route::resource('auth', 'AuthController');

// POSTS ROTES

Route::get('posts', 'PostController@index');

Route::get('post/{id}', 'PostController@show');

// MURAL ROTES

Route::post('mural/chave', 'MuralController@store');

Route::get('murais', 'MuralController@index');

Route::get('mural/{id}/posts', 'MuralController@muralPosts');

Route::post('mural/qrcode', 'MuralController@muralQr');

// MURAIS VINCULADOS ROTES

Route::post('mural/vincular', 'MuraisVinculadoController@store');

Route::post('mural/desvincular', 'MuraisVinculadoController@destroy');

// USUARIO ROTES

Route::post('usuario/login', 'AuthController@store');

Route::post('usuario/cadastro', 'UsuarioController@store');

Route::get('usuarios', 'UsuarioController@index');

Route::get('usuario/{id}', 'UsuarioController@show');

Route::put('usuario/update/{id}', 'UsuarioController@update');

Route::put('usuario/update/senha/{id}', 'UsuarioController@updateSenha');

Route::get('murais/vinculados/{id}', 'UsuarioController@muraisVinculados');

Route::get('/', function () {
    return redirect('api');
});
