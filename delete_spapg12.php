<?php

include("config/connexion.php");

//$supp_biblio = $_GET['delete_biblio'];
if(isset( $_GET['delete_12']))
{
    $del_lettre = $_GET['delete_12'];

    $stmt = $bdd->prepare("DELETE FROM `spatb12` WHERE `id_lettre` = '$del_lettre' ;");
    //$stmt->bindParam(':del_lettre', $del_lettre);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // Redirection après suppression réussie
        header("Location:page_spapg12.php");
    } else {
        ?>
                <script>
                    alert("Une erreur s'est produite lors de la suppression.");
                </script>
        <?php
        // Gérer le cas où aucune ligne n'a été supprimée
        // ou une erreur s'est produite

        echo "Une erreur s'est produite lors de la suppression.";
    }	
    
}

?>