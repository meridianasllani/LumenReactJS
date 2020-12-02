<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('courses', 'CoursesController@index');
$router->get('course/{id}', 'CoursesController@show');
$router->get('/course/', 'CoursesController@filter');
$router->post('course', 'CoursesController@store');
$router->delete('course/{id}', 'CoursesController@destroy');