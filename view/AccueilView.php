<?php
require_once './view/View.php';
require_once './view/HeaderView.php';
require_once './view/FooterView.php';
class AccueilView extends View{
    //ATTRIBUT
    private array $data;
    //CONSTRUCT
    
    // #region GETTER ET SETTER
    
    /**
     * Get the value of data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param array $data
     *
     * @return self
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }
    // #endregion
    //METHOD
    public function display(): void
    {
        ?>
        <section>
            <h2>Listes des utilisateurs</h2>
            <ul>
                <?php
                $userList = '';
                foreach($this->getData() as $user){
                    $userList .= "<li>" . htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname'])
           . ' - ' . htmlspecialchars($user['email']) . "</li>";
                }
                echo($userList);
                ?>
            </ul>
        </section>
        <?php
        (new FooterView())->display();
    }

}