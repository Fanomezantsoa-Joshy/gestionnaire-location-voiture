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

    $query = "select sum(nombre_jours * taux_journalier) as total, 
    max(nombre_jours * taux_journalier) as max, min(nombre_jours * taux_journalier) as min  from location";

    $resultat = mysqli_query($conn, $query);

    if(mysqli_num_rows($resultat) > 0) {

        $row = mysqli_fetch_assoc($resultat);

        echo json_encode([
        "valeur" => [

        "total" => (int)$row["total"],
        "min" => (int)$row["min"],
        "max" => (int)$row["max"]
        ]
        ]);
        }


    mysqli_close($conn);

?>