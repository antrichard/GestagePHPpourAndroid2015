<?php

$listeProduits = $this->lire('listeProduits');


echo "<h3>Liste des produits</h3>\n";
if (!is_null($this->lire('libelleCateg'))) {
    echo "de la catégorie " . $this->lire('libelleCateg');
}

//for ($i = 0; $i < 10; $i++) {
//    echo '<br/>';
//}
echo "<table>\n";
echo "<tr><th >designation</th><th>prix</th><th>image</th></tr>\n";
// pour chaque enregistrement
for ($i = 0; $i < count($listeProduits); $i++) {
    $produit = $listeProduits[$i];
    echo "<tr>\n";
    // première colonne, nom du produit
    echo "<td>" . $produit->getDesignation() . "</td>\n";
    // deuxième colonne,prix
    echo "<td>" . $produit->getPrix() . "</td>\n";
    // troisième colonne image
    echo "<td><img src=\"" . RACINE . "/vue/images/" . $produit->getImage() . ".jpg\"> </img></td>\n";
    echo "</tr>\n";
}
echo "</table>\n";
?>
