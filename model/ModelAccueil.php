<?php
class ModelAccueil{
    //ATTRIBUT
    private string $nom_produit;
    private string $nom_categorie;
    private PDO $pdo;
    //CONSTRUCT
    public function __construct(PDO $newPdo)
    {
        $this->pdo = $newPdo;
    }
    //SETTER ET GETTER
    /**
     * Get the value of nom_produit
     *
     * @return string
     */
    public function getNomProduit(): string
    {
        return $this->nom_produit;
    }

    /**
     * Set the value of nom_produit
     *
     * @param string $nom_produit
     *
     * @return self
     */
    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;
        return $this;
    }

    /**
     * Get the value of nom_categorie
     *
     * @return string
     */
    public function getNomCategorie(): string
    {
        return $this->nom_categorie;
    }

    /**
     * Set the value of nom_categorie
     *
     * @param string $nom_categorie
     *
     * @return self
     */
    public function setNomCategorie(string $nom_categorie): self
    {
        $this->nom_categorie = $nom_categorie;
        return $this;
    }

    /**
     * Get the value of pdo
     *
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     * @param PDO $pdo
     *
     * @return self
     */
    public function setPdo(PDO $pdo): self
    {
        $this->pdo = $pdo;
        return $this;
    }

    //METHOD
    public function produitCategorie(){
        try{
            $request = $this->pdo->prepare('SELECT p.nom_produit, c.nom_categorie FROM produit p INNER JOIN categorie c ON p.id_categorie = c.id_categorie;');
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    
}