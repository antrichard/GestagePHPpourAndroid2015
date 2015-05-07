<ul class="menugauche">
    <p><b>Menu</b></p>
    <li><a href="<?php echo RACINE; ?>/public/index.php" >Accueil</a></li>
    <hr/>
    <?php
    if (!is_null($this->lire('loginAuthentification'))) {
        echo "<h6>" . $this->lire('loginAuthentification') . "</h6>";
        echo "<li><a href=\"" . RACINE . "/public/index.php?controleur=accueil&action=seDeconnecter\">Se d&eacute;connecter</a></li>";
    } else {
        echo "<li><a href=\"" . RACINE . "/public/index.php?controleur=accueil&action=seConnecter\">Se connecter</a></li>";
    }
    ?>

    <b>Nos produits</b>
    <li><a href="<?php echo RACINE; ?>/public/index.php?controleur=produit&action=afficherTous" >Tous</a></li>
    <?php
    $listeCateg = $this->lire('listeCateg');
    foreach ($listeCateg as $categ) {
        echo "<li><a href=\"" . RACINE . "/public/index.php?controleur=produit&action=afficherUneCateg&id=" . $categ->getCode() . "\" >" . $categ->getLibelle() . "</a></li>";
    }
    ?>
</ul>
