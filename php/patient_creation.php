<?php
session_start();
if(isset($_SESSION["mail"])){
    header("Loaction: http://localhost/proj_php/projet_php/php/rendez_vous.php");
    exit ();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "database.php";

$conn = dbConnect();


function creerPatient($conn) {
    if (isset($_POST['mail']) && isset($_POST['pswrd']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) && isset($_POST['adresse']) && isset($_POST['tel'])){
        createPatient($conn, $_POST['nom'], $_POST['prenom'], $_POST['date'], $_POST['adresse'], $_POST['tel'], $_POST['mail'], $_POST['pswrd']);
        $_SESSION["nom"] = $_POST["nom"];
        $_SESSION["prenom"] = $_POST["prenom"];
        $_SESSION["id"] = GetIdPatientWithMail($conn, $_POST["mail"]);
        $_SESSION["nomcomp"] = $_SESSION["nom"]." ".$_SESSION["prenom"];


        header('Location: http://localhost/proj_php/projet_php/php/global_login.php');
        exit();
    }
    header('Location: http://localhost/proj_php/projet_php/php/create_patient.php');
    exit();
}
creerPatient($conn);

?>
