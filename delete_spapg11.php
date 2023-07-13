<?php
include("config/connexion.php");
session_start();
error_reporting(0);

//$supp_biblio = $_GET['delete_biblio'];
if(isset( $_POST['delete']))
{
    $del_nom_calibre= $_POST['delete'];

    $stmt = $bdd->prepare("DELETE FROM `spatb11` WHERE `id_nom_calibre` = '$del_nom_calibre'");
    //$stmt->bindParam(':del_phyto', $del_phyto);
    $stmt->execute();
    
    if ($stmt) {
        // Redirection après suppression réussie
        header("Location: page_spapg11.php");
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