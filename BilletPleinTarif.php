<?php
include 'Seance.php';
class BilletPleinTarif{
    private int $numero;
    private float $prix;
    private Seance $seance;

    public function __construct(int $newNumero, float $newPrix){
        $this->numero = $newNumero;
        $this->prix = $newPrix;
    }
    public function getNumero():int{
        return $this->numero;
    }
    public function setNumero(int $newNumero):void{
        $this->numero = $newNumero;
    }

    public function getPrix():float{
        return $this->prix;
    }
    public function setPrix(float $newPrix):void{
        $this->prix = $newPrix;
    }

    public function getSeance():Seance{
        return $this->seance;
    }
    public function setSeance(Seance $newSeance):void{
        $this->seance = $newSeance;
    }
    

    public function calculerPrix(): float{
        return $this->prix;
    }
    public function imprimerDetail(): void{
        echo "La séance de déroulera le {parent::getdate()} à {parent::getHeure()} et le film sera: {parent::getFilm()} votre numéro de billet est le: {$this->numero}";
    }
}