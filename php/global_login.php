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
    <form id="form_login" action="request_global.php" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php 
                if(isset($_COOKIE['username'])){
                    echo $_COOKIE['username'];
                }?>"/>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="pswrd" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?php 
                if(isset($_COOKIE['password'])){
                    echo $_COOKIE['password'];
                }?>"/>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
        <label class="form-check-label" for="exampleCheck1">Remember me</label><br>
    </div>
    <div id="register">
    <a href="register.php" class="form-check-label lien">Register</a><br>
    </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>
