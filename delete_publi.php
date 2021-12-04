<?php

    $pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $id = $_GET["id"];
    $token = $_GET["token"];
    $token2 = $_GET["tokenDELETE"];
    $mail = $_GET['mail'];


    $query="DELETE FROM hetic_publication WHERE id = ".$_GET['id'];

    $result = $pdo->query($query);
    
    header('Location: http://127.0.0.1/cms-php/location.php?token='.$token.'&mail='.$mail);





?>