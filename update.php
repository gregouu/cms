<?php

$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$id = $_GET['id'];
$token = $_GET["token"];
$mail = $_GET['mail'];
$admin = $_GET['admin'];

$pass = !empty($_POST['mdp']) ? trim($_POST['mdp']) : null;
$passwordHash = password_hash($pass, PASSWORD_DEFAULT);

if($_POST) {

    if($admin == 'Y'){
        $result = $pdo->prepare('UPDATE hetic_inscription SET nom = :nom, prenom = :prenom, mail= :mail, admin = :admin, mdp = :mdp WHERE id="'.$id.'"');
        $result->execute(array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'], 
            'mail' => $_POST['mail'],
            'admin' => $_POST['admin'],
            'mdp'    => $passwordHash
          ));
    }else{
        $result = $pdo->prepare('UPDATE hetic_inscription SET nom = :nom, prenom = :prenom, mail= :mail, mdp = :mdp WHERE id="'.$id.'"');
        $result->execute(array(
              'nom' => $_POST['nom'],
              'prenom' => $_POST['prenom'], 
              'mail' => $_POST['mail'],
              'mdp'    => $passwordHash

            ));
    }

        header('Location: http://127.0.0.1/cms-php/location.php?token='.$token.'&mail='.$mail);
    } 

  $recup_donne = $pdo->query('SELECT * FROM hetic_inscription WHERE id="'.$id.'"');
  while($recup_donne2 = $recup_donne->fetch(PDO::FETCH_ASSOC)){
      ?>
    <form method="POST">
        <input type="text" name="nom" value="<?php echo $recup_donne2['nom'];?>"><br>
        <input name="prenom" type="text" value="<?php echo $recup_donne2['prenom'];?>"><br>
        <input type="text" name="mail" value="<?php echo $recup_donne2['mail'];?>">
        <?php
            if($admin == "Y"){
                echo '<input type="text" name="admin" value="Admin? (Y/N)"/>';
            }
        ?>
        <input type="password" name="mdp">
        <input type="submit" value="Modifier votre commentaire">
    </form>
  <?php
}?>

