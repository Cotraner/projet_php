<?php
session_start();
include "database.php";
$conn = dbConnect();
$id_patient = $_SESSION['id_patient'];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
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
		<a href="rendez_vous.php" <button class="buttonLog">chercher un rendez-vous</button></a>
    </nav>
       <h1>Voici vos ancien Rendez-vous :</h1>
         <table class="table">
              <tr>
                <th>date_rdv</th>
                <th>heure_rdv</th>
                <th>Docteur</th>
                <th>Code postal</th>
                <th>Specialite</th>
              </tr>
              <?php
                $allRdv = GetRdvOfPatient($conn,$id_patient);
                foreach ($allRdv as $rdv){
                    echo "<tr>";
                    echo "<td>".$rdv['date_rdv']."</td>";
                    echo "<td>".$rdv['heure_rdv']."</td>";
                    echo "<td>".$rdv['nom']."</td>";
                    echo "<td>".$rdv['code_postal']."</td>";
                    echo "<td>".$rdv['specialite']."</td>";
                    echo '<td><form method="POST" action="rendez_vous.php"><button type="submit" name="reprendre" value="'.$rdv['nom'].'" class="btn btn-primary">reprendre rendez-vous</button></form></td>';
                    echo "</tr>";
                }
                ?>
    </body>
</html>