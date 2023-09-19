<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'LoginController@logar');
$router->post('/login', 'LoginController@acaologar');//rota para receber dados com metodo post 

$router->get('/formulario', 'HomeController@formulario');
$router->post('/formulario', 'HomeController@acaoformulario');

$router->get('/usuario/{id}/editar', 'HomeController@editar');//pegar info
$router->post('/usuario/{id}/editar', 'HomeController@acaoeditar');//enviar info

$router->get('/usuario/{id}/excluir', 'HomeController@excluir');

$router->get('/sair', 'loginController@sair');