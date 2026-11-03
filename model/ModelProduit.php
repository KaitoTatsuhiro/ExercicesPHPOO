<?php
//MODEL : class ModelProduit
class ModelProduit{
    //ATTRIBUT
    private int $idProduit;
    private string $nomProduit;
    private float $prixProduit;
    private string $categorie;
    private int $stockProduit;
    private PDO $pdo;

    //CONSTRCUTEUR
    public function __construct(PDO $newPDO){
        $this->pdo = $newPDO;
    }

    //GETTER ET SETTER
    /**
     * Get the value of idProduit
     *
     * @return int
     */
    public function getIdProduit(): int {
        return $this->idProduit;
    }

    /**
     * Set the value of idProduit
     *
     * @param int $idProduit
     *
     * @return self
     */
    public function setIdProduit(int $idProduit): self {
        $this->idProduit = $idProduit;
        return $this;
    }

    /**
     * Get the value of nomProduit
     *
     * @return string
     */
    public function getNomProduit(): string {
        return $this->nomProduit;
    }

    /**
     * Set the value of nomProduit
     *
     * @param string $nomProduit
     *
     * @return self
     */
    public function setNomProduit(string $nomProduit): self {
        $this->nomProduit = $nomProduit;
        return $this;
    }

    /**
     * Get the value of prixProduit
     *
     * @return float
     */
    public function getPrixProduit(): float {
        return $this->prixProduit;
    }

    /**
     * Set the value of prixProduit
     *
     * @param float $prixProduit
     *
     * @return self
     */
    public function setPrixProduit(float $prixProduit): self {
        $this->prixProduit = $prixProduit;
        return $this;
    }

    /**
     * Get the value of categorie
     *
     * @return string
     */
    public function getCategorie(): string {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @param string $categorie
     *
     * @return self
     */
    public function setCategorie(string $categorie): self {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * Get the value of stockProduit
     *
     * @return int
     */
    public function getStockProduit(): int {
        return $this->stockProduit;
    }

    /**
     * Set the value of stockProduit
     *
     * @param int $stockProduit
     *
     * @return self
     */
    public function setStockProduit(int $stockProduit): self {
        $this->stockProduit = $stockProduit;
        return $this;
    }

    /**
     * Get the value of pdo
     *
     * @return PDO
     */
    public function getPdo(): PDO {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     * @param PDO $pdo
     *
     * @return self
     */
    public function setPdo(PDO $pdo): self {
        $this->pdo = $pdo;
        return $this;
    }

    //METHODS 
    public function findAll():array{
        try{
            //1) Préparer la requête SELECT pour récupérer le nom des produits et leur catégorie
            $request = $this->getPdo()->prepare('SELECT p.id_produit, p.nom_produit, p.prix_produit, p.stock_produit, c.nom_categorie FROM produit p INNER JOIN categorie c ON p.id_categorie = c.id_categorie;');

            //3) Envoyer la requête à la BDD
            $request->execute();

            //4) Récupérer la réponse de la BDD
            // PDO::FETCH_ASSOC : permet de récupérer la réponse uniquement sous forme de tableaux associatifs
            return $request->fetchAll(PDO::FETCH_ASSOC);

        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }   
}



