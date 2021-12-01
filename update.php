<?php

$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$query="UPDATE hetic_inscription SET token = 0 WHERE id = ".$_GET['id'];

$result = $pdo->query($query);

header('Location: http://127.0.0.1/cms-php/connexion.php');

?>