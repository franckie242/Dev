<?php
require_once("header.inc.php");
$filename = 'etablissements_denseignement_superieur.csv';
 
$ligne= file($filename);
 
$nbTotalLignes=count($ligne);
$tab = array();
for($i=1;$i<$nbTotalLignes;$i++){
    $ligneTab = explode(";", $ligne[$i]);
    echo "<table>";
        echo "<tr>";
            echo "<td>".$ligneTab[2]."</td>";
            echo "<td>".$ligneTab[3]."</td>";
            echo "<td>".$ligneTab[5]."</td>";
            echo "<td>".$ligneTab[9]."</td>";
            echo "<td>".$ligneTab[10]."</td>";
            echo "<td>".$ligneTab[11]."</td>";
            echo "<td>".$ligneTab[14]."</td>";
            echo "<td>".$ligneTab[16]."</td>";
            echo "<td>".$ligneTab[17]."</td>";
            echo "<td>".$ligneTab[18]."</td>";                    
        echo "</tr>";
    echo "</table>";
}
require_once("footer.inc.php");