<?php
include 'BilletPleinTarif.php';
class BilletReduit extends BilletPleinTarif{
    private string $justificatif;

    public function __construct(int $newNumero, float $newPrix, string $newJustificatif){
        parent::__construct($newNumero, $newPrix);
        $this->justificatif = $newJustificatif;
    }

    public function getJustificatif() :string {
        return $this->justificatif;        
    }
    public function setJustificatif(string $newJustificatif): void{
        $this->justificatif = $newJustificatif;
    }

    public function calculerPrix():float{
        $result = parent::getPrix();
        return ($result*(30/100));
    }
}