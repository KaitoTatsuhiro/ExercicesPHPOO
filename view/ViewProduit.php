<?php
//Class ViewProduit

class ViewProduit {
    //ATTRIBUT
    private array $data;

    //CONSTRUCTEUR

    //GETTER ET SETTER
    public function getData():array{
        return $this->data;
    }
    public function setData(array $newData):self{
        $this->data = $newData;
        return $this;
    }

    //METHODS
    public function display(){
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <header>
                <nav>
                    <a href=<?php echo($_ENV['produit']) ?>>Produit</a>
                    <a href=<?php echo($_ENV['vendeur']) ?>>Vendeur</a>
                </nav>
            </header>
            <main>
                <h1>Liste de Produits</h1>
                <ul>
                    <?php 
                        //Affichage des produits : 1er Méthode
                        foreach($this->getData() as $produit){
                            echo("<li>{$produit["nom_produit"]} : {$produit["nom_categorie"]}</li>");
                        }
                    ?>
                </ul>
            </main>
        </body>
        </html>
<?php
    }
}