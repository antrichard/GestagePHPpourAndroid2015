<?php

class C_Accueil extends C_ControleurGenerique {

    /**
     * controleur= accueil & action= index
     * Afficher la page d'accueil
     */
    function defaut() {
        
        $pdo = M_DaoConnexion::connecter();
        if ($pdo) {
            $listeCateg = M_DaoCategorie::getAll($pdo);
        }
        M_DaoConnexion::deconnecter($pdo);

        $titre = "La fleur and co";
        $entete = RACINE . "/vue/vueEntete.inc.php";
        $gauche = RACINE . "/vue/vueGauche.inc.php";
        $centre = RACINE . "/vue/vueCentreAccueil.inc.php";
        $pied = RACINE . "/vue/vuePied.inc.php";


        $this->vue = new V_Vue(RACINE . '/vue/template.inc.php');
        $this->vue->ajouter('listeCateg', $listeCateg);
        $this->vue->ajouter('loginAuthentification',SessionAuthentifiee::getAuth('login'));

        $this->vue->ajouter('titre', $titre);
        $this->vue->ajouter('entete', $entete);
        $this->vue->ajouter('gauche', $gauche);
        $this->vue->ajouter('centre', $centre);
        $this->vue->ajouter('pied', $pied);

        $this->vue->afficher();
    }
    
    function seConnecter() {
        $pdo = M_DaoConnexion::connecter();
        if ($pdo) {
            $listeCateg = M_DaoCategorie::getAll($pdo);
        }
        M_DaoConnexion::deconnecter($pdo);
        $this->vue = new V_Vue(RACINE . '/vue/template.inc.php');
        $this->vue->ajouter('listeCateg', $listeCateg);

        $this->vue->ajouter('titre', "La fleur and co");
        $this->vue->ajouter('entete', RACINE . "/vue/vueEntete.inc.php");
        $this->vue->ajouter('gauche', RACINE . "/vue/vueGauche.inc.php");
        $this->vue->ajouter('pied', RACINE . "/vue/vuePied.inc.php");
                
        $this->vue->ajouter('loginAuthentification',SessionAuthentifiee::getAuth('login'));
        $this->vue->ajouter('titreVue',"LAFLEUR : Accueil");
        $this->vue->ajouter('centre',RACINE . "/vue/vueCentreSeConnecter.inc.php");

        $this->vue->afficher();
    }
 
    function authentifier() {

        $pdo = M_DaoConnexion::connecter();
        if ($pdo) {
            $listeCateg = M_DaoCategorie::getAll($pdo);
        }
        
        $this->vue = new V_Vue(RACINE . '/vue/template.inc.php');
        $this->vue->ajouter('listeCateg', $listeCateg);

        $this->vue->ajouter('titre', "La fleur and co");
        $this->vue->ajouter('entete', RACINE . "/vue/vueEntete.inc.php");
        $this->vue->ajouter('gauche', RACINE . "/vue/vueGauche.inc.php");
        $this->vue->ajouter('pied', RACINE . "/vue/vuePied.inc.php");
                
        $this->vue->ajouter('titreVue',"LAFLEUR : Accueil");
        //------------------------------------------------------------------------
        // VUE CENTRALE
        //------------------------------------------------------------------------
        // Vérifier login et mot de passe saisis dans la formulaire d'authentification
        if (isset($_POST['login']) && isset($_POST['mdp'])) {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            if (M_DaoClient::verifierLogin($pdo, $login, $mdp)) {
                // Si le login et le mot de passe sont valides, ouvrir une nouvelle session
                SessionAuthentifiee::authentifier(array('login' => $login)); // service minimum
                $this->vue->ajouter('message',"Authentification réussie");
                $this->vue->ajouter('centre',RACINE . "/vue/vueCentreAccueil.inc.php");
            } else {
                $this->vue->ajouter('message',"ECHEC d'identification : login ou mot de passe inconnus ");
                $this->vue->ajouter('centre',RACINE . "/vue/vueCentreSeConnecter.inc.php");
            }
        } else {
            $this->vue->ajouter('message',"Attention : le login ou le mot de passe ne sont pas renseign&eacute;s");
            $this->vue->ajouter('centre',RACINE . "/vue/vueCentreSeConnecter.inc.php");
        }
        //------------------------------------------------------------------------

        $this->vue->ajouter('loginAuthentification',SessionAuthentifiee::getAuth('login'));
        M_DaoConnexion::deconnecter($pdo);
        $this->vue->afficher();
    }

    function seDeconnecter() {
        SessionAuthentifiee::finAuthentification();
        header("Location:  ".RACINE."/public/index.php");
    }

    

}
