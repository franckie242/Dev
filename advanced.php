<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tab = array();
$table = array();
for($i=1;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    // choisissons la colonne correspondant aux régions:
        $tab[$ligneTab[17]] =$ligneTab[17];
        $table[$ligneTab[5]] = $ligneTab[5];
        
        if ($i > 1 && !in_array($ligneTab[17], $tab)) {
                array_push($tab, $ligneTab[17]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore
        }
        if ($i > 1 && !in_array($ligneTab[5], $table)){
            array_push($table, $ligneTab[5]);
        }
}
sort($tab, SORT_STRING); // On trie le tableau
sort($tqble, SORT_STRING);
unset($tab[1]);
unset($tab[0]);

echo "<form action=\"advanced.php\" method=\"post\">";
    echo "<fieldset>";
        echo "<label for=\"status\">Sélectionnez le stetue de l'école recherchée </label>";
        echo "<select name=\"status\" id=\"status\">";
        
        foreach($table as $value){
            echo "<option>".$value."</option>";
        }
        echo "<label for=\"academie\">Veuillez sélectionner l'académie que vous souhaitez trouver </label>";
        echo "<select name=\"academie\" id=\"academie\">";

foreach($tab as $val){
    echo "<option>".$val."</option>";
}
echo "</select>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</fieldset>";
echo "</form>";
echo "<section>";
$cpt = 0;
if(isset($_POST['academie']) && isset($_POST['status'])){
    for($j=1; $j<$nbTotalLignes;$j++){
        $ligneTab2 = explode(";", $ligne[$j]);
        if(strstr($ligneTab2[17],$_POST['academie']) && strstr($ligneTab2[5], $_POST['status'])){
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
    echo '<p class="compteur">'.$cpt.' école(s) correspond(ent) à votre recherche';
}
echo "</section>";

require_once("footer.inc.php");
?>
