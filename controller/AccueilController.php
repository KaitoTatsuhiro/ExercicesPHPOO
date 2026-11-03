<?php
require_once './controller/Controller.php';
class AccueilController extends Controller{
    //ATTRIBUT

    //CONSTRUCT
    
    // #region GETTER ET SETTER

    // #endregion
    //METHOD

    public function render():  void{
        (new HeaderView('Accueil'))->display();
        $message = $_GET['message'] ?? '';
        if ($message == 'deleted'){
            echo "Compte supprimé avec succès.";
        }
        if(!isset($_SESSION['id'])){
        $this->registerUser();
        $this->connectUser();
        }
        $this->displayUser();
        (new FooterView())->display();
    }

    //S'inscrire
    public function registerUser(): void {
        
        if(isset($_POST['submit'])){
            $prenom = trim($_POST['prenom'] ?? '');
            $nom    = trim($_POST['nom'] ?? '');
            $email  = trim($_POST['email'] ?? '');
            $mdp    = $_POST['password'] ?? '';
            $mdp2    = $_POST['password2'] ?? '';

            if ($prenom === '' || $nom === '' || $email === '' || $mdp === '' || $mdp2 === '') {
                parent::getRegisterView()->setMessageError("Veuillez remplir tous les champs du formulaire.");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                parent::getRegisterView()->setMessageError("Votre email n'est pas au bon format.");
            } elseif (mb_strlen($mdp, 'UTF-8') < 12 && mb_strlen($mdp2, 'UTF-8') < 12) {
                parent::getRegisterView()->setMessageError("Votre mot de passe doit faire au moins 12 caractères.");
            }elseif ($mdp != $mdp2){
                parent::getRegisterView()->setMessageError("Les deux mot de passe ne concordent pas.");
            } else {
                parent::getModelUser()->setEmail($email);
                if (!empty(parent::getModelUser()->checkEmail())) {
                    parent::getRegisterView()->setMessageError("Un compte existe déjà avec cet email.");
                } else {
                    parent::getModelUser()->setPrenom($prenom)
                            ->setNom($nom)
                            ->setPassword(password_hash($mdp, PASSWORD_DEFAULT));
                    parent::getRegisterView()->setMessageError(parent::getModelUser()->addUser());
                }
            }
        }
        parent::getRegisterView()->display();
    }



    //Fonction pour se connecter
    public function connectUser():void{
        
        if(isset($_POST['submitCo'])){
            $email = trim($_POST['emailCo'] ?? '');
            $mdp   = $_POST['passwordCo'] ?? '';
            //2) Vérifier que les champs sont remplis
            if($email === '' || $mdp === ''){
                parent::getLoginView()->setMessageError('Veuillez remplir tous les champs');
            }
                //3) Vérifier le format des données
            elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    //4) Nettoyer les données : trim()
                    
                parent::getLoginView()->setMessageError('Vous devez entrer un email valide');
            }else{
                //Vérifier qu'un compte existe
                parent::getModelUser()->setEmail($email);
                $data = parent::getModelUser()->loginUser();
                //F. Vérifier si les données sont vide ou non
                if(is_array($data) && !empty($data) && password_verify($mdp, $data['password'])){
                    //H. Connecter l'utilisateur
                    $_SESSION['role'] = htmlspecialchars($data['role']);
                    $_SESSION['id'] = htmlspecialchars($data['id_user']);
                    $_SESSION['nom'] = htmlspecialchars($data['lastname']);
                    $_SESSION['prenom'] = htmlspecialchars($data['firstname']);
                    $_SESSION['email'] = htmlspecialchars($data['email']);
                    $_SESSION['createdAt'] = htmlspecialchars($data['created_at']);
                    header('Location: index.php');
                    exit;
                    

                    }
                    parent::getLoginView()->setMessageError("Email et/ou Mot de Passe incorrect.");
                }

            }
            parent::getLoginView()->display();
    }

    public function displayUser(){
    $data = parent::getModelUser()->getAll();

        switch(gettype($data)){
            case "string" :
                //Cas où on reçoit un message d'erreur
                parent::getAccueilView()->setMessageError($data)->display();
                break;
            case "array" :
                //Cas où on reçoit nos données
                parent::getAccueilView()->setData($data)->display();
                break;
        }
    }
}
