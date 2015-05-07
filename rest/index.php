<?php

require_once("../includes/fonctions.inc.php");

// Réception des paramètres
if (isset($_GET['ressource'])) {
    $ressource = $_GET['ressource'];
} else {
    $ressource = 'Personne';
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'getAllEtudiantsByClasseAndAnneeScol';
}

// Construction du nom de la classe contrôleur REST
$classeREST = 'R_' . ucfirst($ressource);
// Instanciation
$ctrl = new $classeREST();
// Appel de la méthode d'action
$reponse = $ctrl->$action();
// on retourne du XML
Header('Content-type: text/xml');
echo $reponse;
?>
