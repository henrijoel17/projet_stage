<?php
//session_start();
//error_reporting(0);

include("config/connexion.php");
//$msg = "";

if(isset($_GET['save']))
{
    $nom_navire=$_GET['nom_navire'];

    // if($nom_c==null||$prenom_c==null||$qte==null||$date_l==null||$cd_emb==null||$num_camion==null){
    //     $res=[
    //         'status'=> 422,
    //         'message'=>'All fields are mandatory'
    //     ];
    //     echo json_encode($res);
    //     return false; 
    // }

    $req=$bdd->query("INSERT INTO `spatb15`( `nom_navire`) VALUES ('$nom_navire');");

    if($req){

            ?>
                <script>
                    alert("Donnée ajoutée avec succès");
                </script>
    
        <?php 
    }
    // if($req){
    //     $res=[
    //         'status'=> 200,
    //         'message'=>'Informations ajoutées avec succes'
    //     ];
    //     echo json_encode($res);
    //     return false;

    // }else{
    //     $res=[
    //         'status'=> 500,
    //         'message'=>'Error'
    //     ];
    //     echo json_encode($res);
    //     return false;
    // }
    
}


?>

<div class="page-wrapper">
    <form action="" method="get">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">Ajouter un navire</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
							<div class="row formtype">
                               
                                <div class="col-md-4">
									<div class="form-group">
										<label>Nom navire</label>
										<input class="form-control" type="text" placeholder="Entrez le nom navire" name="nom_navire">
                                    </div>
								</div>
                            
			
							</div>
						
					</div>
				</div>
				<button type="submit" class="btn btn-primary buttonedit1" name="save">Enregistrer</button>
			</div>
            <br>
            <br><br>
            <div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">Liste des navires</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
                        <div class="card card-table">
							<div class="card-body booking_card">
								<div class="table-responsive">
									<table class="datatable table table-stripped table table-hover table-center mb-0">
										<thead>
											<tr>
                                                <th>ID navire</th>
                                                <th>nom navire</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
										<tbody>

                                        <?php 

                                            $sql=$bdd->query("SELECT * FROM `spatb15`");
                                            while($aff=$sql->fetch()){ 
                                            ?>  
											<tr>
                                            <td><?php echo $aff['id_navire'] ; ?></td>
                                            <td><?php echo $aff['nom_navire'] ; ?></td>
												<td class="text-right">
													<div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
														<div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="edit-booking.html"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a> <a class="dropdown-item" href="delete_spapg15.php?delete_15=<?php echo $aff['id_navire'] ; ?>" ><i class="fas fa-trash-alt m-r-5"></i> Delete</a> </div>
													</div>
												</td>
											</tr>

                                            <?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="btn btn-primary buttonedit1">Create Customer</button>
			</div>
    </form>
</div>
