<?php


class R_Classes {

    // requête GET sans paramètre supplémentaire (autre que ressource et action)
    function getAll() {
        $pdo = M_DaoConnexion::connecter();
        $listeClasses = M_DaoClasse::getAll($pdo);
        $xml = new SimpleXMLElement('<lesclasses/>');
        for ($i = 0; $i < count($listeClasses); $i++) {
            $classe = $listeClasses[$i];
            $elem = $xml->addChild("classe");
            $elem->addChild("numClasse", $classe->getNumClasse());
            $elem->addChild("nomClasse", $classe->getNomClasse());
        }
        $retour = $xml->asXML();
        return $retour;
    }

    // requête GET avec paramètre GET id
    function getOneById() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 'bul';
        }
        $pdo = M_DaoConnexion::connecter();
        $classe = M_DaoClasse::getOneById($pdo, $id);
        $xml = new SimpleXMLElement('<lesclasses/>');
        $elem = $xml->addChild("classe");
        $elem->addChild("numClasse", $classe->getNumClasse());
        $elem->addChild("nomClasse", $classe->getNomClasse());
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
        if (isset($_GET['id']) ) {
            $id = addslashes($_GET['id']);
            $pdo = M_DaoConnexion::connecter();
            $nb = M_DaoCategorie::delete($pdo, $id);
        }
        $xml->addChild("nbenr", $nb);
        return $xml->asXML();
    }
}
