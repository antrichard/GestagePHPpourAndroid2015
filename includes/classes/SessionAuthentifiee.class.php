<?php


class SessionAuthentifiee implements IAuthentifiable {

    static function finAuthentification() {
        self::fermer();
    }

    static function authentifier($lesDonneesSession) {
        self::demarrer();
        session_regenerate_id();   // changer l'identification de session (sécurité)
        foreach ($lesDonneesSession as $nomDonnee => $valeurDonnee) {
            self::setAuth($nomDonnee, $valeurDonnee);
        }
    }

    static function estAuthentifie($lesDonneesSession) {
        self::demarrer();
        $ok = true;
        foreach ($lesDonneesSession as $nomDonnee) {
            $ok = $ok && isset($_SESSION["auth"]["$nomDonnee"]);
        }
        return $ok;
    }

    static function getAuth($nomDonnee) {
        self::demarrer();
        $retour = null;
        if (isset($_SESSION["auth"]["$nomDonnee"])) {
            $retour = $_SESSION["auth"]["$nomDonnee"];
        }
        return $retour;
    }
    static function setAuth($nomDonnee, $valeur) {
        self::demarrer();
        $_SESSION["auth"]["$nomDonnee"]= $valeur;
    }

    static function demarrer() {
        $sid= session_id();
        if (empty($sid)){
            session_start();
        }
    }

    static function fermer() {
        self::demarrer();
        unset($_SESSION);
        session_destroy();
    }

    static function get($nomDonnee) {
        self::demarrer();
        $retour = null;
        if (isset($_SESSION["$nomDonnee"])) {
            $retour = $_SESSION["$nomDonnee"];
        }
        return $retour;
    }
    static function set($nomDonnee, $valeur) {
        self::demarrer();
        $_SESSION["$nomDonnee"]= $valeur;
    }
    

}

?>
