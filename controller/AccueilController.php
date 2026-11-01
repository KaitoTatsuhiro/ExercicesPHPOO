<?php
require_once './model/User.php';
require_once './view/AccueilView.php';
class AccueilController{
    //ATTRIBUT
    private User $user;
    private AccueilView $accueilView;
    //CONSTRUCT
    public function __construct(User $newUser)
    {
        $this->user = $newUser;
        $this->accueilView = new AccueilView();//On crée sa propre vue pour alléger le code
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
     * Get the value of accueilController
     *
     * @return AccueilView
     */
    public function getAccueilView(): AccueilView {
        return $this->accueilView;
    }

    /**
     * Set the value of accueilView
     *
     * @param AccueilView $accueilView
     *
     * @return self
     */
    public function setAccueilView(AccueilView $accueilView): self {
        $this->accueilView = $accueilView;
        return $this;
    }
    // #endregion
    //METHOD
    public function render(){
        $data = $this->user->getAll();

        switch(gettype($data)){
            case "string" :
                //Cas où on reçoit un message d'erreur
                $this->accueilView->setMessageError($data)->display();
                break;
            case "array" :
                //Cas où on reçoit nos données
                $this->accueilView->setData($data)->display();
                break;
        }
    }
}
