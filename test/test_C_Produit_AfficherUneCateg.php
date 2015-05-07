<?php

require_once("../includes/fonctions.inc.php");
$ctrl = new C_Produit();
// jeu d'essai : il faut ajouter un paramètre 'id'
// afficher les produits de la catégorie de code 'mas'
$_GET["id"]='mas';  
$ctrl->afficherUneCateg();

