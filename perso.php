<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tab = array();
for($i=1;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    // choisissons la colonne correspondant aux villes:
        $tab[$ligneTab[11]] =$ligneTab[11];
        
        if ($i > 1 && !in_array($ligneTab[11], $tab)) {
                array_push($tab, $ligneTab[11]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore
                
        }
}
sort($tab, SORT_STRING); // On trie le tableau
echo "<form action=\"perso.php\" method=\"get\">";
    echo "<fieldset>";
        echo "<label>Veuillez sélectionner  la ville que vous souhaitez trouver  </label>";
        echo "<input type=\"text\" name=\"texte\">";
        echo "<input type=\"submit\" value=\"OK\">";
echo "</fieldset>";
echo "</form>";
echo "<section>";
echo "<h2>Recherche personnalisée</h2>";
$cpt=0;
if(isset($_GET['texte'])){
    for($j=1; $j<$nbTotalLignes;$j++){
        $ligneTab2 = explode(";", $ligne[$j]);
            if(strstr(strtoupper($ligne[$j]),$_GET['texte']) || strstr(strtolower($ligne[$j]),$_GET['texte']) || strstr($ligne[$j],$_GET['texte'])){
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
    echo '<p class="compteur">'.$cpt.' école(s) correspond(ent) à votre recherche</p>';
}
echo "</section>";
require_once("footer.inc.php");
?>