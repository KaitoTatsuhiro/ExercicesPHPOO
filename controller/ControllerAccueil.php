<?php
class ControllerAccueil{
    //ATTRIBUT
    private string $product;
    private ModelAccueil $modelAccueil;
    private ViewAccueil $viewAccueil;

    //CONSTRUCT
    public function __construct(ModelAccueil $newModelAccueil, ViewAccueil $newViewAccueil)
    {
        //ATTRIBUT
        $this->modelAccueil = $newModelAccueil;
        $this->viewAccueil = $newViewAccueil;
    }
    //SETTER ET GETTER
    /**
     * Get the value of modelAccueil
     *
     * @return ModelAccueil
     */
    public function getModelAccueil(): ModelAccueil
    {
        return $this->modelAccueil;
    }

    /**
     * Set the value of modelAccueil
     *
     * @param ModelAccueil $modelAccueil
     *
     * @return self
     */
    public function setModelAccueil(ModelAccueil $modelAccueil): self
    {
        $this->modelAccueil = $modelAccueil;
        return $this;
    }

    /**
     * Get the value of viewAccueil
     *
     * @return ViewAccueil
     */
    public function getViewAccueil(): ViewAccueil
    {
        return $this->viewAccueil;
    }

    /**
     * Set the value of viewAccueil
     *
     * @param ViewAccueil $viewAccueil
     *
     * @return self
     */
    public function setViewAccueil(ViewAccueil $viewAccueil): self
    {
        $this->viewAccueil = $viewAccueil;
        return $this;
    }
    /**
     * Get the value of product
     *
     * @return string
     */
    public function getProduct(): string
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @param string $product
     *
     * @return self
     */
    public function setProduct(string $product): self
    {
        $this->product = $product;
        return $this;
    }

    //MODELS

    public function rendu(){
        $data = $this->modelAccueil->produitCategorie();

        switch(gettype($data)){
            case "string":
                $this->viewAccueil->setMessageError($data)->display();
            case "array":
                $this->viewAccueil->setData($data)->display();
                
        }
    }

    
}
