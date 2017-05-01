<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tab = array();
for($i=1;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    // choisissons la colonne correspondant aux régions:
        $tab[$ligneTab[18]] =$ligneTab[18];
        if ($i > 1 && !in_array($ligneTab[18], $tab)) {
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
echo "<input type=\"submit\" value=\"OK\">";
echo "</fieldset>";
echo "</form>";

if (isset($_POST['region'])){
    foreach($ligne as $num){
        if(strstr($num,$_POST['region'])){
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