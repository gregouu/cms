<?php session_start(); ?>

<?php

$pdo = new PDO('mysql:host=topadevcfftest.mysql.db;dbname=topadevcfftest', 'topadevcfftest', 'HETICprojet11', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$mail = $_GET['mail'];
$recup_donnee_mail = $pdo->query('SELECT * FROM hetic_inscription WHERE mail="'.$mail.'"');


$donnee_mail = $recup_donnee_mail->fetch(PDO::FETCH_ASSOC);
$mail_greg = $donnee_mail["admin"];

$affichage = $pdo->query("SELECT * FROM hetic_inscription"); ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Mail</th>
	  <th scope="col">Administrateur</th>
	  <th scope="col">Action</th>
	  <?php
		if($mail_greg == 'Y'){
			echo '<th scope="col">Modification</th>';
		}
	  ?>
	  <th>Publications</th>
    </tr>
  </thead>

<?php while($articles = $affichage->fetch(PDO::FETCH_ASSOC)){ ?> 

  <tbody>
    <tr>
      <th scope="row"><?php echo $articles["id"] ?></th>
      <td><?php echo $articles["nom"] ?></td>
      <td><?php echo $articles["prenom"] ?></td>
      <td><?php echo $articles["mail"] ?></td>
	  <td><?php echo $articles["admin"] ?></td>
	  <td>Supprimer le compte</td>
	<?php
		if($mail_greg == 'Y'){
		echo '<td><a href="#!"><img src="" alt="Bouton de modification"></a></td>';
		}
														
		if($mail_greg == 'Y'){
			echo '<td><button>Voir mes publications</button><td>';
		}
	?>
    </tr>
  </tbody>


<?php 
	} 
	$prenom = $donnee_mail['prenom'];
	
?>
</table>

<p>Bonjour <strong><?php echo $prenom;?></strong>, voulez vous écrire une nouvelle publication ?</p>
<br>


<form method="POST">
	<input type="text" placeholder="Titre" name="titre">
	<textarea name="contenu" cols="30" rows="10" placeholder="Contenu"></textarea>
	<input type="text" placeholder="IMAGE POUR UPLOAD">
	<input type="submit">
</form>

<?php 
	$date = date('jj-m-Y');
	$auteur = $prenom;
    if ($_POST) {
        $new_publi = $pdo->prepare("INSERT INTO hetic_publication (titre, contenu, auteur, date) VALUES (:titre, :contenu, :auteur, :date)");

        $new_publi->execute(array(
            'titre'    => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'auteur'    => $auteur,
            'date'  => $date
        ));
    }
?>






<a href="http://cms-php.topadev.com/index.php?deconnexion=true"><button>Deconnexion</button></a>


