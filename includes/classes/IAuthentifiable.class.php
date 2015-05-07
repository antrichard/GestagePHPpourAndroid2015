<?php

interface IAuthentifiable {

    // mettre fin à la session authentifiée
    static function finAuthentification() ;

    /** ouvrir une nouvelle session authentifiée :
     *   - générer un nouvel identifiant de session
     *   - enregistrer la ou les donnée(s) de session fournies en paramètre
     * @param array() $lesDonneesSession : tableau associatif contenant les données à inscrire en session
     */    
    static function authentifier($lesDonneesSession);
    
    /**
     * Vérifie qu'une session est en cours
     * @param array() $lesDonneesSession : tableau contenant la liste des noms de données à vérifier
     * @return boolean =true si la session est bien en cours ; =false sinon
     */
    static function estAuthentifie($lesDonneesSession);
    
    /**
     * lit une donnée d'authentification sur la session
     * @param string $nomDonnee
     * @return string valeur de la donnée si elle existe, NULL sinon
     */
    static function getAuth($nomDonnee);
    
    /**
     * enregistre une donnée d'authentification sur la session
     * @param string $nomDonnee
     * @param string $valeur
     */
    static function setAuth($nomDonnee, $valeur) ;

}

?>
