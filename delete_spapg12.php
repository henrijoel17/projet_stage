<?php
include("config/connexion.php");

//$supp_biblio = $_GET['delete_biblio'];
if(isset( $_POST['delete']))
{
    $del_lettre = $_POST['delete'];
    $req1 = $bdd->query("DELETE FROM `spatb12` WHERE `id_lettre`='$del_lettre'");
    
        ?>
        <script >
            if(confirm("Voulez supprimer ces données ??")){
                <?php if ($req1) {?>       
			    alert('supprime avec succes');
			    window.location.href="page_spapg12.php";
                <?php } ?>
            }else{
                window.location.href="page_spapg12.php"; 
            }
		</script>
    <?php
    
}

?>