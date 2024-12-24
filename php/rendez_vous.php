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
            session_start();
            echo "Bonjour ". $_SESSION["nomcomp"];
        ?>
    </div>
	<form>
        <div class="row">
            <div class="col">
                <select type="selected" class="form-control" placeholder="Specialite">

                    <option><?php
                    include "database.php";
                    $allspe = GetAllSpe($conn);
                    foreach ($allspe as $spe){
                         echo "<option value='".$spe."</option>";
                    }
                         ?></option>
                        
                </select>
            </div>
            <div class="col">
                <select type="selected" class="form-control" placeholder="Docteur">
                    <option></option>
                </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Ville">
            </div>
        </div>
    </form>
</body>
</html>