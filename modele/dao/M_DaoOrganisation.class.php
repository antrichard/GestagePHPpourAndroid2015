<?php

class M_DaoOrganisation extends M_DaoGenerique {

    function __construct() {
        $this->nomTable = "ORGANISATION";
        $this->nomClefPrimaire = "IDORGANISATION";
    }

    /**
     * Redéfinition de la méthode abstraite de M_DaoGenerique
     * Permet d'instancier un objet d'après les valeurs d'un enregistrement lu dans la base de données
     * @param tableau-associatif $unEnreg liste des valeurs des champs d'un enregistrement
     * @return objet :  instance de la classe métier, initialisée d'après les valeurs de l'enregistrement 
     */
    public function enregistrementVersObjet($enreg) {
        $retour = new M_Organisation($enreg['IDORGANISATION'], $enreg['NOM_ORGANISATION'], $enreg['VILLE_ORGANISATION'], $enreg['ADRESSE_ORGANISATION'], $enreg['CP_ORGANISATION'], $enreg['TEL_ORGANISATION'], $enreg['FAX_ORGANISATION'], $enreg['FORMEJURIDIQUE'], $enreg['ACTIVITE']);
        return $retour;
    }

    /**
     * Prépare une liste de paramètres pour une requête SQL UPDATE ou INSERT
     * @param Object $objetMetier
     * @return array : tableau ordonné de valeurs
     */
    public function objetVersEnregistrement($objetMetier) {
        // construire un tableau des paramètres d'insertion ou de modification
        // l'ordre des valeurs est important : il correspond à celui des paramètres de la requête SQL
        $retour = array(
            ':idOrganisation' => $objetMetier->getIdRole(),
            ':nomOrganisation' => $objetMetier->getNomOrganisation(),
            ':villeOrganisation' => $objetMetier->getVilleOrganisation(),
            ':adresseOrganisation' => $objetMetier->getAdresseOrganisation(),
            ':cpOrganisation' => $objetMetier->getCpOrganisation(),
            ':telOrganisation' => $objetMetier->getTelOrganisation(),
            ':faxOrganisation' => $objetMetier->getFaxOrganisation(),
            ':formeJuridique' => $objetMetier->getFormeJuridique(),
            ':activite' => $objetMetier->getActivite()
        );
        return $retour;
    }

    public function insert($objetMetier) {
        return FALSE;
    }

    public function update($idMetier, $objetMetier) {
        return FALSE;
    }

    /**
     * Retourne toutes les données en rapport avec l'ID de l'organisation en paramètre
     * @param type $idOrganisation
     * @return array $retour
     */
    public function selectOne($pdo, $idOrganisation) {
        $retour = null;
        try {
            //requete
            $sql = "SELECT * FROM ORGANISATION WHERE IDORGANISATION = :id";
            //préparer la requête PDO
            $queryPrepare = $pdo->prepare($sql);
            //execution de la  requete
            if ($queryPrepare->execute(array(':id' => $idOrganisation))) {
                // si la requete marche
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                $retour = self::enregistrementVersObjet($enregistrement);
            }
        } catch (Exception $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    /**
     * Lire tous les enregistrements d'une table
     * @return tableau-associatif d'objets : un tableau d'instances de la classe métier
     */
    function getAll($pdo) {
        $retour = null;
// Requête textuelle
        $sql = "SELECT * FROM ORGANISATION ";
        try {
// préparer la requête PDO
            $queryPrepare = $pdo->prepare($sql);
// exécuter la requête PDO
            if ($queryPrepare->execute()) {
// si la requête réussit :
// initialiser le tableau d'objets à retourner
                $retour = array();
// pour chaque enregistrement retourné par la requête
                while ($enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC)) {
// construir un objet métier correspondant
                    $unObjetMetier = self::enregistrementVersObjet($enregistrement);
// ajouter l'objet au tableau
                    $retour[] = $unObjetMetier;
                }
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

}
