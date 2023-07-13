<?php
include("config/connexion.php");
session_start();
error_reporting(0);

//$supp_biblio = $_GET['delete_biblio'];
if(isset( $_POST['delete']))
{
    $del_lib_acc= $_POST['delete'];

    $stmt = $bdd->prepare("DELETE FROM `spatb31` WHERE `id_lib_acc` = '$del_lib_acc'");
    //$stmt->bindParam(':del_phyto', $del_phyto);
    $stmt->execute();
    
    if ($stmt) {
        // Redirection après suppression réussie
        header("Location: page_spapg31.php");
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