<?php
class Commande {
    public $nom, $prenom, $adresse, $prix, $statut;

    public function __construct($nom, $prenom, $adresse) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->prix = rand(10, 500); 
        $this->statut = "Commande prise en compte";
    }
}
?> 