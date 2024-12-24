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

function GetEmailMedecin($conn,$email){
    $request = $conn->query("SELECT email FROM medecin WHERE email='$email';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}
function GetIdMedecinWithMail($conn,$email){
    $request = $conn->query("SELECT id_medecin FROM medecin WHERE email='$email';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetPasswordMedecin($conn,$id){
    $request = $conn->query("SELECT password FROM medecin WHERE id_medecin='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetnameMedecin($conn,$id){
    $request = $conn->query("SELECT prenom, nom FROM medecin WHERE id_medecin='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetEmailPatient($conn,$email){
    $request = $conn->query("SELECT email FROM patient WHERE email='$email';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}
function GetIdPatientWithMail($conn,$email){
    $request = $conn->query("SELECT id_patient FROM patient WHERE email='$email';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetPasswordPatient($conn,$id){
    $request = $conn->query("SELECT password FROM patient WHERE id_patient='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetnamePatient($conn, $id){
    $request = $conn->query("SELECT prenom, nom FROM patient WHERE id_patient='$id';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function createPatient($conn, $nom, $prenom, $date, $adresse, $tel, $email, $password){
    $request = $conn->query("INSERT INTO patient (nom, prenom, date_naissance, adresse, tel, email, password) VALUES ('$nom', '$prenom', '$date', '$adresse', '$tel', '$email', '$password');");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
}

function existSpe($conn, $spe){
    $request = $conn->query("SELECT COUNT(*) FROM specialite WHERE specialite='$spe';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function createMedic($conn, $mail, $password, $nom, $prenom, $code_postal, $tel, $specialite){
    if(existSpe($conn, $specialite)!=0){
        $idspe = $conn->query("SELECT id_specialite FROM specialite WHERE specialite='$specialite';");
        $request = $conn->query("INSERT INTO medecin (email, password, nom, prenom, code_postal, tel, id_specialite) VALUES ('$mail', '$password', '$nom', '$prenom', $code_postal, '$tel', '$idspe');");
        $result = $request->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }
    else{
        $request = $conn->query("INSERT INTO specialite (specialite) VALUES ('$specialite');");
        $idspe = $conn->query("SELECT id_specialite FROM specialite WHERE nom='$specialite';");
        $request = $conn->query("INSERT INTO medecin (email, password, nom, prenom, code_postal, tel, id_specialite) VALUES ('$mail', '$password', '$nom', '$prenom', '$code_postal', '$tel', '$idspe');");
        $result = $request->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }
}

function GetAllSpe($conn){
    $request = $conn->query("SELECT specialite FROM specialite;");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetAllDoc($conn){
    $request = $conn->query("SELECT nom FROM medecin;");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}








?>