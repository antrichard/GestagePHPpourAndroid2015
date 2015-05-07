<!-- VARIABLES NECESSAIRES -->
<!-- message : à afficher sous le formulaire -->
<h3>Connexion</h3>
<form method="post" action="<?php echo RACINE; ?>/public/index.php?controleur=accueil&action=authentifier">
    <fieldset>
        <legend>Authentification</legend>
        <label for="login">e-mail :</label>
        <input type="text" name="login" id="login"></input><br/>
        <label for="mdp">mot de passe :</label>
        <input type="password" name="mdp" id="mdp"></input><br/>
        <input type="submit" value="Valider"/>
    </fieldset>
</form>
<?php
if (!is_null($this->lire('message'))) {
    echo "<strong>" . $this->lire('message') . "</strong>";
}
?>