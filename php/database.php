<?php 
include ("constant.php");

function dbConnect(){
    $dsn = 'pgsql:dbname='. DB_NAME.';host='.DB_SERVEUR.";port=". DB_PORT;
    $user = DB_USER;
    $password = DB_PASSWORD;
    try {
        $conn = new PDO($dsn, $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
    return $conn;
}

function GetIdMedecin($conn,$id){
    $request = $conn->query("SELECT id FROM medecins WHERE id='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetPasswordMedecin($conn,$id){
    $request = $conn->query("SELECT mot_de_passe FROM medecins WHERE id='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetnameMedecin($conn,$id){
    $request = $conn->query("SELECT prenom, nom FROM medecins WHERE id='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetPatientof($conn,$id){
    $request = $conn->query("SELECT * FROM patients WHERE medecin_id ='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function Getglycemieof($conn,$id){
    $request = $conn->query("SELECT date_mesure,valeur FROM glycemie WHERE patient_id ='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}





?>