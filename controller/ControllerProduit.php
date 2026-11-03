<?php
//CONTROLLER : demander les données au model pour les fournir à la view

//Importer les ressources
include_once '../model/ModelProduit.php';
include_once '../view/ViewProduit.php';

//Class Controller
class ControllerProduit{
    //ATTRIBUT
    private ModelProduit $model;
    private ViewProduit $view;

    //CONSTRUCTEUR
    public function __construct(ModelProduit $newModel, ViewProduit $newView){
        $this->model = $newModel;
        $this->view = $newView;
    }

    //GETTER ET SETTER
    /**
     * Get the value of model
     *
     * @return ModelProduit
     */
    public function getModel(): ModelProduit {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param ModelProduit $model
     *
     * @return self
     */
    public function setModel(ModelProduit $model): self {
        $this->model = $model;
        return $this;
    }

    /**
     * Get the value of view
     *
     * @return ViewProduit
     */
    public function getView(): ViewProduit {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @param ViewProduit $view
     *
     * @return self
     */
    public function setView(ViewProduit $view): self {
        $this->view = $view;
        return $this;
    }

    //METHODS
    //Lancer le rendu de la page
    function render(){
        //1. Je demande au model de me fournir les données
        $data = $this->getModel()->findAll();

        //2. Je passe les données à afficher à la View, puis je demande de faire l'affichage
        $this->getView()->setData($data)->display();
    }
}
