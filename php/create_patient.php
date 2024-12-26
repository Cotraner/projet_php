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
		<a href="create_medic.php" <button class="buttonLog">Créer un compte medecin</button></a>
    </nav>
    
    <form id="form_login" action="patient_creation.php" method="POST">
    <p class="type_conn">Creation patient</p>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"/>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="pswrd" class="form-control" id="exampleInputPassword1" placeholder="Password"/>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Nom</label>
        <input type="text" name="nom" class="form-control" id="exampleInputPassword1" placeholder="Nom"/>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Prenom</label>
        <input type="text" name="prenom" class="form-control" id="exampleInputPassword1" placeholder="Prenom"/>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Date de naissance</label>
        <input type="date" name="date" class="form-control" id="exampleInputPassword1" placeholder="Date de naissance"/>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Adresse</label>
        <input type="text" name="adresse" class="form-control" id="exampleInputPassword1" placeholder="Adresse"/>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Telephone</label>
        <input type="text" name="tel" class="form-control" id="exampleInputPassword1" placeholder="Telephone"/>
    </div>
    
    <div id="register">
    <a href="global_login.php" class="form-check-label lien">Connexion</a><br>
    </div>
    
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</body>
</html>
