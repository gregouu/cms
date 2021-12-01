<?php
$pdo = new PDO('mysql:host=localhost;dbname=cms_php', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

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
		header('Location: http://cms-php.topadev.com/location.php');
    }


   /** $result = $pdo->query("SELECT * FROM hetic_inscription");
    $liste = $result->fetch();
    $id = $liste['id'];

    $to      = $_POST['mail'];
    $subject = 'Vérification compte';
    $message = 'http://cms-php.topadev.com/update.php?token='.$token.'&id='.$id;


    mail($to, $subject, $message);
    header('Location: http://cms-php.topadev.com/connexion.php');**/

    ?>