<?php

class M_DaoStage extends M_DaoGenerique {

    function __construct() {
        $this->nomTable = "STAGE";
        $this->nomClefPrimaire = "NUM_STAGE";
    }

    /**
     * Redéfinition de la méthode abstraite de M_DaoGenerique
     * Permet d'instancier un objet d'après les valeurs d'un enregistrement lu dans la base de données
     * @param tableau-associatif $unEnregistrement liste des valeurs des champs d'un enregistrement
     * @return objet :  instance de la classe métier, initialisée d'après les valeurs de l'enregistrement 
     */
    public function enregistrementVersObjet($enreg) {
        // on instancie les objets AnneeScolaire et Organisation
        $lAnneeScol = null;
        if (isset($enreg['ANNEESCOL'])) {
            $daoAnneeScol = new M_DaoAnneeScol();
            $daoAnneeScol->setPdo($this->pdo);
            $lAnneeScol = $daoAnneeScol->getOneById($enreg['ANNEESCOL']);
        }
        $lOrganisation = null;
        if (isset($enreg['IDORGANISATION'])) {
            $daoOrganisation = new M_DaoOrganisation();
            $daoOrganisation->setPdo($this->pdo);
            $lOrganisation = $daoOrganisation->getOneById($enreg['IDORGANISATION']);
        }
        // on instancie les objets idEtudiant, idProf et idMaitreStage
        $idEtudiant = null;
        $idProf = null;
        $idMaitreStage = null;
        if (isset($enreg['IDETUDIANT']) && isset($enreg['IDPROFESSEUR']) && isset($enreg['IDMAITRESTAGE'])) {
            $daoPersonne = new M_DaoPersonne();
            $daoPersonne->setPdo($this->pdo);
            $idEtudiant = $daoPersonne->getOneById($this->pdo, $enreg['IDETUDIANT']);
            $idProf = $daoPersonne->getOneById($this->pdo, $enreg['IDPROFESSEUR']);
            $idMaitreStage = $daoPersonne->getOneById($this->pdo, $enreg['IDMAITRESTAGE']);
        }

        // on construit l'objet Stage 
        $retour = new M_Stage($enreg['NUM_STAGE'], $lAnneeScol, $idEtudiant, $idProf, $lOrganisation, $idMaitreStage, $enreg['DATEDEBUT'], $enreg['DATEFIN'], $enreg['DATEVISITESTAGE'], $enreg['VILLE'], $enreg['DIVERS'], $enreg['BILANTRAVAUX'], $enreg['RESSOURCESOUTILS'], $enreg['COMMENTAIRES'], $enreg['PARTICIPATIONCCF']);
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
        $anneeScol = $objetMetier->getAnneeScol();
        $idEtudiant = $objetMetier->getIdEtudiant();
        $idProfesseur = $objetMetier->getIdProfesseur();
        $idOrganisation = $objetMetier->getIdOrganisation();
        $idMaitreStage = $objetMetier->getIdMaitreStage();
        $retour = array(
            ':anneescol' => $anneeScol,
            ':idetudiant' => $idEtudiant,
            ':idprofesseur' => $idProfesseur,
            ':idorganisation' => $idOrganisation,
            ':idmaitrestage' => $idMaitreStage,
            ':datedebut' => $objetMetier->getDateDebut(),
            ':datefin' => $objetMetier->getDateFin(),
            ':datevisitestage' => $objetMetier->getDateVisiteStage(),
            ':ville' => $objetMetier->getVille(),
            ':divers' => $objetMetier->getDivers(),
            ':bilantravaux' => $objetMetier->getBilanTravaux(),
            ':ressourceoutils' => $objetMetier->getRessourcesOutils(),
            ':commentaires' => $objetMetier->getCommentaires(),
            ':participationccf' => $objetMetier->getParticipationCCF()
        );
        return $retour;
    }

    public function insert($objetMetier) {
        $retour = FALSE;
        try {
            // Requête textuelle paramétrée (paramètres nommés)
            $sql = "INSERT INTO $this->nomTable (ANNEESCOL,IDETUDIANT,IDPROFESSEUR,IDORGANISATION,";
            $sql .= "IDMAITRESTAGE,DATEDEBUT,DATEFIN,DATEVISITESTAGE,VILLE,DIVERS,BILANTRAVAUX,";
            $sql .= "RESSOURCESOUTILS, COMMENTAIRES,PARTICIPATIONCCF) ";
            $sql .= "VALUES (:anneescol, :idetudiant, :idprofesseur, :idorganisation,";
            $sql .= ":idmaitrestage, :datedebut, :datefin, :datevisitestage, :ville, :divers,";
            $sql .= ":bilantravaux, :ressourceoutils, :commentaires, :participationccf)";

            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // préparer la  liste des paramètres, avec l'identifiant en dernier
            $parametres = $this->objetVersEnregistrement($objetMetier);
            //var_dump($parametres);
            // exécuter la requête avec les valeurs des paramètres dans un tableau
            $retour = $queryPrepare->execute($parametres);
//            debug_query($sql, $parametres);
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    public function update($idMetier, $objetMetier) {
        return FALSE;
    }

    /**
     * Lire tous les enregistrements d'une table
     * @return tableau-associatif d'objets : un tableau d'instances de la classe métier
     */
    function getAll($pdo) {
        $this->pdo = $pdo;
        $retour = null;
        // Requête textuelle
        $sql = "SELECT * FROM STAGE S LEFT OUTER JOIN PERSONNE P ON P.IDPERSONNE = S.IDETUDIANT LEFT OUTER JOIN PERSONNE P2 ON P2.IDPERSONNE = S.IDPROFESSEUR LEFT OUTER JOIN PERSONNE P3 ON P3.IDPERSONNE = S.IDMAITRESTAGE LEFT OUTER JOIN ORGANISATION O ON O.IDORGANISATION = S.IDORGANISATION ";
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
    function getOneById($pdo, $id) {
        $this->pdo = $pdo;
        $retour = null;
        try {
            // Requête textuelle
            $sql = "SELECT * FROM STAGE S LEFT OUTER JOIN PERSONNE P ON P.IDPERSONNE = S.IDETUDIANT LEFT OUTER JOIN PERSONNE P2 ON P2.IDPERSONNE = S.IDPROFESSEUR LEFT OUTER JOIN PERSONNE P3 ON P3.IDPERSONNE = S.IDMAITRESTAGE LEFT OUTER JOIN ORGANISATION O ON O.IDORGANISATION = S.IDORGANISATION WHERE NUM_STAGE = :id";
            // préparer la requête PDO
            $queryPrepare = $pdo->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array(':id' => $id))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = self::enregistrementVersObjet($enregistrement);
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }
}
