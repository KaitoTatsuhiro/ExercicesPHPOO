<?php
session_start();

$uri = $_GET['page'] ?? '';

require_once 'controller/AccueilController.php';
require_once 'controller/AuthController.php';
require_once 'model/ModelUser.php';
$pdo= new PDO('mysql:host=localhost;dbname=todos','root','root');
$user = new ModelUser($pdo);
switch($uri){
    case 'logout':
        (new AuthController($user))->logout();
        break;
    case 'compte':
        (new AuthController($user))->account();
        break;
    case 'modify':
        (new AuthController($user))->modify();
        break;
        case 'delete':
        (new AuthController($user))->delete();
        break;
    case '':
    case 'accueil':
    default:
        (new AccueilController($user))->render();
}