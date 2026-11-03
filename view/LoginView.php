<?php
require_once 'View.php';
require_once 'HeaderView.php';
require_once 'FooterView.php';
class LoginView extends View{
    //ATTRIBUT
    
    private string $messageError;
    //CONSTRUCT

    //GETTER ET SETTER
    
    /**
     * Get the value of messageError
     *
     * @return string
     */
    public function getMessageError(): string
    {
        return $this->messageError;
    }

    /**
     * Set the value of messageError
     *
     * @param string $messageError
     *
     * @return self
     */
    public function setMessageError(string $messageError): self
    {
        $this->messageError = $messageError;
        return $this;
    }
    //METHOD
    public function display():void{
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
    }
}