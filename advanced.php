<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tabtyp = array();
$tabsta = array();
$tabreg = array();
for($i=1;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    // choisissons la colonne correspondant aux régions:
        $tabtyp[$ligneTab[2]] =$ligneTab[2];
        $tabsta[$ligneTab[5]]=$ligneTab[5];
        $tabreg[$ligneTab[18]]=$ligneTab[18];
        
        if ($i > 1 && !in_array($ligneTab[2], $tabtyp)) {
                array_push($tabtyp, $ligneTab[2]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore       
        }
        if ($i > 1 && !in_array($ligneTab[5], $tabsta)) {
                array_push($tabsta, $ligneTab[5]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore       
        }
        if ($i > 1 && !in_array($ligneTab[18], $tabreg)) {
                array_push($tabreg, $ligneTab[18]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore       
        }
}
sort($tabtyp, SORT_STRING); // On trie le tableau
sort($tabsta, SORT_STRING); // On trie le tableau
sort($tabreg, SORT_STRING); // On trie le tableau

unset($tabreg[0]);
echo "<form action=\"advanced.php\" method=\"post\">";
    echo "<fieldset>";
        echo "<label for=\"type\">Veuillez sélectionner le type d'établissement que vous souhaitez trouver </label>";
        echo "<select name=\"type\" id=\"type\">";
        foreach($tabtyp as $value){
            echo "<option>".$value."</option>";
        }
        echo "</select>";
        echo "<br/>";
        
        echo "<label for=\"status\">Veuillez sélectionner le statut que vous souhaitez trouver </label>";
        echo "<select name=\"status\" id=\"status\">";
        foreach($tabsta as $value1){
            echo "<option>".$value1."</option>";
        }
        echo "</select>";
        echo "<br/>";
        
        echo "<label for=\"region\">Veuillez sélectionner la région que vous souhaitez trouver </label>";
        echo "<select name=\"region\" id=\"region\">";
        foreach($tabreg as $value2){
            echo "<option>".$value2."</option>";
        }
        echo "</select>";
        echo "<br/>";
        
        echo "<input type=\"submit\" value=\"OK\">";
    echo "</fieldset>";
echo "</form>";
echo "<section>";
$cpt = 0;
if(isset($_POST['type']) && isset($_POST['status'])  && isset($_POST['region'])) {
    for($j=1; $j<$nbTotalLignes;$j++){
        $ligneTab2 = explode(";", $ligne[$j]);
        if(strstr($ligneTab2[2],$_POST['type']) && strstr($ligneTab2[5], $_POST['status']) && $ligneTab2[18] == $_POST['region']){
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
