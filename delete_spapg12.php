<?php
session_start();
error_reporting(0);
include("config/connexion.php");

//$supp_biblio = $_GET['delete_biblio'];
if(isset( $_POST['delete']))
{
    $del_lettre = $_POST['delete'];

    $stmt = $bdd->prepare("DELETE FROM `spatb12` WHERE `id_lettre` = '$del_lettre'");
    //$stmt->bindParam(':del_lettre', $del_lettre);
    $stmt->execute();
    
    if ($stmt) {
        // Redirection après suppression réussie
        header("Location: page_spapg12.php");
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