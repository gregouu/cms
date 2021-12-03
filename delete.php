<?php

$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$token = $_GET["token"];
$token2 = $_GET["tokenDELETE"];
$mail = $_GET['mail'];

if($token == $token2){
    header('Location: http://127.0.0.1/cms-php/location.php?token='.$token.'&mail='.$mail);
    echo '<p class = "color-red">Attention, ne te supprime pas toi même ;)</p>';
}else{
    $query="DELETE FROM hetic_inscription WHERE token = ".$_GET['tokenDELETE'];

    $result = $pdo->query($query);
    
    header('Location: http://127.0.0.1/cms-php/location.php?token='.$token.'&mail='.$mail);
}




?>