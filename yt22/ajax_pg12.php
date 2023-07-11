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

    //$cod_id=strtoupper(substr($nom_c,0,2).substr($prenom_c,0,2));

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