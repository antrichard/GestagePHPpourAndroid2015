<h3>Dites-le avec Lafleur</h3>
<p><img src="<?php echo RACINE; ?>/vue/images/accueil.jpg" alt="image d'accueil" /></p>
<p> Appelez notre service commercial au 03.22.84.65.74 pour recevoir un bon de commande</p>
<?php
if (!is_null($this->lire('message'))) {
    echo "<strong>" . $this->lire('message') . "</strong>";
}
?>