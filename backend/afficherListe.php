<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorizations");
header("Access-Control-Allow-Methods: GET ,POST, OPTIONS");
header("Content-Type: application/json: charset=UTF-8");

    $server = "localhost";
    $utilisateur = "root";
    $mdpBase = "";
    $base = "Location_Voiture";

    $conn = mysqli_connect($server, $utilisateur, $mdpBase, $base);


    $query = "SELECT num_loc as numero, nom_loc as nom, design_voiture as designation,
    nombre_jours as nbrJours, taux_journalier as taux, (nombre_jours * taux_journalier) as loyer from location";
    
    $resultat = mysqli_query($conn, $query);

    $data = [];

    if (mysqli_num_rows($resultat) > 0) {

    while($row = mysqli_fetch_assoc($resultat)) {
    $data[] = $row;
    }

    }

    echo json_encode($data);

    mysqli_close($conn);

?>
