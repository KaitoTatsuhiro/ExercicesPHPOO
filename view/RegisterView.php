<?php
require_once 'View.php';
require_once 'HeaderView.php';
require_once 'FooterView.php';
class RegisterView extends View{
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
            <main>
        <h1>Page d'Accueil</h1>
                <section>
                    <h2>Inscription</h2>
                    <form action="" method="post">
                        <label for="prenom">Prenom <input type="text" name="prenom" id="prenom"></label>
                        <label for="nom">Nom <input type="text" name="nom" id="nom"></label>
                        <label for="email">Email <input type="email" name="email" id="email"></label>
                        <label for="password">Mot de Passe <input type="password" name="password" id="password"></label>
                        <label for="password2">Confirmation du mot de Passe <input type="password" name="password2" id="password2"></label>
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