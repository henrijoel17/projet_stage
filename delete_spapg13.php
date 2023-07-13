<?php
include("config/connexion.php");

//$del_pays = "null";

if(isset( $_GET['delete_13']))
{
    $del_pays = $_GET['delete_13'];

   // echo $del_pays;

    $stmt = $bdd->prepare("DELETE FROM `spatb13` WHERE `id_pays` = $del_pays ;");
    //$stmt->bindParam(':del_pays', $del_lettre);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // Redirection après suppression réussie
        header("Location:page_spapg13.php");
    } else {
        ?>
                <script>
                    alert("Une erreur s'est produite lors de la suppression.");
                </script>
        <?php
        // Gérer le cas où aucune ligne n'a été supprimée
        // ou une erreur s'est produite

       // echo "Une erreur s'est produite lors de la suppression.";
    }	
    
}



?>