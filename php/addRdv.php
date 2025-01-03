<?php
session_start();
?>

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
    <body>
        <p class="type_conn">Le rendez-vous a bien été pris</p>
        <br>
        <p class="type_conn">Vous allez être redirigé vers la page de rendez-vous</p>
    </body>
</html>

<?php
    include 'database.php';
    $conn = dbConnect();
    $id_patient = $_SESSION['id_patient'];
    updateRdv($conn,$id_patient,intval($_POST['but']));
    header("Refresh: 5; URL=rendez_vous.php");


?>



