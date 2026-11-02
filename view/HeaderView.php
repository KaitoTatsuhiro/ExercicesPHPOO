<?php
class HeaderView extends View{
    //ATTRIBUT
    private string $title;
    //CONSTRUCT
    public function __construct(string $newTitle)
    {
        $this->title = $newTitle;
    }
    // #region GETTER ET SETTER
    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    // #endregion

    //METHOD
    public function display():void{
        ?>
        <?php
        $nav = "";

        //Vérifier si quelqu'un est connecté
        if(isset($_SESSION['id'])){
            //Mise à jour du menu de navigation : ajout du bouton de déconnexion
            $nav = "<a href='index.php'>Accueil</a> <a href='index.php?page=compte'>Compte</a> <a href='index.php?page=logout'>Se Déconnecter</a>";
        }else{
            $nav .= "<a href='index.php'>Accueil</a>";
        }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $this->title; ?></title>
        </head>
        <body>
            <header>
                <nav>
                    <?php echo($nav); ?>
                </nav>
            </header>
            <?php
    }

    
}