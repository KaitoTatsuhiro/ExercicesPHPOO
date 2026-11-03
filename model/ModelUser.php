<?php
    require_once './model/Model.php';
class ModelUser extends Model{
    //ATTRIBUT
    private string $prenom = ''; //Si les paramètre à envoyé son null par defaut, il vaut mieux les indiqué ici
    private string $nom = '';
    private string $email = '';
    private string $password = '';

    //CONSTRUCT
    public function __construct(PDO $newPdo){
        parent::__construct($newPdo);
    }
    // #region GETTER ET SETTER
    /**
     * Get the value of prenom
     *
     * @return string
     */
    public function getPrenom(): string {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param string $prenom
     *
     * @return self
     */
    public function setPrenom(string $prenom): self {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return string
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom(string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }
    // #endregion
    //METHOD
    public function addUser():string{
        try{
            $request = parent::getPdo()->prepare('INSERT INTO users (firstname, lastname, email, `password`) VALUES(?, ?, ?, ?)');

            //C. BindParam pour remplir les ? au sein de la requête
            $request->bindParam(1,$this->prenom,PDO::PARAM_STR);
            $request->bindParam(2,$this->nom,PDO::PARAM_STR);
            $request->bindParam(3,$this->email,PDO::PARAM_STR);
            $request->bindParam(4,$this->password,PDO::PARAM_STR);

            //D. Envoyer la requête à la BDD, pour exécution
            $request->execute();

            //E. Message de confirmation
            return "L'utilisateur a été enregistré :  ".htmlspecialchars($this->prenom)."".htmlspecialchars($this->nom)." - ".htmlspecialchars($this->email);
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
    public function checkEmail():array | string{
        try{
            $request = parent::getPdo()->prepare('SELECT u.firstname, u.lastname, u.email FROM users u WHERE u.email = ?');

            //BindParam() pour injecter l'email dans la requête
            $request->bindParam(1,$this->email,PDO::PARAM_STR);

            //Exécuter la requête
            $request->execute();
            return $request->fetch(PDO::FETCH_ASSOC);

        }catch(Exception $error){
            return $error->getMessage();
        }
    }
    public function loginUser():array | string{
        try{
            $request = parent::getPdo()->prepare('SELECT u.id_user, u.firstname, u.lastname, u.email, u.`password`, u.created_at, r.`role` FROM users u INNER JOIN roles r ON u.id_role = r.id_role WHERE u.email = ?');

            //C. BindParam
            $request->bindParam(1,$this->email,PDO::PARAM_STR);

            //D. Exécution de la requête
            $request->execute();

            //E. Récupération des données dans un tableau associatif
            return $request->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
    public function getDetail():array | string{
        try{
            $request = parent::getPdo()->prepare('SELECT u.id_user, u.firstname, u.lastname, u.email, u.created_at, r.`role` FROM users u INNER JOIN roles r ON u.id_role = r.id_role WHERE u.id_user = ?');

            //C. BindParam
            $request->bindParam(1,$_SESSION['id'],PDO::PARAM_INT);

            //D. Exécution de la requête
            $request->execute();

            //E. Récupération des données dans un tableau associatif
            return $request->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
    public function getAll():array | string{
        try{
            $request = parent::getPdo()->prepare('SELECT u.firstname, u.lastname, u.email FROM users u');

            //C. Exécuter la requête
            $request->execute();

            //D. Récupérer le tableau de données renvoyé par la BDD
            return $request->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $error){
            return $error->getMessage();
        }
    }
    public function modifyUser(array $fields):string{
        try{
            $sets = [];
            $values = [];
            foreach ($fields as $column => $value) {
            $sets[] = "$column = ?";
            $values[] = $value;
        }
            $values[] = $_SESSION['id'];
            $sql = "UPDATE users SET " . implode(', ', $sets) . " WHERE id_user = ?";
        
            $request = parent::getPdo()->prepare($sql);
            
            //D. Envoyer la requête à la BDD, pour exécution
            $request->execute($values);

            //E. Message de confirmation
            return "Votre compte à bien été modifié";
        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function deleteUser():string{
        try{
            $request = parent::getPdo()->prepare('DELETE FROM users WHERE id_user = ?');

            //C. BindParam pour remplir les ? au sein de la requête
            $request->bindParam(1,$_SESSION['id'],PDO::PARAM_INT);

            //D. Envoyer la requête à la BDD, pour exécution
            $request->execute();
            $_SESSION = [];
            session_destroy();
            header('Location: index.php?message=deleted');
            //E. Message de confirmation
            exit;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
}
