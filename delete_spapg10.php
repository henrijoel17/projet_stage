<?php
include("config/connexion.php");
session_start();
error_reporting(0);

//$supp_biblio = $_GET['delete_biblio'];
if(isset( $_POST['delete']))
{
    $del_nom_produit= $_POST['delete'];

    $stmt = $bdd->prepare("DELETE FROM `spatb10` WHERE `id_produit` = '$del_nom_produit'");
    //$stmt->bindParam(':del_phyto', $del_phyto);
    $stmt->execute();
    
    if ($stmt) {
        // Redirection après suppression réussie
        header("Location: page_spapg10.php");
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