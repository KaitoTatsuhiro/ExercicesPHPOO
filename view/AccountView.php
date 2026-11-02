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
        (new HeaderView())->display();
        ?>
    <section>
        <h2>Compte</h2>
        <p>
            <?php echo ($this->getMessageError()); ?>
        </p>
    </section>
    <?php
        (new FooterView())->display();
    }
}