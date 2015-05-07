<?php

/**
 * Description of M_Role
 *
 * @author btssio
 */
class M_Stage {

    private $num; // type : int
    private $anneeScol; // objet : anneeScol
    private $idEtudiant; // type : int
    private $idProfesseur; // type : int
    private $idOrganisation; // type : int
    private $idMaitreStage; // type : int
    private $dateDebut; // type : date
    private $dateFin; // type : date
    private $dateVisiteStage; // type : date
    private $ville; // type : String
    private $divers; // type : String
    private $bilanTravaux; // type : String
    private $ressourcesOutils; // type : String
    private $commentaires; // type : String
    private $participationCCF; // type : booléen

    function __construct($num, $anneeScol, $idEtudiant, $idProfesseur, $idOrganisation, $idMaitreStage, $dateDebut, $dateFin, $dateVisiteStage, $ville, $divers, $bilanTravaux, $ressourcesOutils, $commentaires, $participationCCF) {
        $this->num = $num;
        $this->anneeScol = $anneeScol;
        $this->idEtudiant = $idEtudiant;
        $this->idProfesseur = $idProfesseur;
        $this->idOrganisation = $idOrganisation;
        $this->idMaitreStage = $idMaitreStage;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->dateVisiteStage = $dateVisiteStage;
        $this->ville = $ville;
        $this->divers = $divers;
        $this->bilanTravaux = $bilanTravaux;
        $this->ressourcesOutils = $ressourcesOutils;
        $this->commentaires = $commentaires;
        $this->participationCCF = $participationCCF;
    }

    public function getNum() {
        return $this->num;
    }

    public function getAnneeScol() {
        return $this->anneeScol;
    }

    public function getIdEtudiant() {
        return $this->idEtudiant;
    }

    public function getIdProfesseur() {
        return $this->idProfesseur;
    }

    public function getIdOrganisation() {
        return $this->idOrganisation;
    }

    public function getIdMaitreStage() {
        return $this->idMaitreStage;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function getDateVisiteStage() {
        return $this->dateVisiteStage;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getDivers() {
        return $this->divers;
    }

    public function getBilanTravaux() {
        return $this->bilanTravaux;
    }

    public function getRessourcesOutils() {
        return $this->ressourcesOutils;
    }

    public function getCommentaires() {
        return $this->commentaires;
    }

    public function getParticipationCCF() {
        return $this->participationCCF;
    }

    public function setNum($num) {
        $this->num = $num;
    }

    public function setAnneeScol($anneeScol) {
        $this->anneeScol = $anneeScol;
    }

    public function setIdEtudiant($idEtudiant) {
        $this->idEtudiant = $idEtudiant;
    }

    public function setIdProfesseur($idProfesseur) {
        $this->idProfesseur = $idProfesseur;
    }

    public function setIdOrganisation($idOrganisation) {
        $this->idOrganisation = $idOrganisation;
    }

    public function setIdMaitreStage($idMaitreStage) {
        $this->idMaitreStage = $idMaitreStage;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

    public function setDateVisiteStage($dateVisiteStage) {
        $this->dateVisiteStage = $dateVisiteStage;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function setDivers($divers) {
        $this->divers = $divers;
    }

    public function setBilanTravaux($bilanTravaux) {
        $this->bilanTravaux = $bilanTravaux;
    }

    public function setRessourcesOutils($ressourcesOutils) {
        $this->ressourcesOutils = $ressourcesOutils;
    }

    public function setCommentaires($commentaires) {
        $this->commentaires = $commentaires;
    }

    public function setParticipationCCF($participationCCF) {
        $this->participationCCF = $participationCCF;
    }

}
