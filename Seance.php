<?php
class Seance{
    private string $date;
    private string $heure;
    private string $film;

    public function __construct(string $newDate, string $newHeure, string $newFilm){
        $this->date = $newDate;
        $this->heure = $newHeure;
        $this->film = $newFilm;
    }

    public function getDate():string{
        return $this->date;
    }
    public function setDate(string $newDate):self{
        $this->date = $newDate;
        return $this;
    }
    
    public function getHeure():string{
        return $this->heure;
    }
    public function setHeure(string $newHeure):self{
        $this->heure = $newHeure;
        return $this;
    }
    public function getFilm(): string{
        return $this->film;
    }
    public function setFilm(string $newFilm): self{
        $this->film = $newFilm;
        return $this;
    }
}