<?php
require_once 'View.php';
require_once 'HeaderView.php';
require_once 'FooterView.php';
class LoginView extends View{
    //ATTRIBUT

    //CONSTRUCT

    //GETTER ET SETTER

    //METHOD
    public function display():void{
        (new HeaderView())->display();
        ?>
    <section>
        <h2>Connexion</h2>
        <form action="" method="post">
            <label for="emailCo">Email <input type="email" name="emailCo" id="emailCo"></label>
            <label for="passwordCo">Mot de Passe <input type="password" name="passwordCo" id="passwordCo"></label>
            <input type="submit" name="submitCo">
        </form>
        <p>
            <?php echo($this->getMessageError()); ?>
        </p>
    </section>
    <?php
        (new FooterView())->display();
    }
}