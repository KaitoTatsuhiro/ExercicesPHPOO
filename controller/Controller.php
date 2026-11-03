<?php
require_once './model/ModelUser.php';
require_once './view/AccueilView.php';
require_once './view/RegisterView.php';
require_once './view/LoginView.php';
require_once './view/AccountView.php';
require_once './view/ModifyView.php';
require_once './view/DeleteView.php';
class Controller{
    //ATTRIBUT
    private array $models = [];
    private array $views = [];
    // #region GETTER ET SETTER
    /**
     * Get the value of models
     *
     * @return array
     */
    public function getModels(): array
    {
        return $this->models;
    }

    /**
     * Set the value of models
     *
     * @param array $models
     *
     * @return self
     */
    public function setModels(array $models): self
    {
        $this->models = $models;
        return $this;
    }

    /**
     * Get the value of views
     *
     * @return array
     */
    public function getViews(): array
    {
        return $this->views;
    }

    /**
     * Set the value of views
     *
     * @param array $views
     *
     * @return self
     */
    public function setViews(array $views): self
    {
        $this->views = $views;
        return $this;
    }
    // #endregion
    //CONSTRUCT
    
    //METHODS
    public function addModel(string $key, Model $newModel):self{
        $this->models[$key] = $newModel;
        return $this;
    }
    public function addView(string $key, View $newView):self{
        $this->views[$key] = $newView;
        return $this;
    }
    public function removeModel(string $key) : self {
        unset($this->model[$key]);
        return $this;
    }
    public function removeView(string $key) : self {
        unset($this->view[$key]);
        return $this;
    }
    public function render():void{
        if(array_key_exists('hearder',$this->getViews())){
            $this->getViews()['hearder']->display();
        }
        if(array_key_exists('main',$this->getViews())){
            $this->getViews()['main']->display();
        }
        if(array_key_exists('footer',$this->getViews())){
            $this->getViews()['footer']->display();
        }
    }
}