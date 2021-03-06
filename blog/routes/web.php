<?php

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

$router->get('/api/debugShow', 'ArticleController@debugShowArticles');

$router->get('/api/articles', 'ArticleController@showAllArticles');

$router->post('/api/create', 'ArticleController@createArticle');

$router->post('/api/edit', 'ArticleController@editArticle');

$router->get('/api/delete', 'ArticleController@deleteArticle');

$router->get('/', function () use ($router) {
    return $router->app->version();
});