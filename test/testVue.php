<?php

    require_once("../includes/fonctions.inc.php");
    $maVue = new V_Vue(RACINE.'/test/templateTest.inc.php');
    $maVue->ajouter('titre', 'test unitaire de la classe Vue');
    $maVue->ajouter('entete', '<h2>ENTETE</h2>');
    $maVue->ajouter('gauche', '<h4>GAUCHE</h4>');
    $maVue->ajouter('centre', '<h3>test unitaire de la classe Vue</h3><p>GAUCHE</p>');
    $maVue->ajouter('pied', '<h4>PIED</h4>');
    
    $maVue->afficher();

