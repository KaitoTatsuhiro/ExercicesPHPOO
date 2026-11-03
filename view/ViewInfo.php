<?php
class ViewInfo{
    //ATTRIBUT
    private array $data;
    //CONSTRUCT

    //GETTER ET SETTER
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
    //METHOD
    public function display():void{
        ?>
        <main>
            <h1>Information du compte</h1>
            <ul>
            <?php foreach($this->data as $list){
                echo "<li>{$list['firstname']} {$list['lastname']} {$list['email']}</li>";
            } ?>
            </ul>
        </main>
        <?php
    }
}