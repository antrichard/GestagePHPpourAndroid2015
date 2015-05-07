<!DOCTYPE html>
<!--
Ce fichier est utilisé pour le test unitaire de la classe V_Vue
Il doit être garni avec les données suivantes  : titre, entete, gauche, centre, pied
-->
<html>
    <head>
        <link rel="stylesheet" href="../vue/css/styleLargeurFixe.css" />
        <meta charset="UTF-8">
        <title><?php echo $this->lire('titre'); ?></title>
    </head>
    <body>
	<div id="conteneur">
            <div id="header">
               <?php echo $this->lire('entete'); ?>
            </div>
            <div id="gauche">
               <?php echo $this->lire('gauche'); ?>
            </div>
            <div id="centre">
                <?php echo $this->lire('centre'); ?>
            </div>
            <div id="pied">
                <?php echo $this->lire('pied'); ?>
            </div>
        </div>     
    </body>
</html>
