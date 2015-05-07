<?php

    require_once("../includes/fonctions.inc.php");
    $maVue = new V_Vue(RACINE.'/vue/vueGauche.inc.php');
    $listeCateg = Array(new M_Categorie('c1','Categorie 1'), new M_Categorie('c2','Categorie 2'), new M_Categorie('c3','Categorie 3'));
    $maVue->ajouter('listeCateg', $listeCateg);
    
    $maVue->afficher();

