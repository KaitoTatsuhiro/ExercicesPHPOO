<?php
class BilletEnfant extends BilletPleinTarif{
    private int $age;

    public function __construct(int $newNumero, float $newPrix, Seance $newSeance, int $newAge){
        parent::__construct($newNumero, $newPrix, $newSeance);
        $this->age = $newAge;
    }

    public function getAge():int{
        return $this->age;
    }
    public function setAge(int $newAge): self{
        $this->age = $newAge;
        return $this;
    }

    public function calculerPrix():float{
        echo "<p>{$this->age} ans</p>";
        return parent::calculerPrix();
    }
}