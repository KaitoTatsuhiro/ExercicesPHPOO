<?php
session_start();

$uri = $_GET['page'] ?? '';

require_once 'controller/AccueilController.php';
require_once 'controller/AuthController.php';
$pdo= new PDO('mysql:host=localhost;dbname=todos','root','root');
$user = new User('','','','',$pdo);
$accueilView = new AccueilView();
$register = new RegisterView();
$login = new LoginView();
switch($uri){
    case 'register':
        (new AuthController($user,$register,$login))->register();
        break;
    case 'login':
        (new AuthController($user, $register,$login))->login();
        break;
    case 'logout':
        (new AuthController($user, $register, $login))->logout();
        break;
    case '':
    case 'accueil':
    default:
        (new AccueilController($user,$accueilView))->render();
}