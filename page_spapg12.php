<?php

//$b="contenu.php";
if(isset($_GET['page'])){
    switch ($_GET){
        case 'cont':
            include("yt22/spapg12.php");
            break;
    }
}

include("config/connexion.php");
include("entete.php");
include("verticale.php");
// $b="contenu.php";
// if(isset($_GET['page'])){
//     switch ($_GET){
//         case 'cont':
//             include("yt22/spapg12.php");
//         break;
//     }
// }
//include("contenu.php");
include("pg_spapg12.php");
include("footer.php");

?>
