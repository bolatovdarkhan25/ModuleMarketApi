<?php

/** @var Router $router */

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

use Laravel\Lumen\Routing\Router;

$router->get('/', 'Controller@info');

$router->group(['prefix' => 'goods'], function () use ($router) {

});

$router->group(['prefix' => 'groups'], function () use ($router) {
    $router->get('', 'GroupController@index');
});

$router->group(['prefix' => 'categories'], function () use ($router) {
    $router->get('get-list-by-group-with-subcategories', 'CategoryController@getListByGroupIdWithSubcategories');
});
