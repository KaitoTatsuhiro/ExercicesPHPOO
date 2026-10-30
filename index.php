<?php
require_once 'model/ModelAccueil.php';
require_once 'view/ViewAccueil.php';
require_once 'controller/ControllerAccueil.php';

$model = new ModelAccueil(new PDO("mysql:host=localhost;dbname=ticket","root","root"));
$view = new ViewAccueil();
$controllerAccueil = new ControllerAccueil($model,$view);
$controllerAccueil->rendu();