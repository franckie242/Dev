<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tab = array();
for($i=0;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    // choisissons la colonne correspondant aux régions:
        $tab[$ligneTab[18]] =$ligneTab[18];
        if ($nbTotalLignes > 1 && !in_array($ligneTab[18], $tab)) {
                array_push($tab, $ligneTab[18]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore
                
        }
}
sort($tab, SORT_STRING); // On trie le tableau

echo "<form action=\"region.php\" method=\"post\">";
    echo "<fieldset>";
        echo "<label for=\"region\">Veuillez sélectionner ci-dessous la région que vous souhaitez trouver</label>";
        echo "<select name=\"region\" id=\"region\">";

foreach($tab as $val){
    echo "<option>".$val."</option>";
}
echo "</select>";
echo "</fieldset>";
echo "</form>";
require_once("footer.inc.php");
?>