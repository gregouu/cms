<?php

$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$id = $_GET['id'];
$token = $_GET["token"];
$mail = $_GET['mail'];

if($_POST) {
    // Requêtes SQL pour modifier les informations d'une ligne en base
    $result = $pdo->prepare('UPDATE commentaires SET titre_com = :titre_com, contenu_com = :contenu_com WHERE id="'.$id.'"');
    $result->execute(array(
          'titre_com' => $_POST['titre_com'],
          'contenu_com' => $_POST['contenu_com']
        ));

        header('Location: http://127.0.0.1/cms-php/location.php?token='.$token.'&mail='.$mail);
    } 

  $recup_donne = $pdo->query('SELECT * FROM commentaires WHERE id="'.$id.'"');
  while($recup_donne2 = $recup_donne->fetch(PDO::FETCH_ASSOC)){?>
    <form method="POST">
        <input type="text" name="titre_com" value="<?php echo $recup_donne2['titre_com'];?>"><br>
        <input name="contenu_com" type="text" value="<?php echo $recup_donne2['contenu_com'];?>"><br>
        <input type="submit" value="Modifier votre commentaire">
    </form>
  <?php
}?>

