<?php
class HeaderView extends View{
    //ATTRIBUT

    //CONSTRUCT

    //GETTER ET SETTER

    //METHOD
    public function display():void{
        ?>
        <?php
        $nav = "";

        //Vérifier si quelqu'un est connecté
        if(isset($_SESSION['id'])){
            //Mise à jour du menu de navigation : ajout du bouton de déconnexion
            $nav = "<a href='index.php?page=logout'>Se Déconnecter</a>";
        }else{
            $nav .= "<a href='index.php?page=register'>S'inscrire</a> <a href='index.php?page=login'>Se connecter</a>";
        }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
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