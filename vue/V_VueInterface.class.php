<?php

/**
 * Description of V_VueInterface
 * Description des services à remplir pour une classe vue
 * La vue doit pouvoir se garnir (ajouter/lire) et s'afficher (afficher)
 * @author btssio
 * 
 */
interface V_VueInterface {
    
    /**
     *  Afficher la vue signifie l'inclure au flux de sortie
     */
    function afficher() ;

    /**
     * ajouter une information à transmettre à la vue : un couple (nom, valeur)
     * @param string $nomDonnee : nom de l'information
     * @param string $valeurDonnee : valeur de l'information
     */
    function ajouter($nomDonnee, $valeurDonnee);

    /**
     * retourne valeur d'une information liée à la vue
     * @param string $nomDonnee : nom de l'information recherchée
     * @return string : valeur de l'information recherchée ; null sinon
     */
    function lire($nomDonnee) ;
    
}
