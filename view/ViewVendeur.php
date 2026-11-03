<?php
class ViewVendeur{
    //ATTRIBUT
    private array $data;
    //CONSTRUCT

    //GETTER ET SETTER
     /**
     * Get the value of data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param array $data
     *
     * @return self
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }
    //METHOD
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
            <h2>Liste Vendeur.</h2>
            <ul>
            <?php foreach($this->data as $list){
                    echo "<li>{$list['prenom_vendeur']} {$list['nom_vendeur']}</li>";
            } ?>
            </ul>
        </body>
        </html>
    <?php
    }
}