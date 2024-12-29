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
        
        $idPatient = GetIdPatientWithMail($conn, $email)[0]['id_patient'];
        $passwordPatient = GetPasswordPatient($conn, $idPatient);
        //verifie si remerber me est coché
        if($_POST['remember'] == true){
            setcookie('username',$email,time() + 7*24*60*60,"/"); //cookies pour 7jours
            setcookie('password',$password,time() + 7*24*60*60,"/");
        }
        
        // Vérifier si l'utilisateur et le mot de passe existent
        if (!empty($email) && $email == GetEmailPatient($conn,$email)[0]['email']) {
            if (!empty($passwordPatient) && $password == GetPasswordPatient($conn, $idPatient)[0]['password']) {
                $nomPrenom = GetnamePatient($conn, $idPatient);
                $_SESSION["id_patient"] = $idPatient;
                $_SESSION["mail"] = $email;
                $_SESSION["name"] = $nomPrenom[0]['prenom'] . " " . $nomPrenom[0]['nom'];
                header('Location: http://localhost/proj_php/projet_php/php/rendez_vous.php');
                exit();
            }
        }
    }

    // Si les identifiants sont incorrects ou manquants
    header('Location: http://localhost/proj_php/projet_php/php/global_login.php');
    exit();
}
request($conn);

?>
