<?php
session_start();

$uri = $_GET['page'];

require_once 'controller/AccueilController.php';
require_once 'controller/AuthController.php';
$pdo= new PDO('mysql:host=localhost;dbname=todos','root','root');
$user = new User('','','','',$pdo);
$accueilView = new AccueilView();
$register = new RegisterView();
$login = new LoginView();
switch($uri){
    case 'register':
        
        $authControl = new AuthController($user,$register,$login);
        $authControl->register();
        break;
    case 'login':
        $authControl = new AuthController($user, $register,$login);
        $authControl->login();
        break;
    case 'logout':
        $authControl = new AuthController($user, $register, $login);
        $authControl->logout();
        break;
    case '':
    case 'accueil':
    default:
        $accueil = new AccueilController($user,$accueilView);
        $accueil->render();
}