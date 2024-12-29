<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title> index </title>
         <script src="script.js"></script>
        <link href="main.css" rel="stylesheet" />
    </head>
    <body>
        <p>Le rendez-vous a bien été pris</p>
    </body>
</html>

<?php
    include 'database.php';
    $conn = dbConnect();
    $id_patient = $_SESSION['id_patient'];
    echo updateRdv($conn,$id_patient,$_POST['but']);
    
    


?>



