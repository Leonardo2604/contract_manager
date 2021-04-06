<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1', 'namespace' => 'V1'], function() use ($router) {
    $router->group(['prefix' => 'registers', 'namespace' => 'Registers'], function() use ($router) {
        $router->group(['prefix' => 'systems'], function() use ($router) {
            $router->get('/', 'SystemController@index');
            $router->get('/export', 'SystemController@makeReportPdf');
            $router->post('/', 'SystemController@store');
            $router->delete('/', 'SystemController@destroyAll');

            $router->group(['prefix' => '/{systemId}'], function () use ($router) {
                $router->get('/', 'SystemController@show');
                $router->put('/', 'SystemController@update');
                $router->delete('/', 'SystemController@destroy');

                $router->group(['prefix' => 'modules'], function () use ($router) {
                    $router->get('/', 'ModuleController@index');
                    $router->get('/{moduleId}', 'ModuleController@show');
                    $router->post('/', 'ModuleController@store');
                    $router->put('/{moduleId}', 'ModuleController@update');
                    $router->delete('/{moduleId}', 'ModuleController@destroy');
                    $router->delete('/', 'ModuleController@destroyAll');
                });
            });
        });
    });
});
