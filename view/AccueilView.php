<?php
require_once 'View.php';
require_once 'HeaderView.php';
require_once 'FooterView.php';
class AccueilView extends View{
    //ATTRIBUT
    
    //CONSTRUCT
    
    //GETTER ET SETTER

    //METHOD
    public function display(): void
    {
        (new HeaderView())->display();
        ?>
        <h1>Page d'Accueil</h1>
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