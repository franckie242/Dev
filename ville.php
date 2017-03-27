<?php
    require_once("header.inc.php");
?>
<form action="ville.php" method="post">
    <fieldset>
        <label for="ville">Veuillez sélectionner ci-dessous la ville que vous souhaitez chercher</label>
        <select name="ville" id="ville">
        <?php
            $fichier = 'etablissements_denseignement_superieur.csv';

            $fich = fopen($fichier, 'r');
            $ligne = fgetcsv($fich, 3700, ';');
            $ligneTab = explode(";", $ligne );
            echo "<option value=\"$ligneTab[11]\">".$ligneTab[11]."</option>";
        ?>
    </fieldset>
        </form>
<?php
    require_once("footer.inc.php");
?>
