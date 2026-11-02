<?php
require_once './controller/Controller.php';
class AuthController extends Controller{
    //ATTRIBUT
    
    //CONSTRUCT

    // #region GETTER ET SETTER
    
    // #endregion
    //METHOD
    //Fonction déconnection
    public function logout(): void {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
    exit;
    }

    //Fonction afficher info du compte connecté
    public function account(): void{
        $data = parent::getModelUser()->getDetail();
        $userList = "";
        switch(gettype($data)){
            case "string":
                parent::getAccountView()->setMessageError($data)->display();
                break;
            case "array":
                    $userList .= "<ul>";
                    $userList .= "<li>{$data["firstname"]} {$data["lastname"]}</li>";
                    $userList .= "<li>{$data["role"]}</li>";
                    $userList .= "<li>{$data["email"]}</li>";
                    $userList .= "<li>{$data["created_at"]}</li>";
                    $userList .= "</ul>";
                parent::getAccountView()->setMessageError($userList)->display();
                break;
            default:
                parent::getAccountView()->setMessageError(gettype($data))->display();
        }
    }

    //Fonction modifier les info du compte
    public function modify(): void{
        if(isset($_POST['submit'])){
            $prenom = trim($_POST['prenom'] ?? '');
            $nom    = trim($_POST['nom'] ?? '');
            $email  = trim($_POST['email'] ?? '');
            $mdp    = $_POST['password'] ?? '';

            if ($prenom === '' || $nom === '' || $email === '' || $mdp === '') {
                parent::getModifyView()->setMessageError("Veuillez remplir tous les champs du formulaire.");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                parent::getModifyView()->setMessageError("Votre email n'est pas au bon format.");
            } elseif (mb_strlen($mdp, 'UTF-8') < 12) {
                parent::getModifyView()->setMessageError("Votre mot de passe doit faire au moins 12 caractères.");
            } else {
                    parent::getModelUser()->setPrenom($prenom)
                            ->setNom($nom)
                            ->setEmail($email)
                            ->setPassword(password_hash($mdp, PASSWORD_DEFAULT));
                    parent::getModifyView()->setMessageError(parent::getModelUser()->ModifyUser());
            }
        }
        parent::getModifyView()->display();
    }

    public function delete(): void{
        if(isset($_POST['delete'])){
            parent::getModelUser()->deleteUser();
        }
        parent::getDeleteView()->display();
    }
}


