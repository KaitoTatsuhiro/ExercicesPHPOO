<?php
require_once 'View.php';
require_once 'HeaderView.php';
require_once 'FooterView.php';
class DeleteView extends View{
    //ATTRIBUT

    //CONSTRUCT

    //GETTER ET SETTER

    //METHOD
    public function display():void{
        if(!isset($_SESSION['id'])){
            header('Location: index.php');
            }
        (new HeaderView('Supprimer le compte'))->display();
        ?>
            <main>
                <section>
                    <h2>Supprimer son compte</h2>
                    <form action="" method="post">
                        <p>Voulez vous vraiment supprimer votre compte définitivement?</p>
                        <input type="submit" name="delete" value="Oui, supprimer">
                    </form>
                    <p>
                        <?php echo($this->getMessageError()); ?>
                    </p>
                </section>
            </main>
        <?php
    }
}