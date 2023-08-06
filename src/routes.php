<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@logar');
$router->post('/login', 'LoginController@acaologar');//rota para receber dados com metodo post 
$router->get('/formulario', 'HomeController@formulario');
$router->post('/formulario', 'HomeController@acaoformulario');
