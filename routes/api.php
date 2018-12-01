<?php

use Illuminate\Http\Request;

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

Route::get('all_marque','ApiImmo@getMarque');

Route::get('all_modele/{id}','ApiImmo@findmodele');

Route::get('all_liste','ApiImmo@list');

Route::get('images/{id} ','ApiImmo@showImage');

Route::post('create','ApiImmo@create');

Route::post('upload','ApiImmo@uploadFile');

Route::get("typelogement/{id}","ApiImmo@type_logement");

Route::get("findArticle/{id}","ApiImmo@findArticle");

Route::get("articleBycat/{cat}","ApiImmo@findArticleByCategorie");

Route::get("findvoiture/{id}","ApiImmo@voiture_caracteristique");


Route::post('reservation','ApiImmo@reserve_auto');



Route::get('artisan/command/{key?}', array(function($key = null)
{

 if($key == "config:cache"){
        try {
            echo '<br>php artisan config:cache...';
            \Illuminate\Support\Facades\Artisan::call('config:cache');
            echo '<br>php artisan config:cache completed';
        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }elseif($key == "view-clear"){
        try {
            echo '<br>php artisan view:clear...';
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            echo '<br>php artisan view:clear completed';

        } catch (Exception $e) {
            \Illuminate\Support\Facades\Response::make($e->getMessage(), 500);
        }

    }else{
       \Illuminate\Support\Facades\App::abort(404);
    }

}
));