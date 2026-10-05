<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Authorizations");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Content-Type: application/json: charset=UTF-8");

    $server = "localhost";
    $utilisateur = "root";
    $mdpBase = "";
    $base = "Location_Voiture";

    $conn = mysqli_connect($server, $utilisateur, $mdpBase, $base);

    $valeur = json_decode(file_get_contents("php://input"), true);

    $ancienNumero = $valeur['ancienNumero'];
    $numero = $valeur['numero'];
    $loyer = $valeur['loyer'];
    $nom = $valeur['nom'];
    $nbrJours = $valeur['nbrJours'];
    $design = $valeur['designation'];
    $taux = $valeur['taux'];
    

    $query = mysqli_prepare($conn, "update location set num_loc = ?, nom_loc = ?, 
    design_voiture = ?, nombre_jours = ?, taux_journalier = ? where num_loc = ?");

    mysqli_stmt_bind_param($query, "sssiis", $numero, $nom, $design, $nbrJours, $taux, $ancienNumero);

    if (mysqli_stmt_execute($query)) {

    echo json_encode(["status" => "success", "message" => "Modification reussi"]);

    }
    else {
    http_response_code(201);
    echo json_encode(["status" => "error", "message" => "Impossible d'effectuer la modification"]);

    }

    mysqli_stmt_close($query);
    mysqli_close($conn);

?>