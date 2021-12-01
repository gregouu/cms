<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if(isset($_POST['connexion'])){
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    if(!empty($mail) AND !empty($mdp)){
        $result = $pdo->query("SELECT * FROM hetic_inscription");
        $liste = $result->fetch();
        $hash = password_verify($mdp, $liste['mdp']);
        if($mail == $liste['mail'] AND $mdp == $hash){
            header("Location: http://127.0.0.1/cms-php/location.php?mail=".$_POST['mail']);
        }
        else{
            echo "Une erreur soit dans l'email soit dans le mot de passe";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Devoir bart</title>
</head>

<body>
    <h1>connexion</h1>
    <div class="container">
        <div class="row">
            <form method="POST">
                <label for="exampleInputEmail1" class="form-label">Mail</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="mdp">
                <br>
                <button type="submit" class="btn btn-primary" name="connexion">connexion</button>
            </form>
			<p>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivivez-vous</a></p>
            <?php
            if (isset($erreur)) {
                echo '<font color="red">' . $erreur . "</font>";
            }
            ?>

            
        </div>
    </div>






    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>