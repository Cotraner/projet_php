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

function GetIdMedecinWithNom($conn,$nom){
    $request = $conn->query("SELECT id_medecin FROM medecin WHERE nom='$nom';");
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

function GetAllRdv($conn, $specialite, $id_docteur, $codePostal) {
    try {
        // Base de la requête
        $sql = "SELECT 
                    rdv.date_rdv, 
                    rdv.heure_rdv, 
                    med.nom AS nom_medecin, 
                    med.code_postal, 
                    spec.specialite
                FROM rdv
                INNER JOIN medecin med ON rdv.id_medecin = med.id_medecin
                INNER JOIN specialite spec ON med.id_specialite = spec.id_specialite
                WHERE 1=1";

        // Paramètres dynamiques
        $params = [];

        // Vérification et ajout des filtres
        if (!empty($specialite)) {
            $sql .= " AND spec.specialite = :specialite";
            $params['specialite'] = $specialite;
        }

        if (!empty($id_docteur) && is_numeric($id_docteur)) {
            $sql .= " AND med.id_medecin = :id_docteur";
            $params['id_docteur'] = (int)$id_docteur;
        } elseif (!empty($id_docteur)) {
            throw new Exception("L'ID du docteur doit être un entier valide.");
        }

        if (!empty($codePostal)) {
            $sql .= " AND med.code_postal = :code_postal";
            $params['code_postal'] = $codePostal; // Traité comme une chaîne
        }

        // Préparation et exécution
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // Retourner les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Gestion des erreurs
        echo "Erreur : " . $e->getMessage();
        return [];
    }
}

?>