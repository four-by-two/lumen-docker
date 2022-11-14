<?php
use Illuminate\Http\Request;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Casino Related Routes
|--------------------------------------------------------------------------
|
*/


$router->get('g', [
    'as' => 'casino.testingcontroller', 'uses' => '\App\Http\Controllers\Casinodog\Game\SessionsHandler@entrySession'
]);

// API games routes
$router->group(['prefix' => 'api/games'], function () use ($router) {

    // Catch all game API routes and send to the right place
    $router->get('{provider}/{internal_token}/{slug}/{action:.*}', function ($provider, $internal_token, $slug, $action, Request $request) use ($router) {
        $game_controller = config('casinodog.games.'.$provider.'.controller');
        $game_controller_kernel = new $game_controller;
        return $game_controller_kernel->game_event($request);

    });

    // Available when debug mode is enabled to test method functions fast. {$function_name} should be the name of function in TestingController
    $router->get('testing/{function_name}', [
        'as' => 'casino.testingcontroller', 'uses' => '\App\Http\Controllers\Casinodog\TestingController@handle'
    ]);
    

});