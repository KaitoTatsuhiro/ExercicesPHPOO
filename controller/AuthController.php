<?php
require_once './model/User.php';
require_once './view/RegisterView.php';
require_once './view/LoginView.php';
require_once './view/AccountView.php';
class AuthController{
    //ATTRIBUT
    private User $user;
    private RegisterView $registerView;
    private LoginView $loginView;
    private AccountView $accountView;
    //CONSTRUCT
    public function __construct(User $newUser)
    {
        $this->user = $newUser;
    }
    // #region GETTER ET SETTER
    /**
     * Get the value of user
     *
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user): self {
        $this->user = $user;
        return $this;
    }

    /**
     * Get the value of registerController
     *
     * @return RegisterView
     */
    public function getRegisterView(): RegisterView {
        return $this->registerView;
    }

    /**
     * Set the value of registerView
     *
     * @param RegisterView $registerView
     *
     * @return self
     */
    public function setRegisterView(RegisterView $registerView): self {
        $this->registerView = $registerView;
        return $this;
    }
        /**
     * Get the value of loginView
     *
     * @return LoginView
     */
    public function getLoginView(): LoginView {
        return $this->loginView;
    }

    /**
     * Set the value of loginView
     *
     * @param LoginView $loginView
     *
     * @return self
     */
    public function setLoginView(LoginView $loginView): self {
        $this->loginView = $loginView;
        return $this;
    }
        /**
     * Get the value of accountView
     *
     * @return AccountView
     */
    public function getAccountView(): AccountView
    {
        return $this->accountView;
    }

    /**
     * Set the value of accountView
     *
     * @param AccountView $accountView
     *
     * @return self
     */
    public function setAccountView(AccountView $accountView): self
    {
        $this->accountView = $accountView;
        return $this;
    }
    // #endregion
    //METHOD

    //Fonction pour s'inscrire
    public function register(): void {
        $this->registerView = new RegisterView();
        if(isset($_POST['submit'])){
            $prenom = trim($_POST['prenom'] ?? '');
            $nom    = trim($_POST['nom'] ?? '');
            $email  = trim($_POST['email'] ?? '');
            $mdp    = $_POST['password'] ?? '';

            if ($prenom === '' || $nom === '' || $email === '' || $mdp === '') {
                $this->registerView->setMessageError("Veuillez remplir tous les champs du formulaire.");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->registerView->setMessageError("Votre email n'est pas au bon format.");
            } elseif (mb_strlen($mdp, 'UTF-8') < 12) {
                $this->registerView->setMessageError("Votre mot de passe doit faire au moins 12 caractères.");
            } else {
                $this->user->setEmail($email);
                if (!empty($this->user->checkEmail())) {
                    $this->registerView->setMessageError("Un compte existe déjà avec cet email.");
                } else {
                    $this->user->setPrenom($prenom)
                            ->setNom($nom)
                            ->setPassword(password_hash($mdp, PASSWORD_DEFAULT));
                    $this->registerView->setMessageError($this->user->addUser());
                }
            }
        }
        $this->registerView->display();
    }



    //Fonction pour se connecter
    public function login():void{
        $this->loginView = new LoginView();
        if(isset($_POST['submitCo'])){
            $email = trim($_POST['emailCo'] ?? '');
            $mdp   = $_POST['passwordCo'] ?? '';
            //2) Vérifier que les champs sont remplis
            if($email === '' || $mdp === ''){
                $this->loginView->setMessageError('Veuillez remplir tous les champs');
            }
                //3) Vérifier le format des données
            elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    //4) Nettoyer les données : trim()
                    
                $this->loginView->setMessageError('Vous devez entrer un email valide');
            }else{
                //Vérifier qu'un compte existe
                $this->user->setEmail($email);
                $data = $this->user->loginUser();
                //F. Vérifier si les données sont vide ou non
                if(is_array($data) && !empty($data) && password_verify($mdp, $data['password'])){
                    //H. Connecter l'utilisateur
                    $_SESSION['role'] = $data['role'];
                    $_SESSION['id'] = $data['id_user'];
                    $_SESSION['nom'] = $data['lastname'];
                    $_SESSION['prenom'] = $data['firstname'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['createdAt'] = $data['created_at'];
                    header('Location: index.php');
                    exit;
                    

                    }
                    $this->loginView->setMessageError("Email et/ou Mot de Passe incorrect.");
                }

            }
            $this->loginView->display();
    }

    //Fonction déconnection
    public function logout(): void {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
    exit;
    }

    //Fonction afficher info du compte connecté
    public function account(): void{
        $this->accountView = new AccountView();
        $data = $this->user->getDetail();
        $userList = "";
        switch(gettype($data)){
            case "string":
                $this->accountView->setMessageError($data)->display();
                break;
            case "array":
                    $userList .= "<ul>";
                    $userList .= "test";
                    $userList .= "<li>{$data["firstname"]} {$data["lastname"]}</li>";
                    $userList .= "<li>{$data["role"]}</li>";
                    $userList .= "<li>{$data["email"]}</li>";
                    $userList .= "<li>{$data["created_at"]}</li>";
                    $userList .= "</ul>";
                $this->accountView->setMessageError($userList)->display();
                break;
            default:
                $this->accountView->setMessageError(gettype($data))->display();
        }
    }
}