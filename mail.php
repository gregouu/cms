<?php
$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $token = rand(100000,999999);
    $pass = !empty($_POST['mdp']) ? trim($_POST['mdp']) : null;
    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);
   


    if ($_POST) {
        $result = $pdo->prepare("INSERT INTO hetic_inscription (nom, prenom, mail, mdp, statut, etat, token) VALUES (:nom, :prenom, :mail, :mdp, :statut, :etat, :token)");

        $result->execute(array(
            'nom'    => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'mail'   => $_POST['mail'],
            'mdp'    => $passwordHash,
            'statut' => $_POST['statut'],
            'etat'   => $_POST['etat'],
            'token'  => $token
        ));
		header('Location: http://127.0.0.1/cms-php/location.php');
    }


    ?>