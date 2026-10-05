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

    $numero = $valeur['numero'];
    $loyer = $valeur['loyer'];
    $nom = $valeur['nom'];
    $nbrJours = $valeur['nbrJours'];
    $design = $valeur['designation'];
    $taux = $valeur['taux'];
    

    $query = mysqli_prepare($conn, "insert into location (num_loc, nom_loc, design_voiture, nombre_jours, taux_journalier) values (?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($query, "sssii", $numero, $nom, $design, $nbrJours, $taux);

    if (mysqli_stmt_execute($query)) {
    echo json_encode(["status" => "success", "message" => "Ajout reussi"]);
      echo("Insértion réussi !");
    }
    else {
    http_response_code(201);
    echo json_encode(["status" => "error", "message" => "Erreur"]);
      echo("Impossible d'effectuer l'insertion !");
    }

    mysqli_stmt_close($query);
    mysqli_close($conn);

?>