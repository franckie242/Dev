<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tab = array();
for($i=1;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    // choisissons la colonne correspondant aux régions:
        $tab[$ligneTab[2]] =$ligneTab[2];
        if ($i > 1 && !in_array($ligneTab[2], $tab)) {
                array_push($tab, $ligneTab[2]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore
                
        }
}
sort($tab, SORT_STRING); // On trie le tableau

echo "<form action=\"etablissement.php\" method=\"post\">";
    echo "<fieldset>";
        echo "<label for=\"etablissement\">Veuillez sélectionner ci-dessous le type d'établissement que vous souhaitez trouver</label>";
        echo "<select name=\"etablissement\" id=\"etablissement\">";

foreach($tab as $val){
    echo "<option>".$val."</option>";
}
echo "</select>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</fieldset>";
echo "</form>";

if (isset($_POST['etablissement'])){
    foreach($ligne as $num){
        if(strstr($num,$_POST['etablissement'])){
            echo "<table border=1>";
                echo "<tr>";
                    echo "<td>".$num."</td>";
                echo "</tr>";
            echo "</table>";
        }
    }
}
require_once("footer.inc.php");
?>