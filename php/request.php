<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "database.php";

$conn = dbConnect();


function request($conn) {
    if (isset($_POST['user']) && isset($_POST['pswrd'])) {
        $id = $_POST['user'];
        $password = $_POST['pswrd'];
        
        $idMedecin = GetIdMedecin($conn, $id);
        $passwordMedecin = GetPasswordMedecin($conn, $id);
        //verifie si remerber me est coché
        if($_POST['remember'] == true){
            setcookie('username',$id,time() + 7*24*60*60,"/"); //cookies pour 7jours
            setcookie('password',"$password",time() + 7*24*60*60,"/");
        }
        
        // Vérifier si l'utilisateur et le mot de passe existent
        if (!empty($idMedecin) && $id == $idMedecin[0]['id']) {
            if (!empty($passwordMedecin) && $password == $passwordMedecin[0]['mot_de_passe']) {
                $nomPrenom = GetnameMedecin($conn, $id);
                $_SESSION["user"] = $id;
                $_SESSION["name"] = "Dr. " . $nomPrenom[0]['nom']. " ". $nomPrenom[0]['prenom'];
                header('Location: http://localhost/TP9/accueil.php');
                exit();
            }
        }
    }

    // Si les identifiants sont incorrects ou manquants
    header('Location: http://localhost/TP9/login.php?msg=informations incorrect ');

    exit();
}

request($conn);
?>
