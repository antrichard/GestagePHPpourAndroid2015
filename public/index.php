<?php

require_once("../includes/fonctions.inc.php");

// Réception des paramètres
if (isset($_GET['controleur'])) {
    $ressource = $_GET['controleur'];
} else {
    $ressource = 'accueil';
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'defaut';
}

// Construction du nom de la classe contrôleur
$classeControleur = 'C_' . ucfirst($ressource);
// Instanciation
$ctrl = new $classeControleur();
// Appel de la méthode d'action
$ctrl->$action();

?>
