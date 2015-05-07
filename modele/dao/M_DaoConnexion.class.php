<?php

/**
 * Description of Connexion
 *
 * @author btssio
 */
// Accès base de données
define('DSN', 'mysql:host=localhost;dbname=arichard_gestage');
define('USER', 'root');
define('MDP', 'joliverie');

class M_DaoConnexion {

    /**
     * Crée un objet de type PDO et ouvre la connexion 
     * @return un objet de type PDO pour accéder à la base de données
     */
    static function connecter() {
        /* Connexion à une base via PDO */
        try {
            $pdo = new PDO(DSN, USER, MDP);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->query("SET NAMES utf8");
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
        return $pdo;
    }

    static function deconnecter($pdo) {
        $pdo= null;
    }

}
