<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "database.php";

$conn = dbConnect();


function creerMedic($conn) {
    if (isset($_POST['mail']) && isset($_POST['pswrd']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['code_post']) && isset($_POST['tel']) && isset($_POST['specialite'])) {
        createMedic($conn, $_POST['mail'], $_POST['pswrd'], $_POST['nom'], $_POST['prenom'], $_POST['code_post'], $_POST['tel'], $_POST['specialite']);
        header('Location: http://localhost/proj_php/projet_php/php/medic_login.php');
        exit();
    }
    header('Location: http://localhost/proj_php/projet_php/php/create_medic.php');
    exit();
}
creerMedic($conn);

?>
