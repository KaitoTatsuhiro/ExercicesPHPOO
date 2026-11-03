<?php
include_once '../controller/ControllerProduit.php';
include_once '../controller/ControllerVendeur.php';
include_once '../.env.php';

$url = $_SERVER['REQUEST_URI'];
$path = parse_url($url)['path'];
$pdo = new PDO('mysql:host=localhost;dbname=ticket','root','root');
$modelProduit = new ModelProduit($pdo);
$modelVendeur = new ModelVendeur($pdo);
$viewProduit = new ViewProduit();
$viewVendeur = new ViewVendeur();

switch($path){
    case $_ENV['produit'] :
        $controller = new ControllerProduit($modelProduit,$viewProduit);
        $controller->render();
        break;
    case $_ENV['vendeur'] :
        $controller = new ControllerVendeur($modelVendeur, $viewVendeur);
        $controller->render();
        break;
    default :
        http_response_code(404);
        echo ("<h1>Error 404 Not Found !</h1>");
}