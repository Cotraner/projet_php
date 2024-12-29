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

function GetAllRdvDoc($conn, $id_doc){
    $request = $conn->query("SELECT rdv.date_rdv, rdv.heure_rdv, med.nom, med.code_postal, spec.specialite FROM rdv INNER JOIN medecin med ON rdv.id_medecin = med.id_medecin INNER JOIN specialite spec ON med.id_specialite = spec.id_specialite WHERE id_medecin = '$id_doc';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetAllRdvSpe($conn, $spe){
    $request = $conn->query("SELECT rdv.date_rdv, rdv.heure_rdv, med.nom, med.code_postal, spec.specialite FROM rdv INNER JOIN medecin med ON rdv.id_medecin = med.id_medecin INNER JOIN specialite spec ON med.id_specialite = spec.id_specialite WHERE spec.specialite = '$spe';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetAllRdvCode($conn, $codePostal){
    $request = $conn->query("SELECT rdv.date_rdv, rdv.heure_rdv, med.nom, med.code_postal, spec.specialite FROM rdv INNER JOIN medecin med ON rdv.id_medecin = med.id_medecin INNER JOIN specialite spec ON med.id_specialite = spec.id_specialite WHERE med.code_postal = '$codePostal';");
    $result = $request->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

function GetAllRdv($conn, $specialite = null, $id_docteur = null, $codePostal = null) {
    try {
        // Base de la requête SQL
        $sql = "SELECT
                    rdv.id_rdv, 
                    rdv.date_rdv, 
                    rdv.heure_rdv, 
                    med.nom AS nom_medecin, 
                    med.code_postal, 
                    spec.specialite
                FROM rdv
                INNER JOIN medecin med ON rdv.id_medecin = med.id_medecin
                LEFT JOIN specialite spec ON med.id_specialite = spec.id_specialite";

        // Conditions dynamiques
        $conditions = ["rdv.id_patient IS NULL"]; // Ajouter une condition pour id_patient NULL par défaut
        $params = [];

        // Ajouter une condition pour l'ID du médecin si défini
        if ($id_docteur !== null) {
            $conditions[] = "med.id_medecin = :id_docteur";
            $params[':id_docteur'] = $id_docteur;
        }

        // Ajouter une condition pour le code postal si défini
        if (!empty($codePostal)) {
            $conditions[] = "med.code_postal = :code_postal";
            $params[':code_postal'] = $codePostal;
        }

        // Ajouter une condition pour la spécialité
        if ($specialite === null) {
            $conditions[] = "spec.specialite IS NULL";
        } elseif (!empty($specialite)) {
            $conditions[] = "spec.specialite = :specialite";
            $params[':specialite'] = $specialite;
        }

        // Si des conditions existent, on les ajoute à la requête
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions); // Utilisation de 'AND' pour filtrer plus précisément
        }

        // Préparation et exécution de la requête
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // Retourner les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Gestion des erreurs SQL
        echo "Erreur SQL : " . $e->getMessage();
        return [];
    }
}


function updateRdv($conn, $id_patient, $id_rdv) {
    $conn->execute("UPDATE rdv SET id_patient ='$id_patient' WHERE id_rdv = '$id_rdv';");
}









?>