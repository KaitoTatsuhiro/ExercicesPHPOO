<?php
session_start();

$uri = $_GET['page'] ?? '';

require_once 'controller/AccueilController.php';
require_once 'controller/AuthController.php';
require_once 'model/ModelUser.php';
$pdo= new PDO('mysql:host=localhost;dbname=todos','root','root');
$user = new ModelUser($pdo);

$accountView = new AccountView();
$modifyView = new ModifyView();
$deleteView = new DeleteView();

$accueilView = new AccueilView();
$registerView = new RegisterView();
$loginView = new LoginView();

$auth = new AuthController($user, $accountView, $modifyView, $deleteView);
$accueil = new AccueilController($user, $accueilView, $registerView, $loginView);
switch($uri){
    case 'logout':
        $auth->logout();
        break;
    case 'compte':
        $auth->account();
        break;
    case 'modify':
        $auth->modify();
        break;
        case 'delete':
        $auth->delete();
        break;
    case '':
    case 'accueil':
    default:
        $accueil->render();
}