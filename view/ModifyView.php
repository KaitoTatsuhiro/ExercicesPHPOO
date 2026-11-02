<?php
require_once 'View.php';
require_once 'HeaderView.php';
require_once 'FooterView.php';
class ModifyView extends View{
    //ATTRIBUT

    //CONSTRUCT

    //GETTER ET SETTER

    //METHOD
    public function display():void{
        if(!isset($_SESSION['id'])){
            header('Location: index.php');
            }
        (new HeaderView('Modifier compte'))->display();
        ?>
            <main>
                <section>
                    <h2>Modifier son compte</h2>
                    <form action="" method="post">
                        <label for="prenom">Prenom <input type="text" name="prenom" id="prenom"></label>
                        <label for="nom">Nom <input type="text" name="nom" id="nom"></label>
                        <label for="email">Email <input type="email" name="email" id="email"></label>
                        <label for="password">Mot de Passe <input type="password" name="password" id="password"></label>
                        <input type="submit" name="submit">
                    </form>
                    <p>
                        <?php echo($this->getMessageError()); ?>
                    </p>
                </section>
            </main>
        <?php
    }
}