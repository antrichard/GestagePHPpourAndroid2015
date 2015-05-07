<?php
/**
 * Implémentation d'une classe vue pour ce projet
 */
class V_Vue implements V_VueInterface {

    private $fichier;   // chemin d'accès vers le gabarit de cette vue (template)
    private $donnees;   // tableau associatif des valeurs permettant de garnir le gabarit

    function __construct($chemin) {
        $this->fichier = $chemin;
        $this->donnees = array();
//        // composants par défaut de la vue
//        $this->ajouter('entete',"../vues/templates/entete.inc.php");
//        $this->ajouter('gauche',"../vues/templates/gauche.inc.php");
//        $this->ajouter('pied',"../vues/templates/pied.inc.php");
    }

    /**
     *  Afficher la vue signifie l'inclure au flux de sortie
     */
     function afficher() {
        include($this->fichier);
    }

    /**
     * ajouter une information à transmettre à la vue : un couple (nom, valeur)
     * @param string $nomDonnee : nom de l'information
     * @param string $valeurDonnee : valeur de l'information
     */
    function ajouter($nomDonnee, $valeurDonnee) {
        $this->donnees[$nomDonnee] = $valeurDonnee;
    }

    /**
     * retourne valeur d'une information liée à la vue
     * @param string $nomDonnee : nom de l'information recherchée
     * @return string : valeur de l'information recherchée ; null sinon
     */
    function lire($nomDonnee) {
        $retour = null;
        if (isset($this->donnees[$nomDonnee])) {
            $retour = $this->donnees[$nomDonnee];
        }
        return $retour;
    }

}
