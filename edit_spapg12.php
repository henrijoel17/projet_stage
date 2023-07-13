<?php
include("config/connexion.php");
session_start();
error_reporting(0);
$update = $_POST['utpdate'];
$rec = $bdd->query("SELECT * FROM `bibliotheque` WHERE `id_biblio`='$update_biblio'");
$recup = $rec->fetch();
//$msg = "";

if(isset($_POST['save']))
{
    $nom_c=$_POST['nom_conducteur'];
    $prenom_c=$_POST['prenom_conducteur'];
    $qte=$_POST['qte'];
    $date_l=$_POST['date_ach'];
    $cd_emb=$_POST['code_ach_emb'];
    $num_camion=$_POST['num_camion'];
    $cb_camion=$_POST['cb_camion'];
    $emb = $_POST['cb_emballage'];

    $opt=$bdd->query("SELECT * FROM `spatb18` WHERE `nom_emballage`='$emb'");
    $recup=$opt->fetch();
    $ar=$recup['id_emballage'];

    $cod_id=strtoupper(substr($nom_c,0,2).substr($prenom_c,0,2));

    // if($nom_c==null||$prenom_c==null||$qte==null||$date_l==null||$cd_emb==null||$num_camion==null){
    //     $res=[
    //         'status'=> 422,
    //         'message'=>'All fields are mandatory'
    //     ];
    //     echo json_encode($res);
    //     return false; 
    // }

    $req=$bdd->query("INSERT INTO `spatb12`(`id_lettre`, `nom_transporteur`, `prenom_transporteur`, `qte_achemine`, `date_achemine`,`id_emballage`,`id_camion`)
            VALUES ('$cod_id','$nom_c','$prenom_c','$qte','$date_l','$ar','$cb_camion')");

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
    <form action="" method="post">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">Ajouter lettre de voiture</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						
							<div class="row formtype">
								<!-- <div class="col-md-4">
									<div class="form-group">
										<label>ID lettre</label>
										<input class="form-control" type="text" name="id_lettre" >
                                    </div>
								</div> -->
                                <div class="col-md-4">
									<div class="form-group">
										<label>Nom Transporteur</label>
										<input class="form-control" type="text" placeholder="Entrez le nom" name="nom_conducteur">
                                    </div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<label>Prenom Transporteur</label>
										<input class="form-control" type="text" placeholder="Entrez le prenom" name="prenom_conducteur">
                                    </div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<label>Quantité acheminée</label>
										<input class="form-control" type="text" placeholder="Entrez la quantité" name="qte">
                                    </div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<label>Date</label>
										<div class="cal-icon">
										    <input type="date" class="form-control " name="date_ach">
                                        </div>
									</div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<label>Code emballage</label>
										<select class="form-control" id="sel1" name="cb_emballage">
                                        <?php 
                                            $sql=$bdd->query("SELECT * FROM `spatb18`");
                                            while($aff1=$sql->fetch()){ 
                                            ?> 
											<option><?php echo $aff1['nom_emballage'] ; ?></option>
                                            <?php } ?>
										</select>
									</div>
                                    
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<label>ID camion</label>
										<select class="form-control" id="sel1" name="cb_camion">
                                        <?php 
                                            $sql=$bdd->query("SELECT * FROM `spatb17`");
                                            while($aff1=$sql->fetch()){ 
                                            ?> 
											<option><?php echo $aff1['id_camion'] ; ?></option>
                                            <?php } ?>
										</select>
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
							<h3 class="page-title mt-5">Table Lettre</h3> </div>
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
                                            <th>code lettre</th>
                                                <th>nom & prenom du conducteur</th>
                                                <th>Quantité acheminée</th>
                                                <th>date acheminement</th>
                                                <th>code de l'emballage</th>
                                                <th>N° du camion</th>
												<th class="text-right">Actions</th>
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
												<td class="text-right">
													<div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
														<div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="edit-booking.html"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a> <a class="dropdown-item" href="delete_spapg12.php?delete=<?php echo $aff['id_lettre'] ; ?>" ><i class="fas fa-trash-alt m-r-5"></i> Delete</a> </div>
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
