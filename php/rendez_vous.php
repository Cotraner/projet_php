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
                    <option value=null>Specialite</option>
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
                    <option value=null>Docteur</option>
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
        <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </div>
    </form>
    
    <?php
        echo "<br>";
        echo "recherche pour : Docteur : ".$_POST["docteur"].", Specialite : ".$_POST["specialite"].", Code Postal : ".$_POST["codePostal"];
        if(isset($_POST["specialite"]) || isset($_POST["docteur"]) || isset($_POST["codePostal"])){
            $specialite = $_POST["specialite"];
            $docteur = $_POST["docteur"];
            $codePostal = $_POST["codePostal"];
            $id_docteur = GetIdMedecinWithNom($conn, $docteur)[0]['id_medecin'];
            var_dump($id_docteur);
            var_dump($specialite);
            var_dump($codePostal);
            $allRdv = GetAllRdv($conn, $specialite, $id_docteur, $codePostal);
            if (!empty($allRdv)) {
                //var_dump($allRdv);
                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>Date</th>";
                echo "<th scope='col'>Heure</th>";
                echo "<th scope='col'>Specialite</th>";
                echo "<th scope='col'>Docteur</th>";
                echo "<th scope='col'>Code Postal</th>";
                echo "<th scope='col'></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($allRdv as $rdv){
                    echo "<tr>";
                    echo "<td>".$rdv['date_rdv']."</td>";
                    echo "<td>".$rdv['heure_rdv']."</td>";
                    echo "<td>".$rdv['specialite']."</td>";
                    echo "<td>".$rdv['nom_medecin']."</td>";
                    echo "<td>".$rdv['code_postal']."</td>";
                    echo '<td><button type="submit" class="btn btn-primary">prendre rendez-vous</button></td>';
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
            else{
                echo "Aucun rendez-vous disponible";
            }
        }


    ?>
</body>
</html>