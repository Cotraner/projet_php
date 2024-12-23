<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "database.php";

$conn = dbConnect();


function request($conn) {
    if (isset($_POST['mail']) && isset($_POST['pswrd'])) {
        $email = $_POST['mail'];
        $password = $_POST['pswrd'];
        
        $idMedecin = GetIdMedecinWithMail($conn, $email)[0]['id_medecin'];
        $passwordMedecin = GetPasswordMedecin($conn, $idMedecin);
        //verifie si remerber me est coché
        if($_POST['remember'] == true){
            setcookie('username',$email,time() + 7*24*60*60,"/"); //cookies pour 7jours
            setcookie('password',"$password",time() + 7*24*60*60,"/");
        }
        
        // Vérifier si l'utilisateur et le mot de passe existent
        if (!empty($email) && $email == GetEmailMedecin($conn,$email)[0]['email']) {
            if (!empty($passwordMedecin) && $password == GetPasswordMedecin($conn, $idMedecin)[0]['password']) {
                $nomPrenom = GetnameMedecin($conn, $idMedecin);
                $_SESSION["mail"] = $email;
                $_SESSION["name"] = "Dr. " . $nomPrenom[0]['nom']. " ". $nomPrenom[0]['prenom'];
                header('Location: http://localhost/proj_php/projet_php/php/espace_medic.php');
                exit();
            }
        }
    }

    // Si les identifiants sont incorrects ou manquants
    header('Location: http://localhost/proj_php/projet_php/php/medic_login.php');
    exit();
}
request($conn);

?>
