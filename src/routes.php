<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signinAction');//rota para receber dados com metodo post 
$router->get('/cadastro', 'LoginController@signup');
