<?php
include("../config/connexion.php");
session_start();
error_reporting(0);
//$msg = "";

if(isset($_POST['save']))
{
    $nom_produit=$_POST['nom_produit'];
   

    $cod_id=strtoupper(substr($nom_produit,0,2));

    if($nom_produit==null){
        $res=[
            'status'=> 422,
            'message'=>'All fields are mandatory'
        ];
        echo json_encode($res);
        return false; 
    }

    $req=$bdd->query("INSERT INTO `spatb12`(`id_produit`, `nom_produit`)
            VALUES ('$cod_id','$nom_produit')");

    if($req){
        $res=[
            'status'=> 200,
            'message'=>'Informations ajoutées avec succes'
        ];
        echo json_encode($res);
        return false;

    }else{
        $res=[
            'status'=> 500,
            'message'=>'Error'
        ];
        echo json_encode($res);
        return false;
    }
    
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/css_b5/bootstrap.min.css">
    <title>page produit </title>
</head>
<body>
    <form action="" method="post">
        <!-- <div class="container p-5 my-5 bg-secondary border">bonjour</div>
        <div class="container p-5 my-5 border">hhh</div>
        <div class="container p-5 my-5 bg-dark text-white">jjj</div>
        <div class="container p-5 my-5 bg-primary text-white">hhhh</div>
        <div class="container-sm p-5 my-5 bg-dark text-white">propp</div> -->

            <div class="form-group">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div>Nom Produit</div>
                            <input type="text" class="form-control" placeholder="Entrez votre nom" name="nom_conducteur">
                        </div>
                       
                    </div>
                    
                    <button class="btn btn-primary" type="submit" name="save" onclick="" >Save</button>

                </div>
    


            </div>

        <div class="container mt-5" id="table-refresh">
            <div class="row">
                <table class=" table table-hover table-bordered table-responsive ">
                    <thead class="table-dark">
                    <tr>
                        <th>Nom Produit</th>
                       
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php 

                            $sql=$bdd->query("SELECT * FROM `spatb10`");
                            while($aff=$sql->fetch()){ 
                        ?>                            
                            <tr>
                                <td><?php echo $aff['id_produit'] ; ?></td>
                               
                                <td><?php echo $aff['nom_produit'] ; ?></td>
                               
                                <td>
                                    <div class="dropdown dropend">
                                       <!-- <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action -->
                                        <!-- <div class="row">
                                            <div class="col-md-6"><button type="button" name="modifier" class="btn-sm btn-primary" data-bs-toggle="modal" data-ts-target="#modifletre">Modifier</button></div>
                                            <div class="col-md-6"> <button type="button" name="supprimer" class="btn-sm btn-primary" data-bs-toggle="modal" data-ts-target="#modifletre">supprimer</button></div>
                                        </div>   -->

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary"><a href="" class="text-white " style="text-decoration:none;" 
                                            data-bs-toggle="modal" data-bs-target="#save_information" >modifier</a>
                                            </button>
                                            <button type="button" class="btn btn-primary"><a href="spapg10.php?produit_id=<?php echo $aff['id_produit'] ; ?>" class="text-white" style="text-decoration:none;">supprimer</a></button>
                                        </div>
                                        
                                    </div> 
                                </td>
                            </tr>


                            <!-- The Modal -->
                            <div class="modal" id="save_information">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Modifier informations</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    
                                    <div class="form-group">
                                        <div class="container">
                                                <div class="mb-3">
                                                    <div>Nom produit </div>
                                                    <input type="text" class="form-control" placeholder="Entrez votre nom" name="nom_conducteur">
                                                </div>
                                               

                                        </div>
    


             </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit" name="save" onclick="" >Save changes</button>
                                </div>

                                </div>
                            </div>
                            </div>
                            <!-- <tr>
                                <td>joel</td>
                                <td>Koffi</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr> -->
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>





        <br>
        <br>
        <br>
    </form>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../css/js-b5/bootstrap.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="ajax_load.js"></script>
<script>
$(document).on('submit','save_information',function save_information(e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("save_information",true);
  $.ajax({
    type: "POST",
    url: "ajax_pg12.php",
    data: formData,
    processData:false,
    contentType:false,
    // dataType: "dataType",
    success: function (response) {
    var res =jQuery.parseJSON(response);
    if(res.status==422){
        $('#errorMessage').removeClass('d-none');
        $('#errorMessage').text(res.message);
    }else if(res.status==200){

    }
    }
  });
})

</script>
</body>
</html>
