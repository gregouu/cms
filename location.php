<?php session_start(); 
$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if(isset($_GET['mail'])){
	$mail = $_GET['mail'];

	$recup_donnee_mail = $pdo->query('SELECT * FROM hetic_inscription WHERE mail="'.$mail.'"');
	$donnee_mail = $recup_donnee_mail->fetch(PDO::FETCH_ASSOC);
	$mail_greg = $donnee_mail["admin"];
	$token_greg = $donnee_mail["token"];
}else{
	$token_greg = $_GET['token'];

	$recup_donnee_token = $pdo->query('SELECT * FROM hetic_inscription WHERE token="'.$token_greg.'"');
	$donnee_token = $recup_donnee_token->fetch(PDO::FETCH_ASSOC);
	$mail_greg = $donnee_token['mail'];

}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<style>
        .test{
            text-transform: uppercase;
        }
        .color-red{
            color: red;
        }
    </style>

    <title>The best CMS 4 ever</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?token=<?php echo $token_greg;?>">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Admin</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<?php



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
	  <td><a href="delete.php?tokenDELETE=<?php echo $articles['token']?>&token=<?php echo $token_greg;?>&mail=<?php echo $mail;?>">Supprimer le compte</a></td>
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

	if(isset($_GET['mail'])){
		$prenom = $donnee_mail['prenom'];
	}else{
		$prenom = $donnee_token['prenom'];
	}
	
	
?>
</table>
<!-- PUBLICATION -->
<?php

	$recup_nom_via_token = $pdo->query('SELECT * FROM hetic_inscription WHERE token="'.$token_greg.'"');
	$recup_nom_via_token2 = $recup_nom_via_token->fetch(PDO::FETCH_ASSOC);
	$nom = $recup_nom_via_token2['prenom'];

	$affi_card = $pdo->query('SELECT * FROM hetic_publication WHERE auteur="'.$nom.'"');
	while($affi_card2 = $affi_card->fetch(PDO::FETCH_ASSOC)){?>

		<div class="card" style="width: 18rem;">
		<img src="images/<?php echo $affi_card2['nom']; ?>" class="card-img-top">
		<div class="card-body">
			<h5 class="card-title"><?php echo $affi_card2['titre']; ?></h5>
			<p class="card-text"><?php echo $affi_card2['contenu']; ?></p>
			<!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		</div>
		</div>

<?php
	}
?>
<br>
<br>
<!-- COMMENTAIRE -->

<?php

	$affi_com = $pdo->query('SELECT * FROM commentaires WHERE auteur_com="'.$token_greg.'"');
	while($affi_com2 = $affi_com->fetch(PDO::FETCH_ASSOC)){?>

	<div class="card" style="width: 18rem;">
		<h4><?php echo $affi_com2['titre_com']; ?></h4>
		<br>
		<p><?php echo $affi_com2['contenu_com']; ?></p>
		<br>
		<p><?php echo $affi_com2['date_com']; ?></p>
	</div>

<?php
	}
?>


<br><br>
<!-- NEW PUBLICATION -->




<p>Bonjour <strong><?php echo $prenom;?></strong>, voulez vous écrire une nouvelle publication ?</p>
<br>


<form method="POST" enctype="multipart/form-data">
	<input type="text" placeholder="Titre" name="titre">
	<textarea name="contenu" cols="30" rows="10" placeholder="Contenu"></textarea>
	<input type="file" name="uploadfile" value=""/>
	<input type="submit" name="upload">
</form>

<?php 
	$date = date('d-m-Y');
	$auteur = $prenom;
	$msg = "";
    if ($_POST) {
		$filename = $_FILES["uploadfile"]["name"];
		$tempname = $_FILES["uploadfile"]["tmp_name"];
			
		$folder = "images/".$filename;
        $new_publi = $pdo->prepare("INSERT INTO hetic_publication (titre, contenu, auteur, date, nom) VALUES (:titre, :contenu, :auteur, :date, :nom)");

        $new_publi->execute(array(
            'titre'    => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'auteur'    => $auteur,
            'date'  => $date,
			'nom'  => $filename
        ));

		// Now let's move the uploaded image into the folder: image
		if (move_uploaded_file($tempname, $folder)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
    }
?>






<a href="http://127.0.0.1/cms-php/index.php?deconnexion=true"><button>Deconnexion</button></a>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>