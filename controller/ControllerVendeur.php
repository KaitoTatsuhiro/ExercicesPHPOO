<?php
include_once '../model/ModelVendeur.php';
include_once '../view/ViewVendeur.php';
class ControllerVendeur{
    private ModelVendeur $modelVendeur;
    private ViewVendeur $viewVendeur;

    public function __construct(ModelVendeur $newModelVendeur, ViewVendeur $newViewVendeur)
    {
        $this->modelVendeur = $newModelVendeur;
        $this->viewVendeur = $newViewVendeur;
    }
    

    /**
     * Get the value of modelVendeur
     *
     * @return ModelVendeur
     */
    public function getModelVendeur(): ModelVendeur
    {
        return $this->modelVendeur;
    }

    /**
     * Set the value of modelVendeur
     *
     * @param ModelVendeur $modelVendeur
     *
     * @return self
     */
    public function setModelVendeur(ModelVendeur $modelVendeur): self
    {
        $this->modelVendeur = $modelVendeur;
        return $this;
    }

    /**
     * Get the value of viewVendeur
     *
     * @return ViewVendeur
     */
    public function getViewVendeur(): ViewVendeur
    {
        return $this->viewVendeur;
    }

    /**
     * Set the value of viewVendeur
     *
     * @param ViewVendeur $viewVendeur
     *
     * @return self
     */
    public function setViewVendeur(ViewVendeur $viewVendeur): self
    {
        $this->viewVendeur = $viewVendeur;
        return $this;
    }

    public function render(){
        $data = $this->getModelVendeur()->getVendeur();
        $this->getViewVendeur()->setData($data)->display();
    }
}