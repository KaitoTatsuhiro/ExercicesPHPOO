<?php
require_once './controller/Controller.php';
class AccueilController extends Controller{
    //ATTRIBUT

    //CONSTRUCT
    public function __construct(ModelUser $newModelUser, AccueilView $newAccueilView, RegisterView $newRegisterView, LoginView $newLoginView)
    {
        $this->addModel('modelUser', $newModelUser);
        $this->addView('accueilView', $newAccueilView);
        $this->addView('registerView', $newRegisterView);
        $this->addView('loginView', $newLoginView);
    }
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
                $this->getViews()['registerView']->setMessageError("Veuillez remplir tous les champs du formulaire.");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->getViews()['registerView']->setMessageError("Votre email n'est pas au bon format.");
            } elseif (mb_strlen($mdp, 'UTF-8') < 12 && mb_strlen($mdp2, 'UTF-8') < 12) {
                $this->getViews()['registerView']->setMessageError("Votre mot de passe doit faire au moins 12 caractères.");
            }elseif ($mdp != $mdp2){
                $this->getViews()['registerView']->setMessageError("Les deux mot de passe ne concordent pas.");
            } else {
                $this->getModels()['modelUser']->setEmail($email);
                if (!empty($this->getModels()['modelUser']->checkEmail())) {
                    $this->getViews()['registerView']->setMessageError("Un compte existe déjà avec cet email.");
                } else {
                    $this->getModels()['modelUser']->setPrenom($prenom)
                            ->setNom($nom)
                            ->setPassword(password_hash($mdp, PASSWORD_DEFAULT));
                    $this->getViews()['registerView']->setMessageError($this->getModels()['modelUser']->addUser());
                }
            }
        }
        $this->getViews()['registerView']->display();
    }



    //Fonction pour se connecter
    public function connectUser():void{
        
        if(isset($_POST['submitCo'])){
            $email = trim($_POST['emailCo'] ?? '');
            $mdp   = $_POST['passwordCo'] ?? '';
            //2) Vérifier que les champs sont remplis
            if($email === '' || $mdp === ''){
                $this->getViews()['loginView']->setMessageError('Veuillez remplir tous les champs');
            }
                //3) Vérifier le format des données
            elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    //4) Nettoyer les données : trim()
                    
                $this->getViews()['loginView']->setMessageError('Vous devez entrer un email valide');
            }else{
                //Vérifier qu'un compte existe
                $this->getModels()['modelUser']->setEmail($email);
                $data = $this->getModels()['modelUser']->loginUser();
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
                    $this->getViews()['loginView']->setMessageError("Email et/ou Mot de Passe incorrect.");
                }

            }
            $this->getViews()['loginView']->display();
    }

    public function displayUser(){
    $data = $this->getModels()['modelUser']->getAll();

        switch(gettype($data)){
            case "string" :
                //Cas où on reçoit un message d'erreur
                $this->getViews()['accueilView']->setMessageError($data)->display();
                break;
            case "array" :
                //Cas où on reçoit nos données
                $this->getViews()['accueilView']->setData($data)->display();
                break;
        }
    }
}
