<?php
include 'Seance.php';
include 'BilletPleinTarif.php';
include 'BilletReduit.php';
include 'BilletEnfant.php';

$seance = new Seance('16/12/2026','20h30','Dunesday');
$billetAdulte = new BilletPleinTarif(12,23.5,$seance);
$billetEnfant = new BilletEnfant(11, 5, $seance, 9);
$billetEtudiant = new BilletReduit(42, 23.5, $seance, "carte étudiante");

echo $billetAdulte->calculerPrix();
echo "<br>";
$billetAdulte->imprimerDetail();
echo "<br><br>";
echo $billetEnfant->calculerPrix();
echo "<br>";
$billetEnfant->imprimerDetail();
echo "<br><br>";
echo $billetEtudiant->calculerPrix();
echo "<br>";
$billetEtudiant->imprimerDetail();