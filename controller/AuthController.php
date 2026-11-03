<?php
require_once './controller/Controller.php';
class AuthController extends Controller{
    //ATTRIBUT
    
    //CONSTRUCT
    public function __construct(ModelUser $newModelUser, AccountView $newAccountView, ModifyView $newModifyView, DeleteView $newDeleteView)
    {
        $this->addModel('modelUser', $newModelUser);
        $this->addView('accountView', $newAccountView);
        $this->addView('modifyView', $newModifyView);
        $this->addView('deleteView', $newDeleteView);
    }
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
        $data = $this->getModels()['modelUser']->getDetail();
        $userList = "";
        switch(gettype($data)){
            case "string":
                $this->getViews()['accountView']->setMessageError($data)->display();
                break;
            case "array":
                    $userList .= "<ul>";
                    $userList .= "<li>".htmlspecialchars($data["firstname"])." ".htmlspecialchars($data["lastname"])."</li>";
                    $userList .= "<li>".htmlspecialchars($data["role"])."</li>";
                    $userList .= "<li>".htmlspecialchars($data["email"])."</li>";
                    $userList .= "<li>".htmlspecialchars($data["created_at"])."</li>";
                    $userList .= "</ul>";
                $this->getViews()['accountView']->setMessageError($userList)->display();
                break;
            default:
                $this->getViews()['accountView']->setMessageError(gettype($data))->display();
        }
    }

    //Fonction modifier les info du compte
    public function modify(): void{
        if(isset($_POST['submit'])){
            $prenom = trim($_POST['prenom'] ?? '');
            $nom    = trim($_POST['nom'] ?? '');
            $email  = trim($_POST['email'] ?? '');
            $amdp    = $_POST['aPassword'] ?? '';
            $mdp    = $_POST['password'] ?? '';
            $mdp2    = $_POST['password2'] ?? '';

            //tableau pour les update
            $update=[];

            $this->getModels()['modelUser']->setEmail($_SESSION['email']);
            $data = $this->getModels()['modelUser']->loginUser();
            if ($prenom !== '') {
                $update['firstname'] = $prenom;
            }
            if ($nom !== '') {
                $update['lastname'] = $nom;
            }
            if ($email !== '') {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->getViews()['modifyView']->setMessageError("Votre email n'est pas au bon format.");
                    $this->getViews()['modifyView']->display();
                    return;
                }
                $update['email'] = $email;
            }

            if ($mdp !== '' || $mdp2 !== '') {
                if ($mdp !== $mdp2) {
                    $this->getViews()['modifyView']->setMessageError("Les deux mots de passe ne concordent pas.");
                    $this->getViews()['modifyView']->display();
                    return;
                }
                if (mb_strlen($mdp, 'UTF-8') < 12) {
                    $this->getViews()['modifyView']->setMessageError("Votre mot de passe doit faire au moins 12 caractères.");
                    $this->getViews()['modifyView']->display();
                    return;
                }
                if (!password_verify($amdp, $data['password'])) {
                    $this->getViews()['modifyView']->setMessageError("Ancien mot de passe incorrect.");
                    $this->getViews()['modifyView']->display();
                    return;
                }
                $update['password'] = password_hash($mdp, PASSWORD_DEFAULT);
            }

            // Rien à modifier
            if (empty($update)) {
                $this->getViews()['modifyView']->setMessageError("Veuillez remplir au moins un champ du formulaire.");
                $this->getViews()['modifyView']->display();
                return;
            }
            $result = $this->getModels()['modelUser']->modifyUser($update);
            $this->getViews()['modifyView']->setMessageError($result);
        }
            $this->getViews()['modifyView']->display();
    }

    public function delete(): void{
        if(isset($_POST['delete'])){
            $this->getModels()['modelUser']->deleteUser();
        }
        $this->getViews()['deleteView']->display();
    }
}


