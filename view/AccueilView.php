<?php
require_once './view/View.php';
require_once './view/HeaderView.php';
require_once './view/FooterView.php';
class AccueilView extends View{
    //ATTRIBUT
    
    //CONSTRUCT
    
    //GETTER ET SETTER

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