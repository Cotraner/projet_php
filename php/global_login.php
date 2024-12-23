<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
	<title></title>
	<link href="../css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="body">
    <nav class="navbar navbar-dark bg-primary">
		<img id="logo" src="../images/logo_doctolisen.png">
		<p id="titre">DOCTOL'ISEN</p>
		<a href="medic_login.php" <button class="buttonLog">Connection en tant que medecin</button></a>
    </nav>
    <form id="form_login" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember me</label><br>
    </div>
    <div id="register">
    <a href="register.php" class="form-check-label lien">Register</a><br>
    </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>
<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "database.php";

$conn = dbConnect();


function request($conn) {
    if (isset($_POST['user']) && isset($_POST['pswrd'])) {
        $email = $_POST['user'];
        $password = $_POST['pswrd'];
        
        $idMedecin = GetIdMedecin($conn, $email);
        $passwordMedecin = GetPasswordMedecin($conn, $email);
        //verifie si remerber me est coché
        if($_POST['remember'] == true){
            setcookie('username',$email,time() + 7*24*60*60,"/"); //cookies pour 7jours
            setcookie('password',"$password",time() + 7*24*60*60,"/");
        }
        
        // Vérifier si l'utilisateur et le mot de passe existent
        if (!empty($idMedecin) && $email == $idMedecin[0]['id']) {
            if (!empty($passwordMedecin) && $password == $passwordMedecin[0]['mot_de_passe']) {
                $nomPrenom = GetnameMedecin($conn, $email);
                $_SESSION["user"] = $email;
                $_SESSION["name"] = "Dr. " . $nomPrenom[0]['nom']. " ". $nomPrenom[0]['prenom'];
                header('Location: http://localhost/TP9/accueil.php');
                exit();
            }
        }
    }

    // Si les identifiants sont incorrects ou manquants
    header('Location: http://localhost/proj_php/projet_php/global_login.php?msg=informations incorrect ');

    exit();
}

request($conn);
?>
