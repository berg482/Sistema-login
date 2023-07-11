<?php
namespace src\controllers;

use \core\Controller; //liberar uso 
use \src\handlers\LoginHandler;
//use src\handlers\LoginHandler as HandlersLoginHandler;

class HomeController extends Controller {

    private $loggedUser; //receber usuario logado

    public function __construct()
    {   //preencher loggedUser instancia de user
        $this->loggedUser = LoginHandler::checkLogin(); //verificar login
        if($this->loggedUser === false){
            $this->redirect('/login');
        }
       
    }

    public function index() {
        $this->render('home', ['nome' => 'Bonieky']);
    }




}


