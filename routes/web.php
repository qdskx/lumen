<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// 生成APP_KEY
//$router->get('/key', function() {
//    return md5('key');
//});

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});

$router->get('index' , 'IndexController@index');
$router->get('test' , 'ArticleController@test');

//$router->get('article/{id}' , 'IndexController@index_g');
//$router->post('article' , 'IndexController@index_p');
//$router->put('article/{id}' , 'IndexController@index_put');
//$router->delete('article/{id}' , 'IndexController@index_d');

$router->get('article/{id}' , 'ArticleController@index_g');
$router->post('article' , 'ArticleController@index_p');
//$router->put('article/{id}/{title?}' , 'ArticleController@index_put');
$router->put('article' , 'ArticleController@index_put');
$router->delete('article/{id}' , 'ArticleController@index_d');


//中直电子商城
$router->group(['namespace'=>'zzshop','prefix'=>'zzshop'] , function() use ($router){
    $router->get('orderlist' , 'OrderlistController@orderList');
    $router->get('test' , 'OrderlistController@test');
    $router->get('send' , 'OrderlistController@send');
    $router->get('sendEmail' , 'TemsgController@sendEmail');
});