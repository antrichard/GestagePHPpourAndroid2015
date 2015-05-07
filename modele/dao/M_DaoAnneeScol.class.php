<?php

class M_DaoAnneeScol extends M_DaoGenerique {

    function __construct() {
        $this->nomTable = "ANNEESCOL";
        $this->nomClefPrimaire = "ANNEESCOL";
    }

    /**
     * Redéfinition de la méthode abstraite de M_DaoGenerique
     * Permet d'instancier un objet d'après les valeurs d'un enregistrement lu dans la base de données
     * @param tableau-associatif $unEnreg liste des valeurs des champs d'un enregistrement
     * @return objet :  instance de la classe métier, initialisée d'après les valeurs de l'enregistrement 
     */
    public function enregistrementVersObjet($enreg) {
        // on construit l'objet AnneeScolaire 
        $retour = new M_AnneeScol($enreg['ANNEESCOL']);
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
            ':anneeScol' => $objetMetier->getAnneeScol()
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
     * Retourne toutes les données en rapport avec l'année scolaire en paramètre
     * @param type $anneeScol
     * @return array $retour
     */
    public function selectOne($pdo, $anneeScol) {
        $retour = null;
        try {
            //requete
            $sql = "SELECT * FROM ANNEESCOL WHERE anneeScol= :annee";
            //préparer la requête PDO
            $queryPrepare = $pdo->prepare($sql);
            //execution de la  requete
            if ($queryPrepare->execute(array(':annee' => $anneeScol))) {
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
        $sql = "SELECT * FROM ANNEESCOL";
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
