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
    public function setAge(int $newAge): void{
        $this->age = $newAge;
    }

    public function calculerPrix():float{
        $this->age;
        return parent::getPrix();
    }
}