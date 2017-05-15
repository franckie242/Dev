<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tabaca = array();
$tabsta = array();
$tabtyp = array();
$tabvil = array();
$tabdep = array();
$tabreg = array();
for($i=1;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    // choisissons la colonne correspondant aux régions:
        $tabaca[$ligneTab[17]] =$ligneTab[17];
        $tabsta[$ligneTab[5]] = $ligneTab[5];
        $tabtyp[$ligneTab[2]] = $ligneTab[2];
        $tabvil[$ligneTab[11]] = $ligneTab[11];
        $tabdep[$ligneTab[16]] = $ligneTab[16];
        $tabreg[$ligneTab[18]] = $ligneTab[18]
       
        
        if ($i > 1 && !in_array($ligneTab[17], $tabaca)) {
                array_push($tabaca, $ligneTab[17]); // On ajoute l'élément au tableau uniquement si celui-ci n'existe pas encore
        }
        if ($i > 1 && !in_array($ligneTab[5], $tabsta)){
            array_push($tabsta, $ligneTab[5]);
        }
        if ($i > 1 && !in_array($ligneTab[2], $tabtyp)){
            array_push($tabtyp, $ligneTab[2]);
        }
        if ($i > 1 && !in_array($ligneTab[11], $tabvil)){
            array_push($tabvil, $ligneTab[11]);
        }
        if ($i > 1 && !in_array($ligneTab[16], $tabdep)){
            array_push($tabdep, $ligneTab[16]);
        }
        if ($i > 1 && !in_array($ligneTab[18], $tabreg)){
            array_push($tabreg, $ligneTab[18]);
        }
}
sort($tabaca, SORT_STRING); // On trie le tableau
sort($tabsta, SORT_STRING);
sort($tabtyp, SORT_STRING);
sort($tabvil, SORT_STRING);
sort($tabdep, SORT_STRING);
sort($tabreg, SORT_STRING);
unset($tabaca[1]);
unset($tabaca[0]);
unset($tabreg[0]);

echo "<form action=\"advanced.php\" method=\"post\">";
    echo "<fieldset>";
        echo "<label for=\"type\">Sélectionnez le type d'établissement recherchée </label>";
        echo "<select name=\"type\" id=\"type\">";
        
        foreach($tabtyp as $value1){
            echo "<option>".$value1."</option>";
        }
        echo "</select>";
        echo "<label for=\"status\">Sélectionnez le statut de l'école recherchée </label>";
        echo "<select name=\"status\" id=\"status\">";
        
        foreach($tabsta as $value2){
            echo "<option>".$value2."</option>";
        }
        echo "</select>";
        echo "<label for=\"region\">Sélectionnez la région de l'école recherchée </label>";
        echo "<select name=\"region\" id=\"region\">";
        
        foreach($tabreg as $value3){
            echo "<option>".$value3."</option>";
        }
        echo "</select>";
        echo "<label for=\"academie\">Veuillez sélectionner l'académie que vous souhaitez trouver </label>";
        echo "<select name=\"academie\" id=\"academie\">";

        foreach($tabaca as $value4){
            echo "<option>".$value4."</option>";
        }
        echo "</select>";
        echo "<label for=\"departement\">Sélectionnez le département de l'école recherchée </label>";
        echo "<select name=\"departement\" id=\"departement\">";
        
        foreach($tabdep as $value5){
            echo "<option>".$value5."</option>";
        }
        echo "</select>";
        echo "<label for=\"ville\">Sélectionnez le stetue de l'école recherchée </label>";
        echo "<select name=\"ville\" id=\"ville\">";
        
        foreach($tabvil as $value6){
            echo "<option>".$value6."</option>";
        }
        echo "</select>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</fieldset>";
echo "</form>";
echo "<section>";
$cpt = 0;
if(isset($_POST['academie']) && isset($_POST['status']) && isset($_POST['type']) && isset($_POST['ville']) && isset($_POST['departement']) && isset($_POST['region'])){
    for($j=1; $j<$nbTotalLignes;$j++){
        $ligneTab2 = explode(";", $ligne[$j]);
        if(strstr($ligneTab2[17],$_POST['academie']) && strstr($ligneTab2[5], $_POST['status']) && strstr($ligneTab2[2], $_POST['type']) && strstr($ligneTab2[11], $_POST['ville']) && strstr($ligneTab2[16], $_POST['departement']) && strstr($ligneTab2[18], $_POST['region'])){
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
