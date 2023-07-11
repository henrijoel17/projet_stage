<?php
include("../config/connexion.php");
session_start();
error_reporting(0);
//$msg = "";

if(isset($_POST['save']))
{
    $nom_c=$_POST['nom_conducteur'];
    $prenom_c=$_POST['prenom_conducteur'];
    $qte=$_POST['qte'];
    $date_l=$_POST['date_ach'];
    $cd_emb=$_POST['code_ach_emb'];
    $num_camion=$_POST['num_camion'];

    $cod_id=strtoupper(substr($nom_c,0,2).substr($prenom_c,0,2));

    if($nom_c==null||$prenom_c==null||$qte==null||$date_l==null||$cd_emb==null||$num_camion==null){
        $res=[
            'status'=> 422,
            'message'=>'All fields are mandatory'
        ];
        echo json_encode($res);
        return false; 
    }

    $req=$bdd->query("INSERT INTO `spatb12`(`id_lettre`, `nom_transporteur`, `prenom_transporteur`, `qte_achemine`, `date_achemine`)
            VALUES ('$cod_id','$nom_c','$prenom_c','$qte','$date_l')");

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
    <title>page lettre voiture</title>
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
                            <div>Nom du conducteur</div>
                            <input type="text" class="form-control" placeholder="Entrez votre nom" name="nom_conducteur">
                        </div>
                        <div class="col-md-4">
                            <div> Prenom du conducteur</div>
                            <input type="text" class="form-control" placeholder="Entrez le prenom du conducteur" name="prenom_conducteur" >
                        </div>
                        <div class="col-md-4">
                            <div>Quantité acheminée</div>
                            <input type="text" class="form-control" placeholder="Entrez la quantité" name="qte">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div>date d'acheminement</div>
                            <input type="date" class="form-control" placeholder="" name="date_ach">
                        </div>
                        <div class="col-md-4">
                            <div>Code d'emballage</div>
                            <input type="text" class="form-control" placeholder="Entrez le code d'emballage" name="code_ach_emb" >
                        </div>
                        <div class="col-md-4">
                            <div>N° du camion</div>
                            <input type="text" class="form-control" placeholder="N° du camion" name="num_camion">
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
                        <th>code lettre</th>
                        <th>nom & prenom du conducteur</th>
                        <th>Quantité acheminée</th>
                        <th>date acheminement</th>
                        <th>code de l'emballage</th>
                        <th>N° du camion</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php 

                            $sql=$bdd->query("SELECT * FROM `spatb12`");
                            while($aff=$sql->fetch()){ 
                        ?>                            
                            <tr>
                                <td><?php echo $aff['id_lettre'] ; ?></td>
                                <td><?php echo $aff['nom_transporteur'].' '.$aff['prenom_transporteur'] ; ?></td>
                                <td><?php echo $aff['qte_achemine'] ; ?></td>
                                <td><?php echo $aff['date_achemine'] ; ?></td>
                                <td><?php echo $aff['id_emballage'] ; ?></td>
                                <td><?php echo $aff['id_camion'] ; ?></td>
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
                                            <button type="button" class="btn btn-primary"><a href="spapg12.php?lettre_id=<?php echo $aff['id_lettre'] ; ?>" class="text-white" style="text-decoration:none;">suppimer</a></button>
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
                                                    <div>Nom du conducteur</div>
                                                    <input type="text" class="form-control" placeholder="Entrez votre nom" name="nom_conducteur">
                                                </div>
                                                <div class="mb-3">
                                                    <div> Prenom du conducteur</div>
                                                    <input type="text" class="form-control" placeholder="Entrez le prenom du conducteur" name="prenom_conducteur" >
                                                </div>
                                                <div class="mb-3">
                                                    <div>Quantité acheminée</div>
                                                    <input type="text" class="form-control" placeholder="Entrez la quantité" name="qte">
                                                </div>
                                            
                                            
                                                <div class="mb-3">
                                                    <div>date d'acheminement</div>
                                                    <input type="date" class="form-control" placeholder="" name="date_ach">
                                                </div>
                                                <div class="mb-3">
                                                    <div>Code d'emballage</div>
                                                    <input type="text" class="form-control" placeholder="Entrez le code d'emballage" name="code_ach_emb" >
                                                </div>
                                                <div class="mb-3">
                                                    <div>N° du camion</div>
                                                    <input type="text" class="form-control" placeholder="N° du camion" name="num_camion">
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
