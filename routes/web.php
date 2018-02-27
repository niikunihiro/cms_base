<?php

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
/** @var \Illuminate\Support\Facades\Route $router */
$router->get('/', function () {
    return view('welcome');
});

$router->get('admin', 'DashboardController');
$router->resource('admin/article', 'ArticleController');
$router->get('adminlte', 'AdminLteController');
