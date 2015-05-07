<?php

class R_Personne {

    // requête GET sans paramètre supplémentaire (autre que ressource et action)
    function getAllEtudiantsByClasseAndAnneeScol() {
        if (isset($_GET['classe'])) {
            $idclasse = $_GET['classe'];
        } else {
            $idclasse = '2SISR';
        }
        if (isset($_GET['anneeScol'])) {
            $anneescol = $_GET['anneeScol'];
        } else {
            $anneescol = '2014-2015';
        }
        $pdo = M_DaoConnexion::connecter();
        $listePersonnes = M_DaoPersonne::getAllEtudiantsByClasseAndAnneeScol($pdo, $idclasse, $anneescol);
        $xml = new SimpleXMLElement('<lespersonnes/>');
        for ($i = 0; $i < count($listePersonnes); $i++) {
            $personne = $listePersonnes[$i];
            $elem = $xml->addChild("personne");
            $elem->addChild("idPersonne", $personne->getId());
            $elem->addChild("idRole", $personne->getRole()->getId());
            $elem->addChild("nomPersonne", $personne->getNom());
            $elem->addChild("prenomPersonne", $personne->getPrenom());
            $elem->addChild("loginUtilisateur", $personne->getLogin());
            $elem->addChild("mdpUtilisateur", $personne->getMdp());
        }
        $retour = $xml->asXML();
        return $retour;
    }

    // requête GET avec paramètre GET id
    function getOneById() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = '2';
        }
        $pdo = M_DaoConnexion::connecter();
        $personne = M_DaoPersonne::getOneById($pdo, $id);
        $xml = new SimpleXMLElement('<lapersonne/>');
        $elem = $xml->addChild("personne");
        $elem->addChild("idPersonne", $personne->getId());
        $elem->addChild("idRole", $personne->getRole()->getId());
        $elem->addChild("nomPersonne", $personne->getNom());
        $elem->addChild("prenomPersonne", $personne->getPrenom());
        $elem->addChild("loginUtilisateur", $personne->getLogin());
        $elem->addChild("mdpUtilisateur", $personne->getMdp());
        $retour = $xml->asXML();
        return $retour;
    }

    // requête GET avec paramètre GET id
    function getOneByLogin() {
        if (isset($_GET['valeurLogin'])) {
            $valeurLogin = $_GET['valeurLogin'];
        } else {
            $valeurLogin = 'stage';
        }
        $pdo = M_DaoConnexion::connecter();
        $personne = M_DaoPersonne::getOneByLogin($pdo, $valeurLogin);
        $xml = new SimpleXMLElement('<lapersonne/>');
        $elem = $xml->addChild("personne");
        $elem->addChild("idPersonne", $personne->getId());
        $elem->addChild("idRole", $personne->getRole()->getId());
        $elem->addChild("nomPersonne", $personne->getNom());
        $elem->addChild("prenomPersonne", $personne->getPrenom());
        $elem->addChild("loginUtilisateur", $personne->getLogin());
        $elem->addChild("mdpUtilisateur", $personne->getMdp());
        $retour = $xml->asXML();
        return $retour;
    }

    /**
     * requête POST avec paramètres POST code et libelle
     * @return type "<resultats><nbenr>1</nbenr></resultats>" si l'insertion a eu lieu ; "<resultats><nbenr>0</nbenr></resultats>" sinon
     */
    public static function insert() {
        $nb = 0;
        $xml = new SimpleXMLElement('<resultats/>');
        // Récupérer les données POST
        if (isset($_POST['code']) && isset($_POST['libelle'])) {
            $code = addslashes($_POST['code']);
            $libelle = addslashes($_POST['libelle']);
            $categ = new M_Categorie($code, $libelle);
            $pdo = M_DaoConnexion::connecter();
            $nb = M_DaoCategorie::insert($pdo, $categ);
        }
        $xml->addChild("nbenr", $nb);
        return $xml->asXML();
    }

    /**
     * requête GET avec paramètre GET id
     * @return type "<resultats><nbenr>1</nbenr></resultats>" si la suppression a eu lieu ; "<resultats><nbenr>0</nbenr></resultats>" sinon
     */
    public static function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 'xxx';
        }
        $nb = 0;
        $xml = new SimpleXMLElement('<resultats/>');
        // Récupérer les données GET
        if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
            $pdo = M_DaoConnexion::connecter();
            $nb = M_DaoCategorie::delete($pdo, $id);
        }
        $xml->addChild("nbenr", $nb);
        return $xml->asXML();
    }

}