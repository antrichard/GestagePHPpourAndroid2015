<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test Dao</title>
    </head>
    <body>
        <?php
        require_once("../includes/fonctions.inc.php");
//        require_once("../modele/dao/DaoInterface.class.php");
//        require_once("../modele/dao/DaoConnexion.class.php");
//        require_once("../modele/dao/DaoCategorie.class.php");
//        require_once("../modele/metier/Categorie.class.php");
//        require_once("../modele/dao/DaoProduit.class.php");
//        require_once("../modele/metier/Produit.class.php");

        $pdo = M_DaoConnexion::connecter();
        
       
        // Test de M_DaoCategorie
        echo "<h3>Test de DaoCategorie</h3>";

        // Categorie : test de sélection par code
        echo "<p>Categorie : test de sélection par code</p>";
        $uneCateg = M_DaoCategorie::getOneById($pdo,'bul');
        echo $uneCateg;

        // Categorie : test de sélection de tous les enregistrements
        echo "<p>Categorie : test de sélection de tous les enregistrements</p>";
        $lesCategs = M_DaoCategorie::getAll($pdo);
        var_dump($lesCategs);

        
        // Test de M_DaoProduit
        echo "<h3>Test de DaoProduit</h3>";

        // Produit : test de sélection par référence
        echo "<p>Produit : test de sélection par référence</p>";
        $unPdt = M_DaoProduit::getOneById($pdo,'m02');
        echo $unPdt;

        // Produit : test de sélection de tous les enregistrements
        echo "<p>Produit : test de sélection de tous les enregistrements</p>";
        $lesProds = M_DaoProduit::getAll($pdo);
        var_dump($lesProds);
        
        // Produit : tous les produits d'une catégorie
        echo "<p>Produit : tous les produits d'une catégorie</p>";
        $lesProds = M_DaoProduit::getAllByCateg($pdo, 'mas');
        var_dump($lesProds);

        // Test de M_DaoClient
        echo "<h3>Test de M_DaoClient</h3>";

        // Client : test de sélection par code
        echo "<p>Client : test de sélection par code</p>";
        $unClient = M_DaoClient::getOneById($pdo,'c0002');
        echo $unClient;

        // Client : test de sélection de tous les enregistrements
        echo "<p>Client : test de sélection de tous les enregistrements</p>";
        $lesClients = M_DaoClient::getAll($pdo);
        var_dump($lesClients);

        // Client : test de verifierLogin
        echo "<p>Client : test de verifierLogin</p>";
        echo "test1 : authentification Ok";
        echo (M_DaoClient::verifierLogin($pdo,"dubois@club-internet.fr","bbb"))  ? " : REUSSI <br/>" : " : *** ECHEC *** <br/>";
        echo "test2 : erreur de mot de passe";
        echo (M_DaoClient::verifierLogin($pdo,"dubois@club-internet.fr","xxx"))  ? " : *** ECHEC *** <br/>" : " : REUSSI <br/>";
        echo "test2 : erreur de login";
        echo (M_DaoClient::verifierLogin($pdo,"xxxx@club-internet.fr","bbb"))  ? " : *** ECHEC *** <br/>" : " : REUSSI <br/>";
        
        // Test de M_DaoCategorie
        echo "<h3>Test de M_DaoCategorie</h3>";

        // Categorie : test de sélection par code
        echo "<p>Categorie : test de sélection par code</p>";
        $uneCateg = M_DaoCategorie::getOneById($pdo,'yyy');
        echo $uneCateg;
        
        // Categorie : test d'insertion d'enregistrement
        echo "<p>ategorie : test d'insertion d'enregistrement</p>";
        $nouvCateg = new M_Categorie("x99", "test d\'ajout");
        $nb = M_DaoCategorie::insert($pdo,$nouvCateg);
        echo "Nb lignes ajoutées : ".$nb;
        
        // Categorie : test de suppression d'enregistrement
        echo "<p>ategorie : test de suppression d'enregistrement</p>";
        $idCateg = "x99";
        $nb = M_DaoCategorie::delete($pdo,$idCateg);
        echo "Nb lignes supprimées : ".$nb;
         
        
        M_DaoConnexion::deconnecter($pdo);               
        
        ?>
    </body>
</html>
