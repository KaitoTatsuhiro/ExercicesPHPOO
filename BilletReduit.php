<?php
class BilletReduit extends BilletPleinTarif{
    private string $justificatif;

    public function __construct(int $newNumero, float $newPrix, Seance $newSeance, string $newJustificatif){
        parent::__construct($newNumero, $newPrix, $newSeance);
        $this->justificatif = $newJustificatif;
    }

    public function getJustificatif() :string {
        return $this->justificatif;        
    }
    public function setJustificatif(string $newJustificatif): self{
        $this->justificatif = $newJustificatif;
        return $this;
    }

    public function calculerPrix():float{
        echo "<p>{$this->justificatif}</p>";
        return parent::getPrix() *  0.30;
    }
}