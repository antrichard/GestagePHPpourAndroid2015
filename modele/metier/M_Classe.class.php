<?php

class M_Classe {

    private $numClasse;
	private $idSpecialite;
	private $numFiliere;
	private $nomClasse;
    
        function __construct($numClasse, $idSpecialite, $numFiliere, $nomClasse) {
            $this->numClasse = $numClasse;
            $this->idSpecialite = $idSpecialite;
            $this->numFiliere = $numFiliere;
            $this->nomClasse = $nomClasse;
        }
        public function getNumClasse() {
            return $this->numClasse;
        }

        public function getIdSpecialite() {
            return $this->idSpecialite;
        }

        public function getNumFiliere() {
            return $this->numFiliere;
        }

        public function getNomClasse() {
            return $this->nomClasse;
        }

        public function setNumClasse($numClasse) {
            $this->numClasse = $numClasse;
        }

        public function setIdSpecialite($idSpecialite) {
            $this->idSpecialite = $idSpecialite;
        }

        public function setNumFiliere($numFiliere) {
            $this->numFiliere = $numFiliere;
        }

        public function setNomClasse($nomClasse) {
            $this->nomClasse = $nomClasse;
        }


    

}
