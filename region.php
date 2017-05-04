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
unset($tab[0]);

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

$cpt = 0;
if(isset($_POST['region'])){
    for($j=1; $j<$nbTotalLignes;$j++){
        $ligneTab2 = explode(";", $ligne[$j]);
        if(strstr($ligneTab2[18],$_POST['region'])){
            $cpt++;
            echo "<table>";
                echo "<tr>";
                    echo "<td>".$ligneTab2[2]."</td>";
                    echo "<td>".$ligneTab2[3]."</td>";
                    echo "<td>".$ligneTab2[5]."</td>";
                    echo "<td>".$ligneTab2[9]."</td>";
                    echo "<td>".$ligneTab2[10]."</td>";
                    echo "<td>".$ligneTab2[11]."</td>";
                    echo "<td>".$ligneTab2[14]."</td>";
                    echo "<td>".$ligneTab2[16]."</td>";
                    echo "<td>".$ligneTab2[17]."</td>";
                    echo "<td>".$ligneTab2[18]."</td>";                 
                echo "</tr>";
            echo "</table>";
        }
    }
    echo $cpt." école(s) correspond(ent) à votre recherche";
}
require_once("footer.inc.php");
?>