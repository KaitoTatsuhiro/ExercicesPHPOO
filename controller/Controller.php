<?php
require_once './model/ModelUser.php';
require_once './view/AccueilView.php';
require_once './view/RegisterView.php';
require_once './view/LoginView.php';
require_once './view/AccountView.php';
require_once './view/ModifyView.php';
class Controller{
    //ATTRIBUT
    private ModelUser $modelUser;
    private AccueilView $accueilView;
    private RegisterView $registerView;
    private LoginView $loginView;
    private AccountView $accountView;
    private ModifyView $modifyView;
    // #region GETTER ET SETTER
    

    /**
     * Get the value of modelUser
     *
     * @return ModelUser
     */
    public function getModelUser(): ModelUser
    {
        return $this->modelUser;
    }

    /**
     * Set the value of modelUser
     *
     * @param ModelUser $modelUser
     *
     * @return self
     */
    public function setModelUser(ModelUser $modelUser): self
    {
        $this->modelUser = $modelUser;
        return $this;
    }
    /**
     * Get the value of accueilView
     *
     * @return AccueilView
     */
    public function getAccueilView(): AccueilView
    {
        return $this->accueilView;
    }

    /**
     * Set the value of accueilView
     *
     * @param AccueilView $accueilView
     *
     * @return self
     */
    public function setAccueilView(AccueilView $accueilView): self
    {
        $this->accueilView = $accueilView;
        return $this;
    }

    /**
     * Get the value of registerView
     *
     * @return RegisterView
     */
    public function getRegisterView(): RegisterView
    {
        return $this->registerView;
    }

    /**
     * Set the value of registerView
     *
     * @param RegisterView $registerView
     *
     * @return self
     */
    public function setRegisterView(RegisterView $registerView): self
    {
        $this->registerView = $registerView;
        return $this;
    }

    /**
     * Get the value of loginView
     *
     * @return LoginView
     */
    public function getLoginView(): LoginView
    {
        return $this->loginView;
    }

    /**
     * Set the value of loginView
     *
     * @param LoginView $loginView
     *
     * @return self
     */
    public function setLoginView(LoginView $loginView): self
    {
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

    /**
     * Get the value of modifyView
     *
     * @return ModifyView
     */
    public function getModifyView(): ModifyView
    {
        return $this->modifyView;
    }

    /**
     * Set the value of modifyView
     *
     * @param ModifyView $modifyView
     *
     * @return self
     */
    public function setModifyView(ModifyView $modifyView): self
    {
        $this->modifyView = $modifyView;
        return $this;
    }
    // #endregion
    //CONSTRUCT
    public function __construct(ModelUser $newModelUser)
    {
        $this->modelUser = $newModelUser;//On crée sa propre vue pour alléger le code
        $this->accueilView = new AccueilView();
        $this->registerView = new RegisterView();
        $this->loginView = new LoginView();
        $this->accountView = new AccountView();
        $this->modifyView = new ModifyView();
    }
    //METHODS
    public function render():void{

    }

}