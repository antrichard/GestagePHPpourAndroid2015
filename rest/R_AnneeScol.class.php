<?php

class R_AnneeScol {

    // requête GET sans paramètre supplémentaire (autre que ressource et action)
    function getAll() {
        $pdo = M_DaoConnexion::connecter();
        $listeAnneeScol = M_DaoAnneeScol::getAll($pdo);
        $xml = new SimpleXMLElement('<lesannneesscol/>');
        for ($i = 0; $i < count($listeAnneeScol); $i++) {
            $annneescol = $listeAnneeScol[$i];
            $elem = $xml->addChild("annneescol");
            $elem->addChild("annneescol", $annneescol->getAnneeScol());
        }
        $retour = $xml->asXML();
        return $retour;
    }

    // requête GET avec paramètre id
    function getOneById() {
        $pdo = M_DaoConnexion::connecter();
        $id = M_DaoProduit::getOneById($pdo, $_GET['id']);
        $xml = new SimpleXMLElement('<lesproduits/>');
        $elem = $xml->addChild("produit");
        $elem->addChild("reference", $id->getRef());
        $elem->addChild("designation", $id->getDesignation());
        $elem->addChild("prix", $id->getPrix());
        $categ = $id->getCategorie();
        $elem->addChild("codecategorie", $categ->getCode());

        $retour = $xml->asXML();
        return $retour;
    }

}
