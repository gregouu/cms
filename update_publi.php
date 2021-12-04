<?php

$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$id = $_GET['id'];
$token = $_GET["token"];
$mail = $_GET['mail'];


if($_POST) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/".$filename;

    // Requêtes SQL pour modifier les informations d'une ligne en base
    $result = $pdo->prepare('UPDATE hetic_publication SET titre = :titre, contenu = :contenu, nom = :nom WHERE id="'.$id.'"');
    $result->execute(array(
          'titre' => $_POST['titre'],
          'contenu' => $_POST['contenu'],
          'nom' => $filename
        ));

        header('Location: http://127.0.0.1/cms-php/location.php?token='.$token.'&mail='.$mail);
    } 

  $recup_donne = $pdo->query('SELECT * FROM hetic_publication WHERE id="'.$id.'"');
  while($recup_donne2 = $recup_donne->fetch(PDO::FETCH_ASSOC)){?>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="titre" value="<?php echo $recup_donne2['titre'];?>">
        <textarea name="contenu" cols="30" rows="10" value="<?php echo $recup_donne2['contenu'];?>"></textarea>
        <img src="images/<?php echo $recup_donne2['nom'];?>" width="200px" height="150px">
        <input type="file" name="uploadfile" value="<?php echo $recup_donne2['nom'];?>"/>
        <input type="submit" name="upload">
    </form>
  <?php
}?>

