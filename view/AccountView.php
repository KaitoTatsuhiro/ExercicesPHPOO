<?php
require_once 'View.php';
require_once 'HeaderView.php';
require_once 'FooterView.php';
class AccountView extends View{
    //ATTRIBUT
    private string $messageError;
    //CONSTRUCT

    // #region GETTER ET SETTER

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
    // #endregion
    //METHOD
    public function display():void{
        if(!isset($_SESSION['id'])){
            header('Location: index.php');
            }
        (new HeaderView('Compte'))->display();
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