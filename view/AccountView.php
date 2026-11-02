<?php
require_once 'View.php';
require_once 'HeaderView.php';
require_once 'FooterView.php';
class AccountView extends View{
    //ATTRIBUT

    //CONSTRUCT

    //GETTER ET SETTER

    //METHOD
    public function display():void{
        ?>
        <main>
            <h2>Compte</h2>
            <section>
                <p>
                    <?php echo ($this->getMessageError()); ?>
                </p>
            </section>
            <section>
                <form action="" method="get">
                    <a href='index.php?page=modify'>Modifier</a>
                    <p>Attention, action irréversible.</p>
                    <a href='index.php?page=delete'>Supprimer le compte</a>
                </form>
            </section>
        </main>
        <?php
    }
}