<?php
class BilletPleinTarif{
    private int $numero;
    private float $prix;
    private Seance $seance;

    public function __construct(int $newNumero, float $newPrix, Seance $newSeance){
        $this->numero = $newNumero;
        $this->prix = $newPrix;
        $this->seance = $newSeance;
    }
    public function getNumero():int{
        return $this->numero;
    }
    public function setNumero(int $newNumero):self{
        $this->numero = $newNumero;
        return $this;
    }

    public function getPrix():float{
        return $this->prix;
    }
    public function setPrix(float $newPrix):self{
        $this->prix = $newPrix;
        return $this;
    }

    public function getSeance():Seance{
        return $this->seance;
    }
    public function setSeance(Seance $newSeance):self{
        $this->seance = $newSeance;
        return $this;
    }
    

    public function calculerPrix(): float{
        return $this->prix;
    }
    public function imprimerDetail(): self{
        echo "La séance de dérouleras le {$this->seance->getDate()} à {$this->seance->getHeure()} et le film sera: {$this->seance->getFilm()} votre numéro de billet est le: {$this->numero}";
        return $this;
    }
}