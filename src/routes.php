<?php
use core\Router;

$router = new Router();

$router->get('/', 'IndexController@index');

$router->get('/login', 'LoginController@logar');
$router->post('/login', 'LoginController@acaologar');//rota para receber dados com metodo post 

$router->get('/criar', 'IndexController@criar');
$router->post('/criar', 'IndexController@acaocriar');

$router->get('/usuario/{id}/editar', 'IndexController@editar');//pegar info
$router->post('/usuario/{id}/editar', 'IndexController@acaoeditar');//enviar info

$router->get('/usuario/{id}/excluir', 'IndexController@excluir');

$router->get('/sair', 'loginController@sair');