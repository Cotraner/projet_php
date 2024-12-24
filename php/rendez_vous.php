<?php    
    // Démarrer la session
    session_start();
    
    // Vérifier si la variable de session est définie
    if (isset($_SESSION["name"])) {
        $nomcomp = $_SESSION["name"];
    }    
    include 'database.php';
    $conn = dbConnect();
    
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
		<a href="prev_rdv.php" <button class="buttonLog">rendez-vous passé</button></a>
    </nav>
    <div class="type_conn">
        <?php
            echo "Bonjour ". htmlspecialchars($nomcomp);
        ?>
    </div>
	<form method="POST">
        <div class="row">
            <div class="col">
                <select type="selected" class="form-control" placeholder="Specialite" name="specialite">
                    <?php
                    
                    $allspe = GetAllSpe($conn);
                    foreach ($allspe as $spe){
                        echo "<option value='".$spe['specialite']."'>".$spe['specialite'] ."</option>";
                   }    
                   
                    ?>       
                </select>
            </div>
            <div class="col">
                <select type="selected" class="form-control" placeholder="Docteur" name="docteur">
                <?php
                    
                    $allDoc = GetAllDoc($conn);
                    foreach ($allDoc as $doc){
                        echo "<option value='".$doc['nom']."'>"."Dr.". " ".$doc['nom'] ."</option>";
                   }    
                   
                    ?> 
                </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Code Postal" name="codePostal">
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </div>
    <?php
        if(isset($_POST["specialite"]) || isset($_POST["docteur"]) || isset($_POST["codePostal"])){
            $specialite = $_POST["specialite"];
            $docteur = $_POST["docteur"];
            $codePostal = $_POST["codePostal"];
            $allRdv = GetAllRdv($conn, $specialite, $docteur, $codePostal);
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>Nom</th>";
            echo "<th scope='col'>Prenom</th>";
            echo "<th scope='col'>Date</th>";
            echo "<th scope='col'>Heure</th>";
            echo "<th scope='col'>Specialite</th>";
            echo "<th scope='col'>Docteur</th>";
            echo "<th scope='col'>Code Postal</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($allRdv as $rdv){
                echo "<tr>";
                echo "<td>".$rdv['nom']."</td>";
                echo "<td>".$rdv['prenom']."</td>";
                echo "<td>".$rdv['date']."</td>";
                echo "<td>".$rdv['heure']."</td>";
                echo "<td>".$rdv['specialite']."</td>";
                echo "<td>".$rdv['docteur']."</td>";
                echo "<td>".$rdv['codePostal']."</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }


    ?>
</body>
</html>