<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tab = array();
for($i=0;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    // choisissons la colonne correspondant aux académies:
        $tab[$ligneTab[17]] =$ligneTab[17];
        if ($nbTotalLignes > 1 && $nbTotalLignes < 3660 && !in_array($ligneTab[17], $tab)) {
                array_push($tab, $ligneTab[17]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore
                
        }
}
sort($tab, SORT_STRING); // On trie le tableau
unset($tab[1]);
unset($tab[0]);


echo "<form action=\"academie.php\" method=\"post\">";
    echo "<fieldset>";
        echo "<label for=\"academie\">Veuillez sélectionner ci-dessous l'académie que vous souhaitez trouver</label>";
        echo "<select name=\"academie\" id=\"academie\">";

foreach($tab as $val){
    echo "<option>".$val."</option>";
}
echo "</select>";
echo "</fieldset>";
echo "</form>";
require_once("footer.inc.php");
?>