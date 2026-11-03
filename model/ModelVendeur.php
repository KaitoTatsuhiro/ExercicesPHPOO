<?php
class ModelVendeur{
    //ATTRIBUT
    private PDO $pdo;
    //CONSTRUCT
    public function __construct(PDO $newPDO){
        $this->pdo = $newPDO;
    }
    //GETTER ET SETTER
    
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
    public function getVendeur():array{
        try{
            $request = $this->getPdo()->prepare('SELECT v.prenom_vendeur, v.nom_vendeur FROM vendeur v');
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}