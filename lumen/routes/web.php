<?php
use Illuminate\Http\Request;

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->get('/', function () use ($router) {
  return 'hello';
});



// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
$router->post('auth/login', ['uses' => 'AuthController@login']);
$router->post('auth/register', ['uses' => 'AuthController@register']);
$router->post('auth/logout', ['uses' => 'AuthController@logout']);
});

$router->group(['prefix' => 'api'], function () use ($router) {

    //job requests through commandocenter frontend
    $router->get('commando', ['uses' => 'CommandoController@showAll']);
    $router->get('commando/{id}', ['uses' => 'CommandoController@showOne']);
    $router->post('commando', ['uses' => 'CommandoController@create']);
    $router->put('commando/{id}', ['uses' => 'CommandoController@update']);
    $router->delete('commando/{id}', ['uses' => 'CommandoController@delete']);
    $router->get('test', ['uses' => 'CasinoController@test']);


});

$router->post('/api/authsdas/login/{id}', ['middleware' => 'auth', function (Request $request, $id) {



}]);
