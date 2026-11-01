<?php
session_start();

$uri = $_GET['page'] ?? '';

require_once 'controller/AccueilController.php';
require_once 'controller/AuthController.php';
$pdo= new PDO('mysql:host=localhost;dbname=todos','root','root');
$user = new User($pdo);
switch($uri){
    case 'register':
        (new AuthController($user))->register();
        break;
    case 'login':
        (new AuthController($user))->login();
        break;
    case 'logout':
        (new AuthController($user))->logout();
        break;
    case '':
    case 'accueil':
    default:
        (new AccueilController($user))->render();
}