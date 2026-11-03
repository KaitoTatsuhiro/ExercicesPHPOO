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
                    $userList .= "<li>".htmlspecialchars($data["firstname"])." ".htmlspecialchars($data["lastname"])."</li>";
                    $userList .= "<li>".htmlspecialchars($data["role"])."</li>";
                    $userList .= "<li>".htmlspecialchars($data["email"])."</li>";
                    $userList .= "<li>".htmlspecialchars($data["created_at"])."</li>";
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
            $amdp    = $_POST['aPassword'] ?? '';
            $mdp    = $_POST['password'] ?? '';
            $mdp2    = $_POST['password2'] ?? '';

            //tableau pour les update
            $update=[];

            parent::getModelUser()->setEmail($_SESSION['email']);
            $data = parent::getModelUser()->loginUser();
            if ($prenom !== '') {
                $update['firstname'] = $prenom;
            }
            if ($nom !== '') {
                $update['lastname'] = $nom;
            }
            if ($email !== '') {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    parent::getModifyView()->setMessageError("Votre email n'est pas au bon format.");
                    parent::getModifyView()->display();
                    return;
                }
                $update['email'] = $email;
            }

            if ($mdp !== '' || $mdp2 !== '') {
                if ($mdp !== $mdp2) {
                    parent::getModifyView()->setMessageError("Les deux mots de passe ne concordent pas.");
                    parent::getModifyView()->display();
                    return;
                }
                if (mb_strlen($mdp, 'UTF-8') < 12) {
                    parent::getModifyView()->setMessageError("Votre mot de passe doit faire au moins 12 caractères.");
                    parent::getModifyView()->display();
                    return;
                }
                if (!password_verify($amdp, $data['password'])) {
                    parent::getModifyView()->setMessageError("Ancien mot de passe incorrect.");
                    parent::getModifyView()->display();
                    return;
                }
                $update['password'] = password_hash($mdp, PASSWORD_DEFAULT);
            }

            // Rien à modifier
            if (empty($update)) {
                parent::getModifyView()->setMessageError("Veuillez remplir au moins un champ du formulaire.");
                parent::getModifyView()->display();
                return;
            }
            $result = parent::getModelUser()->modifyUser($update);
            parent::getModifyView()->setMessageError($result);
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


